<?php

namespace Boaz\Http\Controllers\Web;

use Boaz\Events\User\ChangedAvatar;
use Boaz\Events\User\TwoFactorDisabled;
use Boaz\Events\User\TwoFactorEnabled;
use Boaz\Events\User\UpdatedProfileDetails;
use Boaz\Http\Controllers\Controller;
use Boaz\Http\Requests\User\EnableTwoFactorRequest;
use Boaz\Http\Requests\User\UpdateProfileDetailsRequest;
use Boaz\Http\Requests\User\UpdateProfileLoginDetailsRequest;
use Boaz\Repositories\Activity\ActivityRepository;
use Boaz\Repositories\Country\CountryRepository;
use Boaz\Repositories\Role\RoleRepository;
use Boaz\Repositories\Session\SessionRepository;
use Boaz\Repositories\User\UserRepository;
use Boaz\Services\Upload\UserAvatarManager;
use Boaz\Support\Enum\UserStatus;
use Boaz\User;
use Auth;
use Authy;
use Boaz\Document;
use Boaz\ProfessionalCertification;
use DB;
use Boaz\WorkExperience;
use Boaz\Designations;
use Boaz\AreaStudy;
use Boaz\EducationBackground;
use Boaz\DegreeCertificate;
use Boaz\Language;
use Boaz\LanguageSkills;
use Boaz\JobsApplications;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class ProfileController
 * @package Boaz\Http\Controllers
 */
class ProfileController extends Controller
{
    /**
     * @var User
     */
    protected $theUser;
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * UsersController constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('auth');
        $this->middleware('session.database', ['only' => ['sessions', 'invalidateSession']]);

        $this->users = $users;

