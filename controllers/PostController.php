<?php 
require 'services/PostService.php';

 
class PostController
{
	private $postService;
	
	function __construct()
	{
		$this->postService=new PostService();
	}


   public function createPost($post){
   		return $this->postService->createPost($post);
   }


	
}