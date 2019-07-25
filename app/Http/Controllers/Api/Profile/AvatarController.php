<?php

namespace Boaz\Http\Controllers\Api\Profile;

use Illuminate\Http\Request;
use Boaz\Events\User\ChangedAvatar;
use Boaz\Http\Controllers\Api\ApiController;
use Boaz\Http\Requests\User\UploadAvatarRawRequest;
use Boaz\Repositories\User\UserRepository;
use Boaz\Services\Upload\UserAvatarManager;
use Boaz\Transformers\UserTransformer;

/**
 * Class DetailsController
 * @package Boaz\Http\Controllers\Api\Profile
 */
class AvatarController extends ApiController
{
    /**
     * @var UserRepository
     */
    private $users;
    /**
     * @var UserAvatarManager
     */
    private $avatarManager;

    public function __construct(UserRepository $users, UserAvatarManager $avatarManager)
    {
        $this->middleware('auth');

        $this->users = $users;
        $this->avatarManager = $avatarManager;
    }

    public function update(UploadAvatarRawRequest $request)
    {
        $name = $this->avatarManager->uploadAndCropAvatar(
            auth()->user(),
            $request->file('file')
        );

        $user = $this->users->update(
            auth()->id(),
            ['avatar' => $name]
        );

        event(new ChangedAvatar);

        return $this->respondWithItem($user, new UserTransformer);
    }

    public function updateExternal(Request $request)
    {
        $this->validate($request, [
            'url' => 'required|url'
        ]);

        $this->avatarManager->deleteAvatarIfUploaded(
            auth()->user()
        );

        $user = $this->users->update(
            auth()->id(),
            ['avatar' => $request->url]
        );

        event(new ChangedAvatar);

        return $this->respondWithItem($user, new UserTransformer);
    }

    /**
     * Remove avatar for currently authenticated user and set it to null.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy()
    {
        $user = auth()->user();

        $this->avatarManager->deleteAvatarIfUploaded($user);

        $user = $this->users->update(
            $user->id,
            ['avatar' => null]
        );

        event(new ChangedAvatar);

        return $this->respondWithItem($user, new UserTransformer);
    }
}
