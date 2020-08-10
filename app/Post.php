<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	// Saying to Laravel that is ok to fill our data from p/create
	protected $guarded = [];
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
