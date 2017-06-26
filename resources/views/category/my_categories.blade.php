@extends('layouts.app')
@section('content')
		<a href="{{ url('/categories/create')}}" class="btn btn-success">Create Category</a>
			<div>
		 		@foreach($categories as $category)
		    		<div style="width:800px;border:2px solid silver;overflow:hidden;margin:0 auto; ">
		    			<a href="{{ url('/categories/'.$category->id.'/posts') }}" style="text-decoration: none; color:black">
		    				<div style="width: 500px;float:left;padding-left:10px; ">
		    					Category-title:
			    				<span style="color:green;" >
			    				{{ $category->title }}
			    				</span>
		    				</div>
		    			</a>
		    			<div style="width:200px;float:right;">
			    			<a href="{{ url('/categories/'.$category->id.'/edit') }}" class="btn btn-success" style="float:right;">Edit</a>
			    			<form method="post" action="{{ url('/categories/'.$category->id) }}" accept-charset="UTF-8">
		                    	{{ csrf_field() }}
		                    	<input type="hidden" name="_method" value="DELETE">
			    				<button type="submit" class="btn btn-danger" style="float:right;margin-right:10px">Delete</button>
			    			</form>
	    				</div>
	    			</div>
		  			@endforeach
			</div>
@endsection