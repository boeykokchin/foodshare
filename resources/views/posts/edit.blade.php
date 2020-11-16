@extends('layouts.app')
@section('title', 'Edit FoodShare')
@section('content')

<form method="post" action='{{ route('update') }}'
    enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="post_id"
        value="{{ $post->id }}{{ old('post_id') }}">
    <div class="form-group">
        <input required="required"
            placeholder="Enter FoodShare title here (max. 50 chars)" type="text"
            maxlength="50" name="title" class="form-control"
            value="@if(!old('title')){{$post->title}}@endif{{ old('title') }}" />
    </div>
    <div class="form-group">
        <textarea name='body' class="form-control" maxlength="500"
            placeholder="Enter FoodShare description here (max. 500 chars)">
            @if(!old('body'))
            {!! $post->body !!}
            @endif
            {!! old('body') !!}
        </textarea>
    </div>
    @if (!($post->image == ""))
    <div class="form-group">
        <img src="{{ asset('posts/imgs/'.$post->image) }}" alt="image"
            height="150">
    </div>
    @endif
    <div class="form-group">
        <label for="imagefile">FoodShare Picture</label>
        <input name="image" type="file" class="form-control-file" id="imagefile"
            value="{{ $post->image }}">
        {{-- <input type="file" class="form-control-file" name="image"
            value="{{ $post->image }}"> --}}
    </div>
    @if($post->active == '1')
    <input type="submit" name='publish' class="btn btn-success"
        value="Update" />
    @else
    <input type="submit" name='publish' class="btn btn-success"
        value="Publish" />
    @endif
    <input type="submit" name='save' class="btn btn-secondary"
        value="Save As Draft" />
    <a href="{{  url('delete/'.$post->id.'?_token='.csrf_token()) }}"
        class="btn btn-danger">Delete</a>
</form>
@endsection
