<?php
    session_start();

    // connection to the database
   $MySERVERNAME = "localhost";
   $MyUserNAME = "root";
   $MyPwd = "";
   $databaseName ="to_do_list";
   
   $conn = mysqli_connect($MySERVERNAME, $MyUserNAME, $MyPwd, $databaseName) or die();
   $GLOBALS['CONNECTION'] = $conn;




// calling of the add function
if(empty($_GET['mnu']) || $_GET['mnu'] == 'add'){
    if ((trim(isset($_POST['taskName'])) and trim(isset($_POST['taskDescription'])))) {

        // getting the value from the form
        $task_Name =$_POST['taskName'];
        $task_Description =$_POST['taskDescription'];
        // Call the function to insert data
        addTask($task_Name,$task_Description);

    }
}

// calling of the update function
if(isset($_GET['mnu']) and $_GET['mnu'] == 'update'){
    if ((trim(isset($_POST['taskName'])) and trim(isset($_POST['taskDescription'])) and trim(isset($_POST['taskStatus'])))) {

        // getting the value from the form
        $task_Name =trim($_POST['taskName']);
        $task_Description =trim($_POST['taskDescription']);
        $task_status = trim($_POST['taskStatus']);
         $task_Id = (int)$_SESSION['task_id'];
        // Call the function to update data
        updateTask($task_Name, $task_Description, $task_Id, $task_status);

    }
    
}
// calling of the delete function
if(isset($_GET['mnu']) and $_GET['mnu'] == 'delete'){

    
    echo $_GET['mnu'], $_GET['taskId'];
    $taskId = $_GET['taskId'];
    deleteTask($taskId);

}



// function to insert data into the database
function addTask($task_Name, $task_Description) {
   
    $conn = $GLOBALS['CONNECTION'];
   

   
    // Prepare SQL query
    $sql = "INSERT INTO task (`title`, `description`, `status`, `created_at`) VALUES (?,?,0,NOW())";
    // Prepare and bind parameters
    // print_r($conn->query($sql));
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ss", $task_Name, $task_Description);

    // Execute the query
    if ($stmt->execute() === TRUE) {
        echo "New record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the statement and connection
    
    echo 'end';
    header('Location: ../index.php?mnu=add');
    exit();
}

// function to UPDATE data into the database
function updateTask($task_Name, $task_Description, $id, $status) {
        // Prepare SQL query
        global $conn;

        // updating only the title field 
        if(!empty($task_Name)){
            $sql = "UPDATE task SET title=?, updated_at=NOW() WHERE id = ?";
                    // Prepare and bind parameters
            $stmt = $conn->prepare($sql);
            // var_dump($stmt);
            $stmt->bind_param("si", $task_Name,$id);

            if ($stmt->execute() === TRUE) {
                header('Location: ../index.php?msg= task updated succesfully');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // updating only the description field
        if(!empty($task_Description)){
            $sql = "UPDATE task SET  description=?, updated_at=NOW() WHERE id = ?";
                    // Prepare and bind parameters
            $stmt = $conn->prepare($sql);
            // var_dump($stmt);
            $stmt->bind_param("si",$task_Description,$id);


            if ($stmt->execute() === TRUE) {
                header('Location: ../index.php?msg= task updated succesfully');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // updating only the status field
        if(!empty($status)){
            $sql = "UPDATE task SET  status=?, updated_at=NOW() WHERE id = ?";
                    // Prepare and bind parameters
            $stmt = $conn->prepare($sql);
            // var_dump($stmt);
            $stmt->bind_param("si",$status,$id);

            if ($stmt->execute() === TRUE) {
                header('Location: ../index.php?msg= task updated succesfully');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // updating all the 3 fields 
        if(!empty($task_Name) and !empty($task_Description) and !empty($status)){

            $sql = "UPDATE task SET title=?, description=?, status=?, updated_at=NOW() WHERE id = ?";
                    // Prepare and bind parameters
            $stmt = $conn->prepare($sql);
            // var_dump($stmt);
            $stmt->bind_param("sssi", $task_Name, $task_Description,$status,$id);

            if ($stmt->execute() === TRUE) {
                header('Location: ../index.php?msg= task updated succesfully');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    
}


// function to display incompleted task
if(!function_exists('displayTask')){
function displayTask(): array{
    $conn = $GLOBALS['CONNECTION'];
    // prepare sql query to select all task
    $sql ="SELECT * FROM `task` WHERE `status`=0 ORDER BY created_at DESC";
    
    // query execution
    $result =$conn->query($sql);
    // declearing an empty array of task
    $tasks = array();

    // checking if there is record 
    if ($result->num_rows > 0) {
        // Fetch rows and add them to the $tasks array
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
    }


    return $tasks;
}
}

// function to display completed taak
if(!function_exists('displayCompletesTask')){
function displayCompletesTask(): array{
    $conn = $GLOBALS['CONNECTION'];
    
   // prepare sql query to select all task
   $sql ="SELECT * FROM `task` WHERE `status`=1 ORDER BY created_at DESC";
   
   // query execution
   $result =$conn->query($sql);
   // declearing an empty array of task
   $tasks = array();

   // checking if there is record 
   if ($result->num_rows > 0) {
       // Fetch rows and add them to the $tasks array
       while ($row = $result->fetch_assoc()) {
           $tasks[] = $row;
       }
   }



   return $tasks;
}
}

// function to deletena task
function deleteTask($taskId){
    $conn = $GLOBALS['CONNECTION'];
    // Prepare SQL query
    echo 'here';
    $sql = "DELETE FROM task WHERE id=$taskId";

    $result =$conn->query($sql);

    
   
    header('Location: ../index.php');
    exit();

}


?>
