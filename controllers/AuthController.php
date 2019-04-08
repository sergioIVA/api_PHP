<?php

 require 'services/AuthService.php';



class AuthController{

	private $authService;

	function __construct()
	{
		$this->authService=new AuthService();
	}

	public function login($user)
	{
		return $this->authService->login($user);
	}

	public function register($user){
		return $this->authService->register($user);
	}
}