        $this->middleware(function ($request, $next) {
            $this->theUser = Auth::user();
            return $next($request);
        });
    }

    /**
     * Display user's profile page.
     *
     * @param RoleRepository $rolesRepo
     * @param CountryRepository $countryRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(RoleRepository $rolesRepo, CountryRepository $countryRepository)
    {
        $user = $this->theUser;
        $edit = true;
        $roles = $rolesRepo->lists();
        $countries = [0 => 'Select a Country'] + $countryRepository->lists()->toArray();
        $socialLogins = $this->users->getUserSocialLogins($this->theUser->id);
        $statuses = UserStatus::lists();
        $docs = Document::all();
        $industry = Designations::all();
        $works =WorkExperience::where('user_id', Auth::user()->id)->get();
        $education = EducationBackground::where('user_id', '=', Auth::user()->id)->get();
        $study = AreaStudy::all();
        $achieved = DegreeCertificate::all();
        $pcertification = ProfessionalCertification::where('user_id', '=', Auth::user()->id)->get();
        $langu = Language::all();
        $langskills = LanguageSkills::where('user_id', '=', Auth::user()->id)->get();
        $pastjobs = JobsApplications::where('user_id', '=', Auth::user()->id)->get();

        return view('user/profile', compact('user', 'pastjobs', 'langskills', 'langu', 'edit', 'roles', 'countries', 'socialLogins', 'statuses', 'docs', 'industry', 'works', 'education', 'study', 'achieved', 'pcertification'));
    }

    /**
     * Update profile details.
     *
     * @param UpdateProfileDetailsRequest $request
     * @return mixed
     */
    public function updateDetails(UpdateProfileDetailsRequest $request)
    {
        $this->users->update($this->theUser->id, $request->except('role_id', 'status'));

        event(new UpdatedProfileDetails);

        return redirect()->back()
            ->withSuccess(trans('app.profile_updated_successfully'));
    }

    /**
     * Upload and update user's avatar.
     *
     * @param Request $request
     * @param UserAvatarManager $avatarManager
     * @return mixed
     */
    public function updateAvatar(Request $request, UserAvatarManager $avatarManager)
    {
        $this->validate($request, [
            'avatar' => 'image'
        ]);

        $name = $avatarManager->uploadAndCropAvatar(
            $this->theUser,
            $request->file('avatar'),
            $request->get('points')
        );

        if ($name) {
            return $this->handleAvatarUpdate($name);
        }

        return redirect()->route('profile')
            ->withErrors(trans('app.avatar_not_changed'));
    }

    /**
     * Update avatar for currently logged in user
     * and fire appropriate event.
     *
     * @param $avatar
     * @return mixed
     */
    private function handleAvatarUpdate($avatar)
    {
        $this->users->update($this->theUser->id, ['avatar' => $avatar]);

        event(new ChangedAvatar);

        return redirect()->route('profile')
            ->withSuccess(trans('app.avatar_changed'));
    }

    /**
     * Update user's avatar from external location/url.
     *
     * @param Request $request
     * @param UserAvatarManager $avatarManager
     * @return mixed
     */
    public function updateAvatarExternal(Request $request, UserAvatarManager $avatarManager)
    {
        $avatarManager->deleteAvatarIfUploaded($this->theUser);

        return $this->handleAvatarUpdate($request->get('url'));
    }

    /**
     * Update user's login details.
     *
     * @param UpdateProfileLoginDetailsRequest $request
     * @return mixed
     */
    public function updateLoginDetails(UpdateProfileLoginDetailsRequest $request)
    {
        $data = $request->except('role', 'status');

        // If password is not provided, then we will
        // just remove it from $data array and do not change it
        if (trim($data['password']) == '') {
            unset($data['password']);

            unset($data['password_confirmation']);
        }

        $this->users->update($this->theUser->id, $data);

        return redirect()->route('profile')
            ->withSuccess(trans('app.login_updated'));
    }

    /**
     * Enable 2FA for currently logged user.
     *
     * @param EnableTwoFactorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enableTwoFactorAuth(EnableTwoFactorRequest $request)
    {
        if (Authy::isEnabled($this->theUser)) {
            return redirect()->route('user.edit', $this->theUser->id)
                ->withErrors(trans('app.2fa_already_enabled'));
        }

        $this->theUser->setAuthPhoneInformation($request->country_code, $request->phone_number);

        Authy::register($this->theUser);

        $this->theUser->save();

        event(new TwoFactorEnabled);

        return redirect()->route('profile')
            ->withSuccess(trans('app.2fa_enabled'));
    }

    /**
     * Disable 2FA for currently logged user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disableTwoFactorAuth()
    {
        if (! Authy::isEnabled($this->theUser)) {
            return redirect()->route('profile')
                ->withErrors(trans('app.2fa_not_enabled_for_this_user'));
        }

        Authy::delete($this->theUser);

        $this->theUser->save();

        event(new TwoFactorDisabled);

        return redirect()->route('profile')
            ->withSuccess(trans('app.2fa_disabled'));
    }

    /**
     * Display user activity log.
     *
     * @param ActivityRepository $activitiesRepo
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function activity(ActivityRepository $activitiesRepo, Request $request)
    {
        $user = $this->theUser;

        $activities = $activitiesRepo->paginateActivitiesForUser(
            $user->id,
            $perPage = 20,
            $request->get('search')
        );

        return view('activity.index', compact('activities', 'user'));
    }


    /**
     * Display active sessions for current user.
     *
     * @param SessionRepository $sessionRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sessions(SessionRepository $sessionRepository)
    {
        $profile = true;
        $user = $this->theUser;
        $sessions = $sessionRepository->getUserSessions($user->id);

        return view('user.sessions', compact('sessions', 'user', 'profile'));
    }

    /**
     * Invalidate user's session.
     *
     * @param $session \stdClass Session object.
     * @param SessionRepository $sessionRepository
     * @return mixed
     */
    public function invalidateSession($session, SessionRepository $sessionRepository)
    {
        $sessionRepository->invalidateSession($session->id);

        return redirect()->route('profile.sessions')
            ->withSuccess(trans('app.session_invalidated'));
    }

    public function uploadFiles(Request $request)
    {

        $request->validate([
            'resume' => 'required|file|max:1024',
            'coverletter' => 'required',
            'certs' => 'required',
        ]);

        $uploadedFile = Auth::user();
        if ($request->hasFile('resume')) {
            $resume = $request->file('resume');
            $name = str_slug(Auth::user()->username."-".Carbon::now()).'.'.$resume->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/documents');
            $imagePath = $destinationPath. "/".  $name;
            $resume->move($destinationPath, $name);
            $finaldest = '/uploads/documents/'.$name;
            $uploadedFile->resume = $finaldest;
          }
         
        if ($request->hasFile('coverletter')) {
            $coverletter = $request->file('coverletter');
            $name = str_slug(Auth::user()->username."-".Carbon::now()).'.'.$coverletter->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/documents');
            $imagePath = $destinationPath. "/".  $name;
            $coverletter->move($destinationPath, $name);
            $finaldest = '/uploads/documents/'.$name;
            $uploadedFile->coverletter = $finaldest;
          }
     
        if ($request->hasFile('certs')) {
            $certs = $request->file('certs');
            $name = str_slug(Auth::user()->username."-".Carbon::now()).'.'.$certs->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/documents');
            $imagePath = $destinationPath. "/".  $name;
            $certs->move($destinationPath, $name);
            $finaldest = '/uploads/documents/'.$name;
            $uploadedFile->certs = $finaldest;
          }
      
      //$uploadedFile->update();
    
      $uploadedFile->update();

       return redirect()->route('profile')
      ->withSuccess('Documents Uploaded Successfully');
    }

   

    public function workExperiences(Request $request)
    {
        //dd($request);
        $request->validate([
            'employer' => 'required',
            'designation_id' => 'required',
            'country_id' => 'required',
            'startdate' => 'required',
        ]);

     //we use a cheat ?

    
        for($i=0; $i< count($request->employer); $i++){
            $work = new WorkExperience();
            $work->employer = $request->employer[$i];
            $work->user_id = Auth::user()->id;
            $work->designation_id = $request->designation_id[$i];
            $work->startdate = $request->startdate[$i];
            $work->enddate = $request->enddate[$i];
            $work->country_id =$request->country_id;
            
            $work->save();
        }


        return redirect()->route('profile')
        ->withSuccess('Work Experience Uploaded Successfully');
    }

    public function educationBackground(Request $request)
    {
        //dd($request);
        $request->validate([
            'institution' => 'required',
            'areastudied_id' => 'required',
            'certificate_id' => 'required',
            'country_id' => 'required',
            'startdate' => 'required',
        ]);

        for ($i = 0; $i < count($request->institution); $i++) {
                $education[] = [
                    'user_id' => Auth::user()->id,
                    'institution' => $request->institution[$i],
                    'startdate' => $request->startdate[$i],
                    'areastudied_id' => $request->areastudied_id[$i],
                    'certificate_id' =>$request->certificate_id[$i],
                    'enddate' => $request->enddate[$i],
                    'country_id' =>$request->country_id[$i]
           
                ];
            }
            EducationBackground::insert($education);

             return redirect()->route('profile')
        ->withSuccess('Education Background added Successfully');
    }

    public function professionalcertification(Request $request)
    {
        $request->validate([
            'certification' => 'required',
            'dateacquired' => 'required',
            'expirationdate' => 'required',
        ]);

        for ($i = 0; $i < count($request->certification); $i++) {
            $certification[] = [
                'user_id' => Auth::user()->id,
                'certification' => $request->certification[$i],
                'dateacquired' => $request->dateacquired[$i],
                'expirationdate' => $request->expirationdate[$i]
       
            ];
        }

        ProfessionalCertification::insert($certification);

             return redirect()->route('profile')
        ->withSuccess('Education Background added Successfully');

    }
    
   
    public function languageskills(Request $request)
    {
        $request->validate([
            'language_id' => 'required',
            'level' => 'required',
            
        ]);

        for ($i = 0; $i < count($request->language_id); $i++) {
            $language[] = [
                'user_id' => Auth::user()->id,
                'language_id' => $request->language_id[$i],
                'level' => $request->level[$i]
       
            ];
        }

        LanguageSkills::insert($language);

             return redirect()->route('profile')
        ->withSuccess('Language added Successfully');

    }

    public function pastJobs()
    {

    }
}
