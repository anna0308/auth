<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Auth;

class CategoryController extends Controller
{
    public function __construct(Category $category, Post $post)
    {
        $this->post = $post;
        $this->category = $category;
        $this->middleware('auth');
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $categories = $this->category->get(); 
        return response()->json(['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('category/create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required|max:25']);
        if($this->category->create(['title' => $request->title,'parent_id' => Auth::user()->id])) {
            //return redirect()->back()->with('status', 'New Category added successfully.');
            return response()->json(['status' => 'New Category added successfully.']);
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
        $category = $this->category->find($id);
        return response()->json(['category' => $category]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        if ($this->category->where('id', $id)->update(['title' => $request->input('title')])) {
            return response()->json(['status' => 'Updated successfully.']);
        } else {
            return response()->json(['status' => 'Something went wrong.']);
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

        if ($this->category->where('id',$id)->delete()) {
            $this->post->where('category_id',$id)->delete();
            return response()->json(['status' => 'Deleted successfully.']);
        } else {
            return response()->json(['status' => 'Something went wrong.']);
        }
    }

    public function showMyCategories()
    {
        $categories = $this->category->where('parent_id', Auth::user()->id)->get();
        //return view('category.my_categories', ['categories' => $categories]);
        return response()->json(['categories' => $categories]);
    }
}
