@extends('layouts.app')
@section('title', $title)
@section('content')
@if ( !$posts->count() )
There is no FoodShare till now. Login and write a new FoodShare now!!!
@else
<div class="">
    @foreach( $posts as $post )
    <div class="list-group">
        <div class="list-group-item">
            <h3><a href="{{ url('/'.$post->slug) }}">{{ $post->title }}</a>
                @if(!Auth::guest() && ($post->author_id == Auth::user()->id ||
                Auth::user()->is_admin()))
                @if($post->active == '1')
                <button class="btn" style="float: right"><a
                        href="{{ url('edit/'.$post->slug)}}">Edit
                        FoodShare</a></button>
                @else
                <button class="btn" style="float: right"><a
                        href="{{ url('edit/'.$post->slug)}}">Edit
                        Draft</a></button>
                @endif
                @endif
            </h3>
            {{-- <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a
                href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a>
            </p> --}}
            <p>{{ $post->created_at->diffForHumans() }} By <a
                    href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a>
            </p>
        </div>
        @if (!($flag = $post->image == ""))
        <div class="list-group-item">
            <img src="{{ asset('posts/imgs/'.$post->image) }}" alt="image"
                height="150">
        </div>
        @endif
        <div class="list-group-item">
            <article>
                {!! Str::limit($post->body, $limit = 1500, $end = '....... <a
                    href='.url("/".$post->slug).'>Read More</a>') !!}
            </article>
        </div>
    </div>
    @endforeach
    {!! $posts->render() !!}
</div>
@endif
@endsection

{{-- @extends('layouts.app')

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
</div>
</div>
</div>
@endsection --}}
