<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\User;
use App\Category;
use App\Post;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count_user = User::count();
        $count_post = Post::count();
        $count_category = Category::count();
        return response()->json(['count_user' => $count_user, 'count_post' => $count_post, 
            'count_category' => $count_category]);
    }

}
