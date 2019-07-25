<?php

namespace Boaz;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    protected $fillable = [
    'filename'
  ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
