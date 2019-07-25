<?php

namespace Boaz;

use Illuminate\Database\Eloquent\Model;

class EducationBackground extends Model
{
    //
	protected $fillable = ['user_id','institution','startdate','enddate','areastudied_id', 'certificate_id', 'country_id'];
	
	protected $casts = [
		'institution' => 'string',
		'startdate' => 'string',
		'enddate' => 'string',
		'areastudied_id'	=> 'array',
		'certificate_id' => 'array',
		'country_id' => 'array',
    ];
    
     public function countries()
	    {
	        return $this->belongsTo('Boaz\Country', 'country_id');
	    }

	     public function studies()
	    {
	        return $this->belongsTo('Boaz\AreaStudy', 'areastudied_id');
	    }

	    public function achievement()
	    {
	    	return $this->belongsTo('Boaz\DegreeCertificate', 'certificate_id');
	    }
}
