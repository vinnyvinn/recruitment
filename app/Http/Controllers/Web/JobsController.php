<?php

namespace Boaz\Http\Controllers\Web;

use Illuminate\Http\Request;
use Boaz\Http\Controllers\Controller;
use Boaz\Job;
use Boaz\Designations;
use Boaz\Skill;
use Auth;
use Boaz\JobsApplications;
use Carbon\Carbon;
use Boaz\Notifications\JobApplied;
use Boaz\Repositories\User\UserRepository;
use Boaz\User;

class JobsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $vacancies = Job::all();
        $design = Designations::all();
        $skills = Skill::all();
        return view('jobs.index', compact('vacancies', 'design','skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $jobs = new Job();
        $jobs->designation_id = $request->get('designation_id');
        $jobs->no_position = $request->get('no_position');
        $jobs->job_type = $request->get('job_type');
        $jobs->experience = $request->get('experience');
        $jobs->age = $request->get('age');
        $jobs->job_location = $request->get('job_location');
        $jobs->salary_range = $request->get('salary_range');
        $jobs->post_date = $request->get('post_date');
        $jobs->ldate = $request->get('ldate');
        $jobs->cdate = $request->get('cdate');
        $jobs->status = $request->get('status');
        $jobs->jreference = Carbon::today();
        $jobs->short_description = $request->get('short_description');
        $jobs->description = $request->get('description');
        $jobs->user_id = Auth::user()->id;
        $jobs->save();
        $jobs->skills()->sync($request->skill_id, false);
        return redirect()->route('jobs.index')
        ->withSuccess('Job Vacancy added successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function applyjob(Request $request, $id)
    {
        
        $user = Auth::user();
        $job = Job::where('id', $id)->first();

        if($user->isAppliedOnJob($job->id))
		{
            return redirect()->route('jobDetail', $job->id)
            ->withSuccess('You have already applied for this job');
            exit;
           
        }
        $jobapplication = new JobsApplications();
        $jobapplication->user_id = Auth::user()->id;
        $jobapplication->job_id = $job->id;
        $jobapplication->status = JobsApplications::NOTVIEWED;
        $jobapplication->levels = JobsApplications::LEVELONE;
        $jobapplication->save();
        $jobapply= $job->designations->name;
        
        $user->notify(new JobApplied($jobapply));
        return redirect()->route('profile')
        ->withSuccess('You have successfully applied for this job');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $job= Job::findOrfail($id);
        $job->delete();
        return redirect()->route('jobs.index')
        ->withSuccess('You have successfully deleted the job Vacancy');
    }

    public function adminapplicantsview()
    {
        $applicants = JobsApplications::all();
        return view('jobs.adminview',compact('applicants'));
    }
}
