<?php 
    $user_id = $_SESSION['user_id'];
?>

<div class="rightMenu">
        
    <div class="userName">
        <p>
            <img src="images/user.png" style="height:5%; margin-bottom: -1%;">
            <?php echo($_SESSION['username']) ?></p>
    </div>

        <p class="date">
            <img src="images/date.png" class= "dateImage" >
            <?php
                date_default_timezone_set('Asia/Kolkata');
                echo (date("d")." ".date("F", strtotime('m'))." ".date("Y"));
            ?>
            <br>
            <?php echo date("l")?>
        </p>
        <?php
        $conn3 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        // select database
        $db_select3 = mysqli_select_db($conn3, DB_NAME) or die(mysqli_error());

        $sql3 = "SELECT * FROM to_do_list WHERE user_id = '$user_id'";

        $res3 = mysqli_query($conn3, $sql3);

        $dueToday = 0;
            
        if ($res3==true)
        {
            while($row3 = mysqli_fetch_assoc($res3))
            {
                $due_date = $row3['due_date'];
            
                if ( $due_date == date("Y-m-d") and $row3['task_completed'] == "No") 
                {
                    $dueToday++;
                }
            }   
        }  
        if ($dueToday > 0)
        {
            
            if  ($dueToday == 1)
            {
                ?> 
            <div class="dueContainer" style="color:red;">
                <img src="images/pin2.png" class ="pinImage">
                <?php echo ("You have 1 task Due Today.");?>
                <br>
                <div class="todaysTaskView"><a href="todaysTaskShow.php" >View</a></div>
            </div>
            <?php
            }
            else 
            {
            ?>
            <div class="dueContainer" style="color:red;">
                <img src="images/pin2.png" class ="pinImage">
                <?php echo ("You have ".$dueToday." tasks Due Today.")?>
                <br>
                <div class="todaysTaskView"><a href="todaysTaskShow.php" >View</a></div>
            </div>
                
                <?php
            }
        }
        else
        {
            ?>
            <div class="dueContainer" style="color:red;">
                <img src="images/pin2.png" class ="pinImage">
                <?php echo ("You have No tasks Due Today!"); ?>
            </div>
           <?php 
        }
        ?>
    </div>