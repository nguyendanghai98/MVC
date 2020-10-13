<?php
namespace aht\Core;

use aht\Config\Database;
use aht\Models\TaskModel;
use aht\Core\Model;
use aht\Core\ResourceModel;
use PDO;
class ResourceModel implements ResourceModelInterface
{	
	public $table;
	public $id;
	public $model;

	public function __init($table, $id, $model)
	{
		$this->table = $table;
		$this->id = $id;
		$this->model = $model;
	}
	public function save($model)
	{	
        $properties = $this->model->getProperties();

        if($model->getId() == null){
        	//echo $model->getTitle()."<br>";
            //echo $model->getDescription()."<br>";
            
            $str1 = "";
	        $str2 = "";
           
	        for ($i = 0; $i < count($properties); $i++) {
	            if ($properties[$i] != $this->id) {
	                $str1.=  $properties[$i] . ",";
	                $str2.=  ":" . $properties[$i] . ","; 
	            }
	        }
	        $str1 = substr($str1, 0, strlen($str1)-1);
	       	$str2 = substr($str2, 0, strlen($str2)-1);
	        $params = [];
        
	        for ($i = 0; $i < count($properties); $i++) {
	            if ($properties[$i] != $this->id) {
	                $params[$properties[$i]] = $model->{$properties[$i]};
	            }
	        }
	        $sql = "INSERT INTO $this->table ($str1) VALUES ($str2)";
	        echo $sql;
	        $req = Database::getBdd()->prepare($sql);
	        return $req->execute($params);
        }
        else{
            $model_update = [];
            $str = "";
    
            for ($i=0; $i < count($properties); $i++) { 
                if($properties[$i] != $this->id && $properties[$i] != "created_at"){
                    $model_update[$properties[$i]] = $model->{$properties[$i]};
                    $str = $str . "$properties[$i]=:$properties[$i]," ;
                }
            }
            $model_update[$this->id] = $model->id;
            $model_update["updated_at"] = date('Y-m-d H:i:s');
            
            $str = rtrim($str, ",");
    
            $sql = "UPDATE $this->table SET $str WHERE $this->id=:$this->id";
    
            $req = Database::getBdd()->prepare($sql);
    
            return  $req->execute($model_update);
        }
    
	}

	public function delete($model)
	{
		$model_delete[$this->id] = $model[$this->id];
	    $sql = "DELETE FROM $this->table WHERE $this->id=:$this->id";
        echo $sql;
        $req = Database::getBdd()->prepare($sql);
        return $req->execute($model_delete);
	}

	public function getAll($model)
	{
		$class_name = get_class($this->model);
        $sql  = "SELECT * FROM " . $this->table;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        $array_obj=[];
        $array = $req->fetchAll();
        for ($i = 0; $i <count($array); $i++) {
            $task = new $class_name;
            foreach ($array[$i] as $key => $value) {
                $task->$key = $value;
            }
            array_push($array_obj, $task);
        }
        return $array_obj;
	}

	public function get($id)
	{	
		$sql = "SELECT * FROM $this->table WHERE $this->id = $id";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
        
	}

    public function edit($model)
    {
        return $this->save($model);
    }

    public function create($model)
    {
        return $this->save($model);
    }
}
