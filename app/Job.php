<?php

namespace Boaz;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    protected $id = ['id'];
    protected $dates = [
        'jreference'
    ];

    public function skills(){
        return $this->belongsToMany('Boaz\Skill', 'job_skill', 'job_id');
    }
    public function designations()
    {
        return $this->hasOne('Boaz\Designations', 'id', 'designation_id');
    }

}
