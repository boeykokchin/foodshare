@extends('layouts.app')
@section('title', 'Add New FoodShare')
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

<form action="{{ route('newPost') }}" method="post"
    enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <input required="required" value="{{ old('title') }}"
            placeholder="Enter title here" type="text" name="title"
            class="form-control" />
    </div>
    <div class="form-group">
        <textarea name='body' class="form-control">{{ old('body') }}</textarea>
    </div>
    <div class="form-group">
        <input type="file" class="form-control-file" name="image">
    </div>
    <input type="submit" name='publish' class="btn btn-success"
        value="Publish" />
    <input type="submit" name='save' class="btn btn-default"
        value="Save Draft" />
</form>

@endsection
