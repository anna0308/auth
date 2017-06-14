@extends('layouts.app')
@section('content')
		<a href="{{ url('/categories/create')}}" class="btn btn-success">Create Category</a>
		<div>
 			@foreach($categories as $category)
    			<div style="width: 600px;border:2px solid silver;margin:0 auto;overflow:hidden;">
	    			<span style="float:left; padding-left:10px" >
	    				{{ $category->title }}
	    			</span>
	    			<a href="{{ url('/categories/'.$category->id.'/edit') }}" class="btn btn-success" style="float:right;">Edit</a>
	    			<form method="post" action="{{ url('/categories/'.$category->id) }}" accept-charset="UTF-8">
                    	{{ csrf_field() }}
                    	<input type="hidden" name="_method" value="DELETE">

	    				<button type="submit" class="btn btn-danger" style="float:right;">Delete</button>
	    			</form>
    			</div>
  			@endforeach
  			@foreach($other_categories as $other_category)
    			<div style="width: 600px;border:2px solid silver;margin:0 auto;overflow:hidden;">
	    			<span style="float:left; padding-left:10px" >
	    				{{ $category->title }}
	    			</span>
    			</div>
  			@endforeach
		</div>

@endsection