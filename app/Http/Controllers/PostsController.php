<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
// with PHPStorm this import run automatically
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
	// REQUERING AN AUTHENTICATED USER TO SEE THIS VIEW AND LOGIC
	function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
        // Take all user that I am following
        // This code worked for teacher $users = auth()->user()->following->pluck('profiles.user_id');
        $users = auth()->user()->following->pluck('user_id');

        // $posts = Post::whereIn('user_id', $users)->orderBy('created_at', 'DESC')->get();
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
    	return view('posts.create');
    }

    public function store()
    {
    	$data = request()->validate([
    		'caption' => 'required',

    		//Validation Rules to be an Image 
    		'image' => ['required', 'image'],
    	]);

    	// In the next code we can say where we must wanna save our image file
    	// It could be Amazon S3 and others, for use now, just in our local environment
    	// This code below will show the files path: /storage/app/public/uploads
    	// dd(request('image')->store('uploads', 'public'));
    	$imagePath = request('image')->store('uploads', 'public');

    	// Using intervention/image package to fit the image -> cut to fit in a specific size
    	// And not resizing and change the proportions
    	$image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
    	$image->save();

    	// Taking the authenticated user, going inside posts function and create the data relationship
    	// Giving post a relation to user_id
    	auth()->user()->posts()->create([
    		'caption' => $data['caption'],
    		'image' => $imagePath,
    	]);

    	return redirect('/profile/' . auth()->user()->id);

    }

    // Using \App\Post we can automatically send all information of this post id
    // and also if Laravel can not find this post it will FAIL just like we set in ProfileController
    public function show(\App\Post $post)
    {
    	return view('posts.show', compact('post'));

 		// Or
    	// return view('posts.show', [
    	// 	'post' => $post,
    	// ]);
    	
    	// dd($post); to make the first test of our request and show post information
    }
}
