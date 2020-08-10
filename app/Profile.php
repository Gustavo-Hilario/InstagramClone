<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	// Read more abou it. It's about mass assignment
	protected $guarded = [];

	public function profileImage()
	{
		$defaultImagePath = 'profile/XtETcIFGYoYe5ttRAnSoqy5GKU4DpBJU19o9UhIK.png';
		$imagePath = ($this->image) ? $this->image : $defaultImagePath;

		// return /storage and this image if we have OR this image receive our default image;
		return '/storage/' . $imagePath;
	}

	public function followers()
    {
        return $this->belongsToMany(User::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
