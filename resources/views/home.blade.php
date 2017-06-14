@extends('layouts.app')
@section('content')
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<div class="nav-side-menu" style="margin-left:100px;">
    <div class="brand"><strong>Menu</strong></div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">
                
                <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                  <a href="#"><i class="fa fa-users fa-lg"></i> Users <span class="arrow"></span></a>
                </li>
                <li data-toggle="collapse" data-target="#service" class="collapsed">
                  <a href="#"><i class="fa fa-globe fa-lg"></i> Categories <span class="arrow"></span></a>
                </li>  
                <ul class="sub-menu collapse" id="service">
                  <li>My Categories</li>
                  <li>All Categories</li>
                </ul>
                <li data-toggle="collapse" data-target="#new" class="collapsed">
                  <a href="#"><i class="fa fa-envelope"></i> Posts<span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="new">
                  <li>My Posts</li>
                  <li>All Posts</li>
                </ul>
            </ul>
     </div>
</div>
@endsection
