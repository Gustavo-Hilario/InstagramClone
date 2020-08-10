@extends('layouts.app')

@section('content')
<div class="container" style="font-size: 1.2em;">
	@foreach($posts as $post)
		<div class="row mt-5">
            <div class="col-6 offset-3">
                <div class="card" style="width: 100%;">
                    <a href="/profile/{{ $post->user->id }}">
                        <img src="/storage/{{ $post->image }}" class="w-100">
                    </a>
                    <div class="card-body p-0">
                        <div class="card-title mx-4 my-4">
                            <a href="/profile/{{ $post->user->id }}">
                                <img src="{{ $post->user->profile->profileImage() }}" alt="UserProfilePhoto" class="rounded-circle w-100" style="max-width: 40px">
                            </a>
                            <span>
                                <strong>
                                    <a href="/profile/{{ $post->user->id }}">
                                        <span class="text-dark ml-2">{{ $post->user->username }}</span>
                                    </a>
                                </strong>
                            </span>
                        </div>
                        <div class="card-text mx-4">

                                {{ $post->caption }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>


	<!-- Make Pagination with method paginate -->
	<div class="row">
		<div class="col-6 offset-3 d-flex justify-content-center">
			{{ $posts->links() }}
		</div>
	</div>
</div>
@endsection
