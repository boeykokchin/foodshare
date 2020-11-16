@extends('layouts.app')
@section('title', 'Edit FoodShare')
@section('content')
{{-- <script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}">
</script> --}}
{{-- <script
    src="https://cdn.tiny.cloud/1/uaseaa8scku1ckadx321408l4hwzqb4r0v2gob5ba1h75pkm/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
<script type="text/javascript">
    tinymce.init({
    selector: "textarea",
    plugins: ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
  });
</script> --}}

<form method="post" action='{{ route('update') }}'
    enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="post_id"
        value="{{ $post->id }}{{ old('post_id') }}">
    <div class="form-group">
        <input required="required" placeholder="Enter title here" type="text"
            name="title" class="form-control"
            value="@if(!old('title')){{$post->title}}@endif{{ old('title') }}" />
    </div>
    <div class="form-group">
        <textarea name='body' class="form-control">
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
        <input type="file" class="form-control-file" name="image"
            value="{{ $post->image }}">
    </div>
    @if($post->active == '1')
    <input type="submit" name='publish' class="btn btn-success"
        value="Update" />
    @else
    <input type="submit" name='publish' class="btn btn-success"
        value="Publish" />
    @endif
    <input type="submit" name='save' class="btn btn-default"
        value="Save As Draft" />
    <a href="{{  url('delete/'.$post->id.'?_token='.csrf_token()) }}"
        class="btn btn-danger">Delete</a>
</form>
@endsection
