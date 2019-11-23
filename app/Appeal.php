<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appeal extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'message',
    ];

    public function appeals_changes () {
    	return $this->hasMany('App\AppealsChange');
  	}
}
