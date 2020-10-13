<h1>Tasks</h1>
<div class="row col-md-12 centered">
    <table class="table table-striped custab">
        <thead>
        <a href="/aht/tasks/create/" class="btn btn-primary btn-xs pull-right"><b>+</b> Add new task</a>
        <tr>
            <th>ID</th>
            <th>Task</th>
            <th>Description</th>
            <th class="text-center">Action</th>
        </tr>
        </thead>
        <?php
        use\Models\TaskModel;

        foreach ($tasks as $task)
        {
            echo '<tr>';
            echo "<td>" . $task->getId() . "</td>";
            echo "<td>" . $task->getTitle() . "</td>";
            echo "<td>" . $task->getDescription() . "</td>";
            echo "<td class='text-center'><a class='btn btn-info btn-xs' href='/aht/tasks/edit/" . $task->getId() . "' ><span class='glyphicon glyphicon-edit'></span> Edit</a> <a href='/aht/tasks/delete/" . $task->getId() . "' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span> Del</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>