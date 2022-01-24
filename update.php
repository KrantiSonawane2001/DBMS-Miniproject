<?php 
    include('config/constants.php');

    if (isset($_GET['id']))
    {
        $id = $_GET['id'];

        // database connectivity
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        // select database
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

        // sql query to display all records from database
        $sql = "SELECT * FROM to_do_list WHERE id = $id";

        // execute the query
        $res = mysqli_query($conn, $sql);

        // to check whether query eecuted successfully
        if ($res == true)
        {
            $row = mysqli_fetch_assoc($res);

            $task_name = $row['task_name'];
            $task_description = $row['description'];
            $due_date = $row['due_date'];
           
        }
        else
        {
            header('Location: to_do_list.php');
        }
    }

?>




<html>
    <head>
        <title>myBuddy</title>
    </head>

    <body>
        <h1>Update Task</h1>

        <p>
            <?php
                if(isset($_SESSION['update_fail']))
                {
                    // display message
                    echo $_SESSION['update_fail'];
                    // remove the message after displaying once
                    unset($_SESSION['update_fail']);
                }   
            ?>
        </p>


        <form action ="" method = "POST">

        <table>
            <tr>
                <td>Task Name: </td>
                <td><input type = "text" name = "task_name" value = "<?php echo $task_name; ?>" required /></td>
            </tr>
            <tr>
                <td>Task Description: </td>
                <td>
                    <textarea name = "task_description" value = "<?php echo $task_description; ?>" ></textarea>
                </td>
            </tr>
            <tr>
                <td>Due Date: </td>
                <td><input type = "date" name = "due_date" value = "<?php echo $due_date; ?>" required /></td>
            </tr>

            <tr>
                <td><input type = "submit" name="submit" value = "Update"></td>
            </tr>
            
        </table>       

    </form>
    </body>
</html>


<?php
    if(isset($_POST['submit']))
    {
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $due_date = $_POST['due_date'];

        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        $db_select2 = mysqli_select_db($conn2, DB_NAME);

        $sql2 = "UPDATE to_do_list SET 
            task_name = '$task_name',
            description = '$task_description',
            due_date = '$due_date'
            WHERE id = $id";

        $res2 = mysqli_query($conn2, $sql2);

        // to check whether query eecuted successfully
        if ($res2 == true)
        {
            $_SESSION['update'] = "Task Updated Successfully";
            header('Location: to_do_list.php');
        }
        else
        {
            $_SESSION['update_fail'] = "Failed to Update the Task";
            header('Location: update.php?id='.$id);
        }
    }

    
?>