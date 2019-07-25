<?php

namespace Boaz\Http\Controllers\Api\Users;

use Boaz\Http\Controllers\Api\ApiController;
use Boaz\Repositories\Session\SessionRepository;
use Boaz\Transformers\SessionTransformer;
use Boaz\User;

/**
 * Class SessionsController
 * @package Boaz\Http\Controllers\Api\Users
 */
class SessionsController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:users.manage');
        $this->middleware('session.database');
    }

    /**
     * Get sessions for specified user.
     * @param User $user
     * @param SessionRepository $sessions
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(User $user, SessionRepository $sessions)
    {
        return $this->respondWithCollection(
            $sessions->getUserSessions($user->id),
            new SessionTransformer
        );
    }
}
