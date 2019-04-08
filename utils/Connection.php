<?php 


class  Connection{

 	private $host = "localhost";
 	private $user = "root";
 	private $pw = "123456";
    private $db = "api";
 	private $conn;


 	function __construct()
 	{
 
 	}

 	public function connect(){

    $this->conn=new mysqli($this->host,$this->user,$this->pw,$this->db);
    
       if ($this->conn->connect_error) 
       {
    		throw new Exception("Connection failed: " . $this->conn->connect_error);
       }
       	
		return $this->conn;
 }


}

