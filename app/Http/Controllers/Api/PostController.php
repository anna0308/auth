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
	
	public function __construct(Post $post)
    {
        $this->post = $post;
        // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
	{
		$posts = $post->get();
		$user_posts = Auth::user()->posts;
		$other_posts = $posts->diff($user_posts);
		return response()->json(['user_posts' => $user_posts, 'other_posts' => $other_posts]);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        $user_id = Auth::user()->id;
        $category_count = $category->where('parent_id', $user_id)->count();
        if ($category_count != 0) {
            $user       = Auth::user();
            $categories = $user->categories; 
            return response()->json(['categories' => $categories]);
        } else {
            return response()->json(['status' => 'First crate category.']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            if ($this->post->create($inputs)) {
                $image->move(public_path().'/images/', $image_name);
                return response()->json(['status' => 'New Post added successfully.']); 
            } else {
                return redirect()->back()->with('status', 'Something went wrong try again.');
            }
            
        } else {
            if ($this->post->create($inputs)) {
               return response()->json(['status' => 'New Post added successfully.']);
            } else {
               return response()->json(['status' => 'Something went wrong try again.']);
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
    public function edit($id)
    {
        $post = $this->post->find($id);
        $categories = Auth::user()->categories;
        return response()->json(['post' => $post, 'categories' => $categories]);
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
                 return response()->json(['status' => 'Updated successfully.']);
            } else {
               return response()->json(['status' => 'Something went wrong!!!']);
            }
        } else {
           if ($post->update($inputs)) {
                return response()->json(['status' => 'Updated successfully.']);
           } else {
               return response()->json(['status' => 'Something went wrong!!!']);
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
            return response()->json(['status' => 'Deleted successfully.']);
        } else {
            return response()->json(['status' => 'Something went wrong!!!']);
        }
    }

    public function showMyPosts()
    {
        $posts = Auth::user()->posts;
        return response()->json(['posts' => $posts]);
    }

    public function getPostsByCategoryId($id, Category $category)
    {
        $category=$category->where('id', $id)->first();
        $spec_posts = $this->post->where('category_id', $id)->get();
        return response()->json(['spec_posts' => $spec_posts,'category' => $category]);
    }
}