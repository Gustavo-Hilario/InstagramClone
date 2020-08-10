@extends('layouts.app')

@push('scripts')
    {{--SPECIFIC JS FILE TO THIS VIEW--}}
    <script type="text/javascript" src="{{ asset('js/profile_index.js') }}"></script>
@endpush

@push('styles')
    {{--SPECIFIC CSS FILE TO THIS VIEW--}}
    <link href="{{ asset('css/profile_index.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="container">
    <div class="row">
        <div class="col-6 col-lg-4 p-5" >
            <img class="rounded-circle w-100" src="{{ $user->profile->profileImage() }}" alt="FreeCodeCamp Logo">
        </div>
        <div class="col-6 col-lg-8 pt-5">
            <div class="row">
                <div class="col-9 p-0">
                    <h2 class="">{{ $user->username }}</h2>
                </div>
                <div class="col-3">
                    <!-- VUE COMPONENT -->
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 col-md-9 d-flex p-0 align-items-center">
                    <div class="mr-3"><strong>{{ $postCount }} </strong>posts</div>
                    <div class="mr-3"><strong>{{ $followersCount }} </strong>followers</div>
                    <div><strong>{{ $followingCount }} </strong>following</div>
                </div>
                <div class="col-12 col-md-3">
                    <!-- Using ProfilePolicy to authorize to update just the user of this profile -->
                    @can('update', $user->profile)
                        <button class="btn btn-sm btn-success">
                            <a href="/profile/{{ $user->id }}/edit " class="text-white">Edit Profile</a>
                        </button>
                    @endcan
                </div>
            </div>

            <div class="row pt-4 font-weight-bold">
                {{ $user->profile->title }}
            </div>

            <div class="row d-flex">
                <p class="m-0">
                    {{ $user->profile->description }}
                </p>
            </div>

            <div class="row font-weight-bold mt-2 mb-4">
                <a href="#">
                    {{ $user->profile->url }}
                </a>
            </div>

        </div>
    </div>


    @can('update', $user->profile)
        <div class="d-flex justify-content-center my-3">
            <div class="" style="border-top: 1px solid #000; border-bottom: 1px solid #000">
                <div>
                    <a href="/p/create">
                        New Post
                    </a>
                </div>
            </div>
            <div class="" style="border-top: 1px solid #000; border-bottom: 1px solid #000">

                {{--Another Content--}}

            </div>
        </div>
    @endcan


    <div class="row justify-content-center">
        @foreach($user->posts as $post)
            <div class="col-md-4 mb-4">
                <a href="/p/{{ $post->id }}">
                    <img class="w-100" style="height: 300px" src="/storage/{{ $post->image }}" alt="" id="post_image">
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
