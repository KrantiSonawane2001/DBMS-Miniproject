
<!-- To include constants for connectivity part -->
<?php 
    include('config/constants.php');
    $user_id = $_SESSION['user_id'];
?>

<script>
    var x = 583;
    function myFunction() {
        document.getElementsByClassName("taskDisplay")[0].style.height = 582;   
        document.getElementsByClassName("closebtn")[0].parentElement.style.display='none';
}
</script>

<div class="toDoBody">

<?php 
    include('to_do_list_menu.php');
?>
<div class="taskList">
    <div class="pgHeading">
        <div class="heading">
            <p>Tasks To Do</p>
        </div>
    </div>
    <div class="parentContainer">

    <div class="alertDiv">

    <!-- to display message if task addition FAILED -->

    <?php

        // check whether the session is created or not
        if(isset($_SESSION['add_fail']))
        {
            ?>
                <div class="alert">
                    <span class="closebtn" onclick = "myFunction()"; >&times;</span> 
                    <?php echo $_SESSION['add_fail']; ?>
                    <script>
                        x = 515;    // height during alert    
                    </script>            
                </div>
                <?php
            // remove the message after desplaying once
            unset($_SESSION['add_fail']);
        }
    ?>

    <div class="container">
        <?php include("todaysDueTask.php"); ?>
        <div class="taskDisplay">
    <p style="margin-top: 15px; font-size: 25px; margin-bottom: 30px">Add a Task</p>


    <div class="formContainer">
        <!-- Form to add a task -->
        <form action ="" method = "post">
            <p>
                Task Name: * 
                <br><input type = "text" name = "task_name" placeholder="Enter task name" required />
            </p>
            <br>
            <p>
                Task Description: 
                <br><textarea name = "task_description" placeholder="Enter task description" ></textarea>
            </p>
            <br>
            <p>
                Due Date: *
                <br><input type = "date" name = "due_date" placeholder="Select due date" required />
            </p>
            <br>
            <input type = "submit" class = "submit" name="submit" value = "Add Task">
        </form>
    </div>
<?php

    // to check whether form is submitted
    if (isset($_POST['submit']))
    {
        // get values from form and save it in variables
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $due_date = $_POST['due_date'];

        // database connectivity
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        // select database
        $db_select = mysqli_select_db($conn, DB_NAME);

        // sql query to insert data into database
        $sql = "INSERT INTO to_do_list SET
            user_id = '$user_id',
            task_name = '$task_name',
            task_completed = 'No',
            due_date = '$due_date',
            description = '$task_description'
            ";
        
        // execute query and insert into the database
        $res = mysqli_query($conn, $sql);

        // check whether query successfully inserted or not
        if ($res==true)
        {
            // create a session variable to display message
            $_SESSION['add'] = "Task Addded Successfully!";

            // redirect to to_do_list.php page
            header("location:to_do_list.php");
        }
        else
        {
            // create a session variable to display message
            $_SESSION['add_fail'] = "Failed to Add Task!";

            // redirect to same page
            header("location:add_task.php");
        }
    }

?>
<script>
    document.getElementsByClassName("taskDisplay")[0].style.height = x ;    
</script>

</div>
</div>
</div>
</div>
</div>
