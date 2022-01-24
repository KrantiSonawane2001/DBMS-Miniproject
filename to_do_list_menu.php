<?php  
    $user_id = $_SESSION['user_id'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myBuddy</title>

    <link rel="stylesheet" href="css/todo.css?v=<?php echo time(); ?>">
    

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&family=PT+Serif&display=swap" rel="stylesheet">
</head>

<body>

<?php

    $to_do_count = 0;
    $overdue_count = 0;
    $copleted_count = 0;

    // database connectivity
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

    // select database
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

    // sql query to display all records from database
    $sql = "SELECT * FROM to_do_list WHERE user_id = '$user_id'";

    // execute the query
    $res = mysqli_query($conn, $sql);

    // check whether query successfully executed or not
    if ($res==true)
    {
        //count number of rows
        $count_rows = mysqli_num_rows($res);


        // check data in db
        if ($count_rows>0)
        {
            
            while($row = mysqli_fetch_assoc($res))
            {
                $due_date = $row['due_date'];
                $status = $row['task_completed'];

                if ($row['due_date'] >= date("Y-m-d") and $row['task_completed'] == "No")
                {
                    $to_do_count++;
                }
                
                elseif ($row['due_date'] < date("Y-m-d") and $row['task_completed'] == "No")
                {
                    $overdue_count++;
                }
                elseif ($row['task_completed'] == "Yes")
                {
                    $copleted_count++;
                }
            }

        }
        else
        {
            $to_do_count = 0;
            $overdue_count = 0;
            $copleted_count = 0;
        
        }
        
    }

?>




    <!-- MENU -->
    <div class="toDomenu">
        
        <h1 class="websiteName"> <a href="dashboard.php">myBuddy</a></h1>

        <div class="vertical-menu">
            <a href="dashboard.php"><img src="images/home.png" class="homeImg">Home</a>
            <a href="to_do_list.php"><img src="images/to_do.png" class="to_doImg">To Do (<?php echo $to_do_count; ?>)</a>
            <a href="overDue.php"><img src="images/pending.png" class="pendingImg">Overdue (<?php echo $overdue_count; ?>)</a>
            <a href="completed_task.php"><img src="images/completed.png" class="compImg">Completed (<?php echo $copleted_count; ?>)</a>
        </div>
        <div class="addContainer">
            <img src="images/addTask2.png" class="addTaskImg">
            <p class="addDesc">Add your new task <br>here</p>
            <div class="addTag">
                <a href="add_task.php" class="addTask">+ Add Task</a>
            </div>
        </div>
        

    </div>
</body>