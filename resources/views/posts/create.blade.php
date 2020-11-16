@extends('layouts.app')
@section('title', 'Add New FoodShare')
@section('content')

<form action="{{ route('newPost') }}" method="post"
    enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <input required="required" value="{{ old('title') }}"
            placeholder="Enter FoodShare title here (max. 50 chars)" type="text"
            name="title" class="form-control" maxlength="50" />
    </div>
    <div class="form-group">
        <textarea name='body' class="form-control" maxlength="500"
            placeholder="Enter FoodShare description here (max. 500 chars)">{{ old('body') }}</textarea>
    </div>
    <div class="form-group">
        {{-- <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Choose
                file</label>
        </div> --}}
        <label for="imagefile">FoodShare Picture</label>
        <input name="image" type="file" class="form-control-file"
            id="imagefile">
    </div>
    <input type="submit" name='publish' class="btn btn-success"
        value="Publish" />
    <input type="submit" name='save' class="btn btn-secondary"
        value="Save Draft" />
</form>

@endsection
