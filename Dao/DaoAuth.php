<?php

require 'utils/Connection.php';

class DaoAuth
{
	private $connection; 
	
	function __construct()
	{
		$this->connection=new Connection();	
	}


	public function login($user)
	{

		
			$connect=$this->connection->connect();
			$username=$user->getUsername();
			$userPassword=$user->getPassword();

			$stmt =$connect->prepare("select username,password from user where username=?");
			$stmt->bind_param('s',$username);
        	$stmt->execute();

        	$password="";
        	$stmt->bind_result($username,$password);

        	if ($stmt->fetch())
        	{
        		if(password_verify($userPassword,$password))
        		{
        	  		$user->setPassword("");
        		}
        		else
        		{

        		$user=null;
        		}

       		} else 
        	{ 
        		$user=null;
        	}	

		$stmt->close();
		$connect->close();


		return $user;
	}

	public function register($user)
	{
		
        $connect=$this->connection->connect();

        $username=$user->getUsername();
        $password=$user->getPassword();
        $id=0;

        /** module bcrypt **/
        $newPassword=password_hash($password, PASSWORD_DEFAULT);
       

	    // prepare and bind
		$stmt =$connect->prepare("INSERT INTO user (id,username,password) VALUES (?,?,?)");

		$stmt->bind_param('iss',$id,$username,$newPassword);
		$stmt->execute();

		$stmt->close();
		$connect->close();

		return true;

		}
	}
