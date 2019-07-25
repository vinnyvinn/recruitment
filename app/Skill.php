<?php

namespace Boaz;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //
    public function jobs(){
        return $this->belongsToMany('Boaz\Job', 'job_skill', 'job_id');
    }
}
