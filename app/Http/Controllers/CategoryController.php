<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Interfaces\CategoryServiceInterface;
use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Auth;

class CategoryController extends Controller
{
    public function __construct(Category $category,Post $post)
    {
        $this->category = $category;
        $this->post = $post;
        $this->middleware('auth');
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(CategoryServiceInterface $categoryService)
    {
        $categories = $categoryService->index();
        return view('category/index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,CategoryServiceInterface $categoryService)
    {
        $this->validate($request, ['title' => 'required|max:25']);
        if($categoryService->store(['title' => $request->title,'parent_id' => Auth::user()->id])) {
            return redirect()->back()->with('status', 'New Category added successfully.');
        } else {
            return redirect()->back()->with('status', 'Something went wrong.');
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
    public function edit($id,CategoryServiceInterface $categoryService)
    {
        $category =  $categoryService->edit($id);
        return view('category/edit', ['category' => $category]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request,CategoryServiceInterface $categoryService)
    {
        if ($categoryService->update($id,['title' => $request->input('title')])) {
            return redirect('/categories');
        } else {
            return redirect('/categories')->with('status', 'Something went wrong.');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,CategoryServiceInterface $categoryService)
    {
        if ($categoryService->destroy($id)) {
            $this->post->where('category_id',$id)->delete();
            return redirect()->back();
        } else {
            return redirect('/categories')->with('status', 'Something went wrong.');
        }
    }

    public function showMyCategores(CategoryServiceInterface $categoryService)
    {
        $user_id = Auth::user()->id;
        $categories = $categoryService->showMyCategores($user_id);
        return view('category.my_categories', ['categories' => $categories]);
    }
}
