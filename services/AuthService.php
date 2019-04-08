<?php

require 'Dao/DaoAuth.php';

class AuthService
{
	private $daoAuth;

	function __construct()
	{

		$this->daoAuth=new DaoAuth();
	}

	public function login($user)
	{

		return $this->daoAuth->login($user);	
	}

	public function register($user)
	{
		$this->daoAuth->register($user);
	}
}