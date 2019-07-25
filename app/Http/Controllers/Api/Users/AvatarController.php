<?php

namespace Boaz\Http\Controllers\Api\Users;

use Illuminate\Http\Request;
use Boaz\Events\User\UpdatedByAdmin;
use Boaz\Http\Controllers\Api\ApiController;
use Boaz\Http\Requests\User\CreateUserRequest;
use Boaz\Http\Requests\User\UpdateUserRequest;
use Boaz\Http\Requests\User\UploadAvatarRawRequest;
use Boaz\Repositories\User\UserRepository;
use Boaz\Services\Upload\UserAvatarManager;
use Boaz\Support\Enum\UserStatus;
use Boaz\Transformers\UserTransformer;
use Boaz\User;

/**
 * Class AvatarController
 * @package Boaz\Http\Controllers\Api\Users
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
        $this->middleware('permission:users.manage');

        $this->users = $users;
        $this->avatarManager = $avatarManager;
    }

    /**
     * @param User $user
     * @param UploadAvatarRawRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(User $user, UploadAvatarRawRequest $request)
    {
        $name = $this->avatarManager->uploadAndCropAvatar(
            $user,
            $request->file('file')
        );

        $user = $this->users->update(
            $user->id,
            ['avatar' => $name]
        );

        event(new UpdatedByAdmin($user));

        return $this->respondWithItem($user, new UserTransformer);
    }

    /**
     * Update user's avatar to external resource.
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateExternal(User $user, Request $request)
    {
        $this->validate($request, [
            'url' => 'required|url'
        ]);

        $this->avatarManager->deleteAvatarIfUploaded($user);

        $user = $this->users->update(
            $user->id,
            ['avatar' => $request->url]
        );

        event(new UpdatedByAdmin($user));

        return $this->respondWithItem($user, new UserTransformer);
    }

    /**
     * Remove user's avatar and set it to null.
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        $this->avatarManager->deleteAvatarIfUploaded($user);

        $user = $this->users->update(
            $user->id,
            ['avatar' => null]
        );

        event(new UpdatedByAdmin($user));

        return $this->respondWithItem($user, new UserTransformer);
    }
}
