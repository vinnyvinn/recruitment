<?php

namespace Boaz;

use Illuminate\Database\Eloquent\Model;

class ProfessionalCertification extends Model
{
    //
    protected $fillable = ['user_id', 'certification', 'dateacquired', 'expirationdate'];
    protected $casts = [
		'certification' => 'string',
		'dateacquired' => 'string',
		'expirationdate' => 'string',
	
    ];
}
