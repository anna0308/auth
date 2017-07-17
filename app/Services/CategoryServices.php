<?php
namespace App\Services;

use App\Category;
use App\Interfaces\CategoryServiceInterface;

class CategoryServices implements CategoryServiceInterface
{
	public function __construct(Category $category)
    {
       $this->category = $category;
    }

	public function index() 
	{
		return $this->category->get();
	}

	public function store($request)
	{
		return $this->category->create($request);
	}

	public function edit($id)
	{
		return $this->category->find($id);
	}

	public function update($id,$request)
	{
		return $this->category->where('id', $id)->update($request);
	}

	public function destroy($id)
	{
		return $this->category->where('id',$id)->delete();
	}

	public function showMyCategores($id)
	{
		return $this->category->where('parent_id',$id)->get();
	}
}	
?>