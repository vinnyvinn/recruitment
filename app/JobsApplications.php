<?php

namespace Boaz;

use Boaz\Job;
use Boaz\User;
use Illuminate\Database\Eloquent\Model;

class JobsApplications extends Model
{
    //
    const NOTVIEWED = 3;
    const VIEWED = 7;
    const SUCCESSFULL = 9;
    const LEVELONE = 5;
    const LEVELTWO = 6;
    const LEVELTHREE = 8;

    public static function successful()
    {
        return self::SUCCESSFULL;
    }

    public static function notviewed()
    {
        return self::NOTVIEWED;
    }

    public static function viewed()
    {
        return self::VIEWED;
    }

    public static function levelone()
    {
        return self::LEVELONE;
    }

    public static function leveltwo()
    {
        return self::LEVELTWO;
    }

    public static function levelthree()
    {
        return self::LEVELTHREE;
    }

    public function jobs()

    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
