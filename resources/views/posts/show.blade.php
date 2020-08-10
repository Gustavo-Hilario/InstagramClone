@extends('layouts.app')

@section('content')
<div class="container" style="font-size: 1.2em;">
	<div class="row">
		<div class="col-8">
    		<img src="/storage/{{ $post->image }}" class="w-100">
		</div>
		<div class="col-4">
			<div class="row d-flex align-items-center mb-4">
				<div>
					<img src="{{ $post->user->profile->profileImage() }}" alt="UserProfilePhoto" class="rounded-circle w-100" style="max-width: 40px">
				</div>
				<div class="d-flex pl-3">
					<div class="pr-3">
						<strong>
							<a href="/profile/{{ $post->user->id }}">
								<span class="text-dark">{{ $post->user->username }}</span>
							</a>
						</strong>
					</div>

					<div class="pl-3">
						<button class="btn btn-sm btn-success">
							<a href="#">Follow</a>
						</button>
					</div>
				</div>
			</div>

			<hr>

			<div class="row pl-3 pt-3">
				<p>
					<span>
						<strong>
							<a href="/profile/{{ $post->user->id }}">
								<span class="text-dark">{{ $post->user->username }}</span>
							</a>
						</strong>
					</span>
					{{ $post->caption }}
				</p>
			</div>
		</div>
	</div>
</div>
@endsection
