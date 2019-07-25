<?php

namespace Boaz;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    protected $fillable = ['user_id','employer','startdate','enddate','designation_id', 'country_id'];

    
     public function designations()
	    {
	        return $this->belongsTo('Boaz\Designations', 'designation_id');
	    }

     public function countries()
	    {
	        return $this->belongsTo('Boaz\Country', 'country_id');
	    }
}


