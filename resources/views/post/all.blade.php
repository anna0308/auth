@extends('layouts.app')
@section('content')
		
		<a href="{{ url('/posts/create')}}" class="btn btn-success">Create Post</a>
		<div>
 			@foreach($posts as $post)
    			<div style="width: 600px;border:2px solid silver;margin:0 auto;overflow:hidden;">
	    			<span style="float:left; padding-left:10px">
	    				<strong style="color:black">Title::</strong>
	    				<strong><span style="color:green">{{ $post->title }}</span><strong><br>
	    				<span>{{$post->text}}</span>
	    			</span>
	    			<a href="{{ url('/posts/'.$post->id.'/edit') }}" class="btn btn-success" style="float:right;">Edit</a>
	    			<form method="post" action="{{ url('/posts/'.$post->id) }}" accept-charset="UTF-8">
                    	{{ csrf_field() }}
                    	<input type="hidden" name="_method" value="DELETE">
	    				<button type="submit" class="btn btn-danger" style="float:right;">Delete</button>
	    			</form>
    			</div>
  			@endforeach 
  			@foreach($other_posts as $other_post)
    			<div style="width: 600px;border:2px solid silver;margin:0 auto;overflow:hidden;">
	    			<span style="float:left; padding-left:10px">
	    				<strong style="color:black">Title::</strong>
	    				<strong><span style="color:green">{{ $other_post->title }}</span><strong><br>
	    				<span>{{$other_post->text}}</span>
	    			</span>
    			</div>
  			@endforeach 
		</div>

@endsection