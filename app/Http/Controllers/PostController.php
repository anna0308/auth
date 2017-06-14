<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user  = Auth::user();
        $posts = $user->posts;
        return view('post/posts',['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $categories = $user->categories; 
        return view('post/create',['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'title' =>  'required',
                'text'  =>  'required',
            ]);
        Post::create([
            'title'      => $request->title,
            'text'       => $request->text,
            'category_id'   => $request->category_id,
        ]);
        return redirect('/posts')->with('status', 'New Post added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    // Display all resourse
    public function showAllPosts()
    {
        $user  = Auth::user();
        $posts = $user->posts;
        $all_posts = Post::all();
        $other_posts = $all_posts->diff($posts);
        return view('post/all',['posts' => $posts,'other_posts' =>$other_posts]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $user = Auth::user();
        $categories = $user->categories;
        return view('post/edit', ['post' => $post,'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if(Post::where('id', $id)->update(['title' => $request->input('title'),'text' => $request->input('text'),
            'category_id' => $request->input('category_id') ])) {
            return redirect('/posts');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Post::where('id',$id)->delete()) 
        {
            return back();
        } 
    }
}
