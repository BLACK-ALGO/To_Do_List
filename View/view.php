<?php 

require 'php/query.php'; 
// require 'View/update.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <title>Document</title>
    
    
</head>
<body>
    <div class="main" >
        <!-- modal to add new task -->
        <div class="modal">
            <button class="add_task"  onclick="openPopUp()">Create Task</button>
            <div class="popup" id="popup">
                <h2>ADD NEW TASK</h2>
                <!-- form to add a new task -->
                <form action=".\php\query.php?mnu=add" method="post">
                        <div class="input_class">
                            <label for="taskName">Task Name</label>
                            <input type="text" name="taskName" id="" placeholder="Buy a new computer" required>
                        </div>
                        <div class="input_class">
                            <label for="taskName">Task Descrition</label>                       
                            <textarea id="taskDescription" name="taskDescription" rows="5" cols="60"  required>
                            </textarea>
                        </div>
                        <div class="btn_div">                            
                            <div class="close_btn" onclick="closePopUp()">Close</div>
                            <button class="save_btn" type="submit">Save</button>
                        </div>
                </form>
            </div>
        </div>

        <!-- displaying the to list -->
        <div class="display_task">
            <div class="incompleted_list">
            <h2>inCompleted Task</h2>
                <div class="table-wrapper scrol-div-Instance">
                <table class="fl-table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date of Creation</th>
                    <th>Action</th>
                    
                </tr>
                </thead>
                <tbody>
                <?php 
                    $tasks = displayTask();

                global $tasks;
                if (!empty($tasks)) { 
                   
                    foreach ($tasks as $task): ?>
                        <tr>
                            
                            <td><?= $task['title']?></td>
                            <td><?= $task['description'] ?></td>
                            <td><?= $task['created_at'] ?></td>
                            <td>
                                <div class="div_action">
                                    <?php echo '<div class="update"><a  href="View/update.php?taskId='.$task['id'].' && mnu=update ">Update</a></div>'?>
                                    <?php echo '<div class="delete"><a  href="php/query.php?taskId='.$task['id'].' && mnu=delete">Delete</a></div>'?>
                                </div>
                            </td>
                        </tr>

                <?php
                    endforeach;
                } ?>

                <tbody>
                </table>
                </div>

            </div>
            <div class="completed_list ">
            <h2>Completed Task</h2>
                <div class="table-wrapper scrol-div-Instance">
                <table class="fl-table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date of Creation</th>
                    <th>Actions</th>
                   
                </tr>
                </thead>
                <tbody>
                <?php 
                    $tasksComp = displayCompletesTask();

                global $tasksComp;
                if (!empty($tasksComp)) { 
                   
                    foreach ($tasksComp as $task): ?>
                        <tr>
                            <td><?= $task['title']?></td>
                            <td><?= $task['description'] ?></td>
                            <td><?= $task['created_at'] ?></td>
                            <td>
                                <div class="div_action">
                                    <?php echo '<div class="update"><a  href="View/update.php?taskId='.$task['id'].' && mnu=update ">Update</a></div>'?>
                                    <?php echo '<div class="delete"><a  href="php/query.php?taskId='.$task['id'].' && mnu=delete">Delete</a></div>'?>
                                </div>
                            </td>
                        </tr>

                <?php
                    endforeach;
                }      
             ?>

                <tbody>
                </table>
                </div>
            </div>
        </div>
        

    </div>

    
    <script>
       let popup = document.getElementById('popup');

       function openPopUp(){
        console.log("new");
        popup.classList.add("open_popup");
       }
       function closePopUp(){
        popup.classList.remove("open_popup");
       }
    </script>
</body>
</html>