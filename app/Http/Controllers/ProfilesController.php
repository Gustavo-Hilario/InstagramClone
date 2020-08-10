<?php

namespace App\Http\Controllers;

//TO IMPORT THE USER CLASS
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{

    public function index()
    {
        alert('You are in Index Profiles');
    }

    public function show(User $user)
    {

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember('count.posts.' . $user->id,
            now()->addSeconds(30),
            function() use($user) {
                return $user->posts->count();
            });

        $followersCount = Cache::remember('count.followers.' . $user->id,
            now()->addSeconds(30),
            function() use($user) {
                return $user->profile->followers->count();
            });

        $followingCount = Cache::remember('count.following.' . $user->id,
            now()->addSeconds(30),
            function() use($user) {
                return $user->following->count();
            });

        // dd($follows);

        return view('profiles.show', [
            'user' => $user,
            'follows' => $follows,
            'postCount' => $postCount,
            'followersCount' => $followersCount,
            'followingCount' => $followingCount,

        ]);
    }

	// //WE WILL RUN INDEX AND RETURN OUR VIEW
 //    public function index($user)
 //    {
 //    	// CREATING USER VARIABLE AND PASSING IT TO OUR VIEW
 //    	// apenas find antes nos dava erro com um user inexistente
 //    	// findOrFail show us a 404page error when the user does not exist
 //
        // $user = User::findOrFail($user);
 //        return view('profiles.index', [
 //        	'user' => $user
 //        ]);
 //    }

    // Now I can acess user just with \App\User and I can import it at the top
    public function edit(User $user)
    {
        // Just autorize the user of this profile. Created by our new ProfilePolicy
        $this->authorize('update', $user->profile);
        return view('profiles/edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);
        // Validating data
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            // See Laravel Url Validation Rule for understand the next line
            'url' => 'url',
            'image' => '',
        ]);

        if(request('image')){

            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        // When I use in this way every user can chance the data
        // $user->profile->update($data); I need to verify if it is a authorized user

        // In this method the second array image overwrite the value of image to be a PATH

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? [],
        ));

        // dd($data);
        return redirect("/profile/{$user->id}");
    }
}
