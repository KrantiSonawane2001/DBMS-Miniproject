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
    <?php
    // check whether the session is set for add task
            if(isset($_SESSION['add']))
            {
                ?>
                <div class="alert">
                    <span class="closebtn" onclick = "myFunction()"; >&times;</span> 
                    <?php echo $_SESSION['add']; ?>
                    <script>
                        x = 515;    // height during alert    
                    </script>            
                </div>
                <?php
                unset($_SESSION['add']);
            }
            // session check for delete task successfull
            if(isset($_SESSION['delete']))
            {
                ?>
                <div class="alert">
                    <span class="closebtn" onclick="myFunction()"; >&times;</span> 
                    <?php echo $_SESSION['delete']; ?>
                    <script>
                        x = 515;    // height during alert    
                    </script>
                </div>
                <?php
                // remove the message after displaying once
                unset($_SESSION['delete']);
            }  

            // session check for update task successfull
            if(isset($_SESSION['update']))
            {
                ?>
                <div class="alert">
                    <span class="closebtn" onclick="myFunction()"; >&times;</span> 
                    <?php echo $_SESSION['update']; ?>
                    <script>
                        x = 515;    // height during alert    
                    </script>
                </div>
                <?php
                // remove the message after displaying once
                unset($_SESSION['update']);
            }  
            
            // session check for delete task unsuccessfull
            if(isset($_SESSION['delete_fail']))
            {
                ?>
                <div class="alert">
                    <span class="closebtn" onclick="myFunction()" ; >&times;</span> 
                    <?php echo $_SESSION['delete_fail']; ?>
                    <script>
                        x = 515;    // height during alert    
                    </script>
                </div>
                <?php
                // remove the message after displaying once
                unset($_SESSION['delete_fail']);
            }   
            if(isset($_SESSION['completed']))
            {
                ?>
                <div class="alert">
                    <span class="closebtn" onclick="myFunction()" ; >&times;</span> 
                    <?php echo $_SESSION['completed']; ?>
                    <script>
                        x = 515;    // height during alert    
                    </script>
                </div>
                <?php
                // remove the message after displaying once
                unset($_SESSION['completed']);
            }    
            if(isset($_SESSION['completed_fail']))
            {
                ?>
                <div class="alert">
                    <span class="closebtn" onclick="myFunction()" ; >&times;</span> 
                    <?php echo $_SESSION['completed_fail']; ?>
                    <script>
                        x = 515;    // height during alert    
                    </script>
                </div>
                <?php
                // remove the message after displaying once
                unset($_SESSION['completed_fail']);
            } 
        ?>
    </div>

<div class="container">
    <?php include("todaysDueTask.php"); ?>
    <div class="taskDisplay">


<!-- Table to display task -->
<table class="task_table" style="overflow-x: auto;">

    <tr class="tableHeaders">
    <thead>
        <th>Sr. No.</th>
        <th>Task Name</th>
        <th>Deadline</th>
        <th>Status</th>
        <th>Actions</th>
    </thead>
    </tr>

    <?php

        
        // database connectivity
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        // select database
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

        // sql query to display all records from database
        $sql = "SELECT * FROM to_do_list WHERE user_id = '$user_id' ORDER BY due_date";
        
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
                // creating a variable for srno
                $sr_no = 1;
                // data present in table
                //getting data from database
                while($row = mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $task_name = $row['task_name'];
                    $due_date = $row['due_date'];
                    $status = $row['task_completed'];

                    if ($row['due_date'] >= date("Y-m-d") and $row['task_completed'] == "No")
                    {

                ?>
                    <tbody>
                    <tr class="tableRows">
                        <td><?php echo $sr_no++; ?></td>
                        <td><?php echo $task_name; ?></td>
                        <td><?php echo $due_date; ?></td>
                        <td><?php echo "Incomplete"; ?></td>
                        <td>
                            <a href="update.php?id=<?php echo $id; ?>" class="updateLink"> Update </a>
                            <a href="delete_task.php?id=<?php echo $id; ?>" class="deleteLink"> Delete </a>
                            <a href="taskCompleted.php?id=<?php echo $id; ?>" class="doneLink"> Done </a>
                        </td>  
                    </tr>
                    </tbody>
                        <?php
                    }
                }

            }
        }
      
    ?>
    
</table>
<?php
   if($to_do_count == 0)
        {
            ?>
            <tbody>
            
                <a href="add_task.php">
                    <img src="images/noTask2.png" class="noTaskImg">
                </a>
                <p class="NoTask">No Tasks to Display!</p>
            </tbody>
            <?php
        }
        ?>
</div>
<script>
    document.getElementsByClassName("taskDisplay")[0].style.height = x ;    
</script>

</div>
</div>
</div>
</div>