<?php

namespace Boaz\Events\User;

use Boaz\User;

class UpdatedByAdmin
{
    /**
     * @var User
     */
    protected $updatedUser;

    public function __construct(User $updatedUser)
    {
        $this->updatedUser = $updatedUser;
    }

    /**
     * @return User
     */
    public function getUpdatedUser()
    {
        return $this->updatedUser;
    }
}
