@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="posts">
                                @if (isset($posts) && $posts->count() > 0)
                                    @foreach ($posts as $post)
                                        <div class="card mb-3">
                                            <div class="card-body">

                                                <h3 class="card-title">Title: {{ $post->title }} @if (Auth::id() == $post->user->id)
                                                        - oner post
                                                    @endif
                                                </h3>
                                                <h4 class="card-subtitle mb-2 text-muted">User Name: {{ $post->user->name }}
                                                </h4>
                                                <p class="card-text">Content: {{ $post->content }}</p>

                                                <hr>
                                                <div class="card">
                                                    <p class="card-text">Comments</p>

                                                    @if (count($post->comments) > 0)
                                                        @foreach ($post->comments as $comment)
                                                            - {{ $comment['comments'] }}
                                                            <hr>
                                                        @endforeach
                                                    @endif
                                                </div>


                                                @if (Auth::id() != $post->user->id)
                                                    @if (session('success'))
                                                        <div class="alert alert-success" role="alert">
                                                            {{ session('success') }}
                                                        </div>
                                                    @endif
                                                    <form action="{{ route('comment.save') }}" method="post"
                                                        class="comment">
                                                        @csrf
                                                        <div class="form-group">
                                                            <input type="hidden" name="post_id"
                                                                value="{{ $post->id }}">
                                                            <input type="hidden" name="user_id"
                                                                value="{{ $post->user->id }}">
                                                            <label for="comment">Comment</label>
                                                            <input type="text" class="form-control" name="comment"
                                                                placeholder="Add a comment">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
