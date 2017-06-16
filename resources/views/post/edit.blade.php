@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2"> 
            <div class="col-md-6">
                <h3>Add New Post</h3>
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                @if (session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                    </div>
                @endif
                <form method="post" action="{{ url('/posts/'.$post->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group ">
                        <label for="Title:">Title:</label>
                        <input class="form-control" value="{{ $post->title }}" name="title" type="text">
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong style="color:red;">{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                        <label for="Title:">Text:</label>
                        <textarea class="form-control" name="text" rows="6" cols="80">{{ $post->text }}</textarea>
                        @if ($errors->has('text'))
                            <span class="help-block">
                                <strong style="color:red;">{{ $errors->first('text') }}</strong>
                            </span>
                        @endif
                        <label for="Category:">Category:</label>
                        <select class="form-control" placeholder="Select Category" name="category_id">
                            @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                            <span class="help-block">
                                <strong style="color:red;">{{ $errors->first('category_id') }}</strong>
                            </span>
                        @endif
                        <span class="text-danger"></span>
                        <span class="text-danger"></span>
                         <span id="fileselector">
                            <label class="btn btn-default form-control" for="upload-file-selector">
                                <input id="upload-file-selector" type="file" name="image">
                                <i class="fa_icon icon-upload-alt margin-correction"></i>
                            </label>
                            @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong style="color:red;">{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

@endsection
