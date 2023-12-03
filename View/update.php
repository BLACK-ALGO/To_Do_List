<?php 
    // session_start();
    require '../php/query.php';
    $_SESSION['task_id'] = $_GET['taskId'] ;
    ?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">     
    <?php echo "<link rel='stylesheet' href='../CSS/style.css'>"; ?>
    <title>Document</title>
</head>
<body>
    <div class="update_form" >
                <h2>UPDATE TASK</h2>
                <!-- form to update a new task -->
                <form action="..\php\query.php?mnu=update" method="post">
                        <div class="input_class">
                            <label for="taskName">Task Name</label>
                            <input type="text" name="taskName" id="" placeholder="Buy a new computer" >
                        </div>
                        <div class="input_class">
                            <label for="taskName">Task Descrition</label>                       
                            <textarea id="taskDescription" name="taskDescription" rows="5" cols="60"  >
                                
                            </textarea>
                            
                        </div>
                        <div class="input_class">
                            <label for="taskName">Task State</label>
                            <select name="taskStatus" id="">
                                <option value="">Select Task Status</option>
                                <option value="1">Completed</option>
                                <option value="0">Incompleted</option>
                            </select>
                        </div>
                        <div class="btn_div">                            
                        <div class="back_view"><a  href="../index.php"><- Back</a></div>
                            <button class="save_btn" type="submit">Update</button>
                        </div>
                </form>
            </div>
</body>
</html>