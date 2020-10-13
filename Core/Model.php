<?php

namespace aht\Core;

use ReflectionClass;
use aht\Models\TaskModel;

class Model
{   
	public function getProperties()
	{	

    	$reflection = new ReflectionClass($this);
        $proper = $reflection->getProperties();

        $properties=[];
        $i=0;
        foreach ($proper as $prop) 
        {
        	$properties[$i++]=$prop->getName();	
        }
        
        return $properties;
	}
}
