<?php 



class Post
{
	private $id;
    private $title;
    private $author;
    private $content;
    private $dateCreated;
    private $dateUpdated;

	function __construct($id,$title,$author,$content,$dataCreated,$dateUpdated)
	{
		$this->id=$id;
		$this->title=$title;
		$this->author=$author;
		$this->content=$content;
		$this->dataCreated=$dataCreated;
		$this->dateUpdated=$dateUpdated;
	}

	public function getId()
	{

		return $this->id;
	}

	public function getTitle()
	{

		return $this->title;
	}

	public function getAuthor()
	{

		return $this->author;
	}


	public function getContent()
	{

		return $this->content;
	}

	public function getDateCreated()
	{

		return $this->dataCreated;
	}

	public function getDateUpdated()
	{

		return $this->dateUpdated;
	}

	public function setId($id)
	{

	 	 $this->id=$id;
	}

	public function setTitle($title)
	{

		 $this->title=$title;
	}

	public function setAuthor($author)
	{

		 $this->author=$author;
	}


	public function setContent($content)
	{

		  $this->content=$content;
	}

	public function setDataCreated($dataCreated)
	{

		  $this->dataCreated=$dataCreated;
	}

	public function setDateUpdated($dateUpdated)
	{

	     $this->dateUpdated=$dateUpdated;
	}
	
	
	
}