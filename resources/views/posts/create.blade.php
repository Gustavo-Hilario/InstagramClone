@extends('layouts.app')

@section('content')
<div class="container w-75" style="font-size: 1.2em;">
    <div class="col-8 offset-2">
        <div class="text-center">
            <h1 class="display-4">Add New Post</h1>
        </div>

<!-- enctype is necessary because we have a file in the form -->
        <form action="/p" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                    <div class="form-group row">
                        <label for="caption" class="col-md-4 col-form-label">Post Caption</label>

                        <input id="caption" type="text" class="p-0 form-control @error('caption') is-invalid @enderror" 
                        name="caption" value="{{ old('caption') }}" required autocomplete="caption" autofocus>

                        @error('caption')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

            </div>

            <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Post Image</label>
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
