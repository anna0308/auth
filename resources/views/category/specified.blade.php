@extends('layouts.app')
@section('content')
<div class="container">
	<h2 style="color:blue"><span style="color:black">Category:</span>    {{ $category->title}}</h2>
  	<div class="well">
  		@if(empty($spec_posts[0]))
  			<h1>There are no posts...</h1>
  		@endif
	    @foreach($spec_posts as $spec_post)
    			<div style="width: 600px;border:2px solid silver;margin:0 auto;overflow:hidden;">
	    			<div class="media">
		      			<a class="pull-left" href="#">
		    				@if(!empty($spec_post->image))
		    					<img class="media-object" style="width:200px" src="{{url('/images/'.$spec_post->image) }}">
		    				@else
		    				<img class="media-object" style="width:200px" src="{{url('/images/logo.jpg') }}">
		 					@endif
		  				</a>
		  				<div class="media-body">
		    			<h4 class="media-heading" style="color:green"><span style="color:black">Title:</span>  {{$spec_post->title}}</h4>
		          		<p>{{$spec_post->text}}</p>
		       			</div>
		     		</div>
	    			<a href="{{ url('/posts/'.$spec_post->id.'/edit') }}" class="btn btn-success" style="float:right;">Edit</a>
	    			<form method="post" action="{{ url('/posts/'.$spec_post->id) }}" accept-charset="UTF-8">
                    	{{ csrf_field() }}
                    	<input type="hidden" name="_method" value="DELETE">
	    				<button type="submit" class="btn btn-danger" style="float:right;">Delete</button>
	    			</form>
    			</div>
  			@endforeach 
 	 </div>
</div>
@endsection