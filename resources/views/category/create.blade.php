@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2"> 
            <div class="col-md-6">
                <h3>Add New Category</h3>
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
                <form method="post" action="{{ url('/categories') }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    
                    <div class="form-group ">
                        <label for="Title:">Category-title:</label>
                        <input class="form-control" placeholder="Enter Title" name="title" type="text">
                         @if ($errors->has('title'))
                            <span class="help-block">
                                <strong style="color:red;">{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Add New</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

@endsection
