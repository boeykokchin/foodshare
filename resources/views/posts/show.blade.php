@extends('layouts.app')
@section('title')
@if($post)
{{ $post->title }}
@if(!Auth::guest() && ($post->author_id == Auth::user()->id ||
Auth::user()->is_admin()))
<a href="{{ url('edit/'.$post->slug)}}"><svg width="1em" height="1em"
        viewBox="0 0 16 16" class="bi bi-pencil-square" fill="#FF5733"
        xmlns="http://www.w3.org/2000/svg">
        <path
            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
        <path fill-rule="evenodd"
            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
    </svg></a>
@endif
@else
Page does not exist
@endif
@endsection
@section('title-meta')
{{-- <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a
    href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a>
</p> --}}
<p>{{ $post->created_at->diffForHumans() }} By <a
        href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a>
</p>
@endsection
@section('content')
@if($post)
<div class="card border-primary mb-3" style="max-width: 740px;">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="{{ asset('posts/imgs/'.$post->image) }}" class="card-img"
                alt="image">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <p class="card-text">{!! $post->body !!}</p>
            </div>
        </div>
    </div>
</div>


<div class="card border-success mb-3" style="max-width: 740;">
    <div class="card-body">
        <h5 class="card-title">What are your thoughts?</h5>
        @if(Auth::guest())
        <p>Login to give us your thoughts</p>
        @else
        <form method="post" action="/comment/add">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="on_post" value="{{ $post->id }}">
            <input type="hidden" name="slug" value="{{ $post->slug }}">
            <div class="form-group">
                <textarea required="required" placeholder="Enter comment here"
                    name="body" class="form-control"></textarea>
            </div>
            <input type="submit" name='post_comment' class="btn btn-success"
                value="Post" />
        </form>
        @endif
    </div>
</div>

<div>
    @if($comments)
    {{-- <ul style="list-style: none; padding: 0"> --}}
    <div class="card border-secondary mb-3" style="max-width: 740;">
        @foreach($comments as $comment)
        <div class="card-body">
            <div class="list-group">
                <div class="list-group-item">
                    <h3>{{ $comment->author->name }}</h3>
                    <p>{{ $comment->created_at->format('M d,Y \a\t h:i a') }}
                    </p>
                </div>
                <div class="list-group-item">
                    <p>{{ $comment->body }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@else
404 error
@endif
@endsection
