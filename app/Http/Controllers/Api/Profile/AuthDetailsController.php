<?php

namespace Boaz\Http\Controllers\Api\Profile;

use Boaz\Events\User\UpdatedProfileDetails;
use Boaz\Http\Controllers\Api\ApiController;
use Boaz\Http\Requests\User\UpdateProfileDetailsRequest;
use Boaz\Http\Requests\User\UpdateProfileLoginDetailsRequest;
use Boaz\Repositories\User\UserRepository;
use Boaz\Transformers\UserTransformer;

/**
 * Class DetailsController
 * @package Boaz\Http\Controllers\Api\Profile
 */
class AuthDetailsController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Updates user profile details.
     * @param UpdateProfileLoginDetailsRequest $request
     * @param UserRepository $users
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProfileLoginDetailsRequest $request, UserRepository $users)
    {
        $user = $request->user();

        $data = $request->only(['email', 'username', 'password']);

        $user = $users->update($user->id, $data);

        return $this->respondWithItem($user, new UserTransformer);
    }
}
