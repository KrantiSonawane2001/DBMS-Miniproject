<!-- To include constants for connectivity part -->
<?php 
    include('config/constants.php');

    if (isset($_GET['id']))
    {
        // get task id
        $id = $_GET['id'];

        // database connectivity
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        // select database
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

        // sql query to display all records from database
        $sql = "DELETE FROM to_do_list WHERE id = $id";

        // execute the query
        $res = mysqli_query($conn, $sql);

        // to check whether query eecuted successfully
        if ($res == true)
        {
            $_SESSION['delete'] = "Task Deleted Successfully";

            // 
            // 
            //  REDIRECT TO SAME PAGE '''''DOUBT'''''
            header('Location: to_do_list.php');
            // die;
            // 
            // 
            // 
        }
        else
        {
            $_SESSION['delete_fail'] = "Failed to Delete the Task";
            header('Location: to_do_list.php');
        }
    }

    else
    {
        header('Location: to_do_list.php');
        die;
    }
    

?>


<!-- problems:
1. if task deleted then not deleted from table ..... delete_task.php
2. how to redirect on same pg in if and elese both blocks ..... used in delete_task.php
-->