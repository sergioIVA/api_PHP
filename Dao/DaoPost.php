<?php
//require 'utils/Connection.php';

class DaoPost
{
	private $connection; 

	function __construct()
	{
		$this->connection=new Connection();	
	}

	public function createPost($post){
		

        $connect=$this->connection->connect();

        $title=$post->getTitle();
        $author=$post->getAuthor();
        $content=$post->getContent();
        $id=0;
        $dateCreated="".date("Y/m/d");
        $dateUpdated="";

	    // prepare and bind
		$stmt =$connect->prepare("INSERT INTO post (id,title,author,content,dateCreated,dateUpdated) VALUES (?,?,?,?,?,?)");

		$stmt->bind_param('isssss',$id,$title,$author,$content,$dateCreated,$dateUpdated);

		 if($stmt->execute())
		 {
		 	$post->setId($stmt->insert_id);
		 	$post->setDataCreated($dateCreated);
		 }
		 else
		 {
		 	$post=null;
		 }

		$stmt->close();
		$connect->close();

		return $post;
	}
}