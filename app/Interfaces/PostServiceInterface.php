<?php 
namespace App\Interfaces;

interface PostServiceInterface
{
    public function index();
    public function store($request);
    public function edit($id);
}