<?php 
namespace App\Interfaces;

interface CategoryServiceInterface
{
    public function index();
    public function store($request);
    public function edit($id);
    public function update($id,$request);
    public function destroy($id);
    public function showMyCategores($id);	
}