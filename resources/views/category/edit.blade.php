@extends('layouts.app')
@section('content')
		<div style='width: 600px;margin:0 auto;'>
 			<form method="post" action="{{ url('/categories/'.$category->id) }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group ">
                        <label for="Title:">Category-title:</label>
                        <input class="form-control" value="{{ $category->title }}" name="title" type="text">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
            </form>
		</div>
@endsection