<?php
namespace aht\Controllers;

use aht\Config\Database;
use aht\Models\TaskResourceModel;
use aht\Core\Controller;
use aht\Models\TaskModel;


class TasksController extends Controller
{   
    function index()
    {
        $model = new TaskModel();
        $tasks= new TaskResourceModel("tasks","id", $model);
        $d['tasks'] = $tasks->getAll($model);
        $this->set($d);
        $this->render("index");
    }   

    function create()
    {
        if (isset($_POST["title"]))
        {
            $model=new TaskModel();
            $model->title = $_POST["title"];
            $model->description = $_POST["description"];
            $model->created_at = date('Y-m-d H:i:s');
            // $model->setTitle($_POST["title"]);
            // $model->setDescription($_POST["description"]);
            // $model->setCreated_At(date('Y-m-d H:i:s'));
            $tasks= new TaskResourceModel("tasks","id", $model);

            if ($tasks->create($model))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }

        $this->render("create");
    }

    function edit($id)
    {
        $model=new TaskModel();
        $tasks= new TaskResourceModel("tasks","id", $model);
        $d["model"] = $tasks->get($id);
        if (isset($_POST["title"]))
        {
            $model->id = $d["model"]["id"];
            $model->title = $_POST["title"];
            $model->description = $_POST["description"];
            // $model->setId($d["model"]["id"]);
            // $model->setTitle($_POST["title"]);
            // $model->setDescription($_POST["description"]);
            if ($tasks->edit($model))    
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    function delete($id)
    {
        $model = new TaskModel();
        $tasks =new TaskResourceModel("tasks","id",$model);
        $model = $tasks->get($id);
        if ($tasks->delete($model))
        {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}

