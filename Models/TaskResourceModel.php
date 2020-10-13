<?php
namespace aht\Models;

use aht\Config\Database;
use aht\Models\TaskModel;
use aht\Core\Model;
use aht\Core\ResourceModel;
use PDO;

	class TaskResourceModel extends ResourceModel
	{
		
		public function __construct($table, $id, $model)
		{
			# code...
			$this->__init($table, $id, $model);
		}
		
	}
	
