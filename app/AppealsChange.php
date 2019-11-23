<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppealsChange extends Model
{
    protected $fillable = [
        'user_id', 'appeal_id'
    ];

    public function user() {
    	return $this->belongsTo('App\User');
  	}

  	public function appeal() {
    	return $this->belongsTo('App\Appeal');
  	}
}
