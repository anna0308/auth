<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Interfaces\PostServiceInterface;
use App\Interfaces\CategoryServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Category;
use App\Post;

class PostController extends Controller
{
    public function __construct(Post $post)
    {
        $this->post = $post;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostServiceInterface $postService)
    {
        $posts = $postService->index(); 
        return view('post/index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryServiceInterface $categoryService)
    {
        $user_id = Auth::user()->id;
        $categories = $categoryService->showMyCategores($user_id);
        if (count($categories) != 0) {
            return view('post/create',['categories' => $categories]);
        } else {
            return redirect('/posts')->with('status', 'First crate category.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,PostServiceInterface $postService)
    {
        $inputs = [
            'title'      => $request->title,
            'text'       => $request->text,
            'category_id'=> $request->category_id,
        ];
        $this->validate($request, [

            'title' =>  'required|max:25',
            'text'  =>  'required',
        ]);
        if ($request->hasFile('image')) {

            $this->validate($request, ['image' => 'mimes:jpeg,jpg,png,gif']);
            $image           = $request->image;
            $image_org       = $image->getClientOriginalName();
            $image_name      = time().rand().$image_org;
            $inputs['image'] = $image_name;
            if ($postService->store($inputs)) {
                $image->move(public_path().'/images/', $image_name);
                return redirect()->back()->with('status', 'New Post added successfully.');
            } else {
                return redirect()->back()->with('status', 'Something went wrong try again.');
            }
        } else {
            if ($postService->store($inputs)) {
               return redirect()->back()->with('status', 'New Post added successfully.');
            } else {
               return redirect()->back()->with('status', 'Something went wrong try again.');
            }
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
       
    // }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,PostServiceInterface $postService,CategoryServiceInterface $categoryService)
    {
        $post = $postService->edit($id);
        $categories = $categoryService->showMyCategores($id);
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
        $post = $this->post->where('id',$id)->first();
        $old_image=$post->image;
        $inputs = [
                    'title'      => $request->title,
                    'text'       => $request->text,
                    'category_id'=> $request->category_id,
                  ];
        $this->validate($request, [

                'title' =>  'required|max:25',
                'text'  =>  'required',
            ]);
        if ($request->hasFile('image')) {

            $this->validate($request, [
                'image' =>  'mimes:jpeg,jpg,png,gif',
            ]);
            $image = $request->image;
            $image_org= $image->getClientOriginalName();
            $image_name=time().rand().$image_org;
            $inputs['image'] = $image_name;
            if ($post->update($inputs)) {

                $image->move(public_path().'/images/', $image_name);
                if (!empty($old_image)) {

                    $file_path=public_path().'/images/'.$old_image;
                    unlink($file_path);
                }

                return redirect('/post/my_post');
            } else {

                return redirect()->back()->with('status', 'Something went wrong!!!');
            }
        } else {
           
           if ($post->update($inputs)) {

                return redirect('/post/my_post');

           } else {

               return redirect()->back()->with('status', 'Something went wrong!!!'); 
           }
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
        if ($this->post->where('id',$id)->delete()) {

            return redirect()->back();

        } else {

            return redirect()->back()->with('status', 'Something went wrong!!!');
        }
    }

    public function showMyPosts()
    {
        $posts = Auth::user()->posts;
        return view('post.my_posts', ['posts' => $posts]);
    }

    public function getPostsByCategoryId($id, Category $category)
    {
        $category=$category->where('id', $id)->first();
        $spec_posts = $this->post->where('category_id', $id)->get();
        return view('category/specified',['spec_posts' => $spec_posts,'category' => $category]);
    }
}
