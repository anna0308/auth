@extends('layouts.app')
@section('content')
		
		<a href="{{ url('/posts/create')}}" class="btn btn-success">Create Post</a>
		<div>
 			@foreach($posts as $post)
    			<div style="width: 600px;border:2px solid silver;margin:0 auto;overflow:hidden;">
	    			<div class="media">
		      			<a class="pull-left" href="#">
		    				@if(!empty($post->image))
		    					<img class="media-object" style="width:200px" src="{{url('/images/'.$post->image) }}">
		    				@else
		    				<img class="media-object" style="width:200px" src="{{url('/images/logo.jpg') }}">
		 					@endif
		  				</a>
		  				<div class="media-body">
		    			<h4 class="media-heading" style="color:green"><span style="color:black">Title:</span>  {{$post->title}}</h4>
		          		<p>{{$post->text}}</p>
		       			</div>
		     		</div>
	    			<a href="{{ url('/posts/'.$post->id.'/edit') }}" class="btn btn-success" style="float:right;">Edit</a>
	    			<form method="post" action="{{ url('/posts/'.$post->id) }}" accept-charset="UTF-8">
                    	{{ csrf_field() }}
                    	<input type="hidden" name="_method" value="DELETE">
	    				<button type="submit" class="btn btn-danger" style="float:right;">Delete</button>
	    			</form>
    			</div>
  			@endforeach 
		</div>

@endsection