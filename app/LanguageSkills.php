<?php

namespace Boaz;

use Illuminate\Database\Eloquent\Model;
use Boaz\Language;
use Boaz\User;

class LanguageSkills extends Model
{
    //
    protected $fillable = ['user_id', 'language_id', 'level'];
    protected $casts = [
		'language_id' => 'integer',
		'level' => 'string',
	
    ];
    public function languages()

    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'user_id');
    }
}
