<?php

require 'Dao/DaoPost.php';

class PostService 
{

	private $daoPost;
	
	function __construct()
	{
		$this->daoPost=new DaoPost();
	}

	public function createPost($post){
		return $this->daoPost->createPost($post);
	}
}