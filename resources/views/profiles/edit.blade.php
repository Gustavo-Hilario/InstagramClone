@extends('layouts.app')

@section('content')
<div class="container w-75" style="font-size: 1.2em;">
    <div class="col-8 offset-2">
        <div class="text-center">
            <h1 class="display-4">Edit Profile</h1>
        </div>

<!-- enctype is necessary because we have a file in the form -->
        <form action="/profile/{{ $user->id }}" method="post" enctype="multipart/form-data">
            <!-- ECODING THIS FORM -->
            @csrf
            <!-- Change the post method to actually Patch -> UPDATE -->
            @method('PATCH')
            <div class="row">
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label">Title</label>

                        <input id="title" type="text" class="p-0 form-control @error('title') is-invalid @enderror" 
                        name="title" value="{{ old('title') ?? $user->profile->title }}" required autocomplete="title" autofocus>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

            </div>

            <div class="row">
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label">Description</label>

                        <input id="description" type="text" class="p-0 form-control @error('description') is-invalid @enderror" 
                        name="description" value="{{ old('description') ?? $user->profile->description }}" required autocomplete="description" autofocus>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

            <div class="row">
                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label">Url</label>

                    <input id="url" type="text" class="p-0 form-control @error('url') is-invalid @enderror" 
                    name="url" value="{{ old('url') ?? $user->profile->url }}" required autocomplete="url" autofocus>

                    @error('url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Profile Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">

                    @error('image')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <div class="text-center pt-4">
                <button type="submit" class="btn btn btn-success">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
