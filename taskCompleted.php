<?php
    include('config/constants.php');

    if($_GET['id'])
    {
        $id = $_GET['id'];

        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        $db_select = mysqli_select_db($conn, DB_NAME);

        $sql = "UPDATE to_do_list SET 
            task_completed = 'Yes'
            WHERE id = $id";

        $res = mysqli_query($conn, $sql);

        // to check whether query eecuted successfully
        if ($res == true)
        {
            $_SESSION['completed'] = "Task Completed!";
            header('Location: to_do_list.php');
        }
        else
        {
            $_SESSION['completed_fail'] = "Failed to change the status of the Task";
            header('Location: to_do_list.php');
        }
    }

    
?>