<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Category;
use App\Post;

class PostController extends Controller
{
	public function index(Post $post)
	{
		$posts = $post->get();
		return response()->json(['posts' => $posts]);
	}
}