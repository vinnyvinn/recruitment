<?php

namespace Boaz;

use Illuminate\Database\Eloquent\Model;

class Designations extends Model
{
    //

    public function departments()
    {
        return $this->belongsTo('Boaz\Departments', 'department_id');
    }
}
