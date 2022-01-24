<?php
    // include_once 'source/session.php';
    include('menu.php');
    include('config/constants.php');

    $user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myBuddy</title>

   
</head>
<body>
    
<!-- Reminder task -->
<div class="to_do_reminders">
        <table class="reminders">
            <tr>
                <th>Deadline close enough</th>
            </tr>
        
    <?php

        // database connectivity
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        // select database
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

        // sql query to display all records from database
        $sql = "SELECT * FROM to_do_list WHERE user_id = '$user_id'";

        $res = mysqli_query($conn, $sql);

        if ($res==true)
        {
            $count_rows = mysqli_num_rows($res);

            if ($count_rows>0)
            {
                $sr_no = 1;
    
                while($row = mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $task_name = $row['task_name'];
                    $due_date = $row['due_date'];
                    $status = $row['task_completed'];

                    $date1 = date("Y-m-d");
                    $date2 = $row['due_date'];
                    
                    $diff = strtotime($date1) - strtotime($date2);
                    
                    $dateDiff = abs(round($diff / 86400));
                    if ( $dateDiff < 3 and $row['task_completed'] == "No")
                    {

                ?>
                        <tr>
                            <td>
                                <a href="to_do_list.php?id=<?php echo $id; ?>" class="reminderTask">
                                <?php echo $task_name; ?>
                                </a>
                            </td>
                        </tr>

                        <?php
                    }
                }

            }
            else
            {
                // no data
                ?>
                <tr>
                    <td>No Urgent Tasks to Show!</td>
                </tr>
                <?php
  
            }
        }
        
    ?>
    </table>
    </div>
    <?php if(!isset($_SESSION['username'])): header("location: Admin/logout.php");?>

    <?php else: ?>

    <?php endif ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo "Welcome ".$_SESSION['username']."!" ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    
    
    <!-- <h2><a href="Admin/logout.php">Logout</a></h2> -->

    
    <div class="cardContainer" style="background-color: #F4EDE8; padding: 20px">
        <div class="row">
            <div class="col-sm-4">
                <div class="card box-shadow" style="width: 18rem;">
                    <img src="images/toDoCard.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Manage your Daily Tasks</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="to_do_list.php" class="btn btn-primary" style="background-color: #22223B; color: #F2E9E4; border: #22223B" onMouseOver="this.style.color = 'white'">Explore</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card box-shadow" style="width: 18rem;">
                    <img src="images/calenderCard2.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Plan Events on Calender</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary" style="background-color: #22223B; color: #F2E9E4; border: #22223B" onMouseOver="this.style.color = 'white'">Explore</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card box-shadow" style="width: 18rem;">
                    <img src="images/bill5.jpg" class="card-img-top" alt="..." >
                    <div class="card-body">
                        <h5 class="card-title">Timely Bill Reminders</h5>
                        <p class="card-text">Get yourself reminded of every monthly and other importnat Bill to pay.</p>
                        <a href="#" class="btn btn-primary" style="background-color: #22223B; color: #F2E9E4; border: #22223B" onMouseOver="this.style.color = 'white'">Explore</a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    

</body>
</html>

<!-- To include footer part -->

<?php 
    // include('footer.php');
?>