@extends('layouts.app')
@section('content')
<div class="container">
	<h2 style="color:blue"><span style="color:black">Category:</span>    {{ $category->title}}</h2>
  	<div class="well">
  		@if(empty($spec_posts[0]))
  			<h1>There are no posts...</h1>
  		@endif
  		@foreach($spec_posts as $spec_post)
	  		<div class="media">
		      	<a class="pull-left" href="#">
		    		<img class="media-object" src="http://placekitten.com/150/150">
		  		</a>
		  		<div class="media-body">
		    	<h4 class="media-heading">{{$spec_post->title}}</h4>
		          <p>{{$spec_post->text}}</p>
		       </div>
		     </div>
	    @endforeach
 	 </div>
</div>
@endsection