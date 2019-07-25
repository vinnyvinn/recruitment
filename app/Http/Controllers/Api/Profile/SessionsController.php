<?php

namespace Boaz\Http\Controllers\Api\Profile;

use Boaz\Http\Controllers\Api\ApiController;
use Boaz\Repositories\Session\SessionRepository;
use Boaz\Transformers\SessionTransformer;

/**
 * Class DetailsController
 * @package Boaz\Http\Controllers\Api\Profile
 */
class SessionsController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('session.database');
    }

    /**
     * Handle user details request.
     * @param SessionRepository $sessions
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(SessionRepository $sessions)
    {
        $sessions = $sessions->getUserSessions(auth()->id());

        return $this->respondWithCollection(
            $sessions,
            new SessionTransformer
        );
    }
}
