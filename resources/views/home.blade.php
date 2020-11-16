@extends('layouts.app')
@section('title', $title)
@section('content')
@if ( !$posts->count() )
There is no FoodShare till now. Login and write a new FoodShare now!!!
@else
<div class="container">
    @foreach( $posts as $post )
    <div class="card border-primary mb-3" style="max-width: 740px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                @if (!($flag = $post->image == ""))
                <img src="{{ asset('posts/imgs/'.$post->image) }}"
                    class="card-img" alt="image">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">

                    <h5 class="card-title">
                        <a
                            href="{{ url('/'.$post->slug) }}">{{ $post->title }}</a>
                        @if(!Auth::guest() && ($post->author_id ==
                        Auth::user()->id ||
                        Auth::user()->is_admin()))
                        @if($post->active == '1')
                        <a href="{{ url('edit/'.$post->slug)}}"><svg width="1em"
                                height="1em" viewBox="0 0 16 16"
                                class="bi bi-pencil-square" fill="#FF5733"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg></a>
                        @else
                        <button class="btn" style="float: right"><a
                                href="{{ url('edit/'.$post->slug)}}">Edit
                                Draft</a></button>
                        @endif
                        @endif
                    </h5>

                    <article class="card-text">
                        {!! Str::limit($post->body, $limit = 250, $end =
                        '....... <a href='.url("/".$post->slug).'>Read
                            More</a>') !!}
                    </article>

                    <p class="card-text">
                        <small
                            class="text-muted">{{ $post->created_at->diffForHumans() }}
                            By <a
                                href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a>
                        </small>
                    </p>
                    {{-- <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }}
                    By <a
                        href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a>
                    </p> --}}
                </div>
            </div>
        </div>
    </div>
    @endforeach
    {!! $posts->render() !!}
</div>
@endif
@endsection
