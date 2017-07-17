<?php
namespace App\Services;

use App\Post;
use App\Interfaces\PostServiceInterface;

class PostServices implements PostServiceInterface
{
	public function __construct(Post $post)
    {
       $this->post = $post;
    }

	public function index() 
	{
		return $this->post->get();
	}

	public function store($request)
	{
		return $this->post->create($request);
	}

	public function edit($id)
	{
		return $this->post->find($id);
	}

}	
?>