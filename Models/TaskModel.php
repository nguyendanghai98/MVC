<?php
namespace aht\Models;

use aht\Core\Model;

class TaskModel extends Model
{
	private $id;
    private $title;
    private $description;
    private $created_at;	
    private $updated_at;
    
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function setCreated_At($created_at)
    {
        $this->created_at = $created_at;
    }
    public function setUpdated_At($updated_at)
    {
        $this->updated_at = $updated_at;
    }
   

    public function getId()
    {
    	return $this->id;
	}
	public function getTitle()
	{
    	return $this->title;
	}
    public function getDescription()
    {
    	return $this->description;
	}
	public function getCreated_At()
	{
    	return $this->created_at;
	}
	public function getUpdated_At()
	{
    	return $this->updated_at;
	}
	
	public function __set($key, $value)
	{
    	$this->$key = $value;
	}
    public function __get($prop) 
    {
        return $this->$prop;
    }
}

