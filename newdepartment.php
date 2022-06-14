<!DOCTYPE html>

<?php
session_start();
    $empid = $_SESSION['empid'];


    if($empid == ""){
        header('Location: /');
    }
    include 'connection.php';

    $admselect = 'SELECT firstname,title,emp_id from admin where emp_id = '.$empid.'';
    $query = mysqli_query($connection,$admselect);
    $fetch = mysqli_fetch_assoc($query);

    $deptselect = 'SELECT firstname, othernames from employees';
    $deptquery = mysqli_query($connection,$deptselect);
    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add department</title>
    <link rel="stylesheet" href="css/newdepartment.css">
    <link rel="shortcut icon" href="images/favicon.png " type="image/x-icon">
</head>
<body>
<div class="whole"> 
    <section class="right">
        
        <h1 class="department">New Department -ASDA</h1>
        <section class="departments">
        <form action="newdepartment.php" method="POST">
                <table>
                    <tr>
                        <td><b>Department Name</b> <i id="hidden">department already exist</i></td>
                        
                    </tr>
                    <tr>
                        <td><input type="text" name="department" required></td>

                       
                    </select>
                    </td>
                    </tr>
                    <tr>
                        <td><button type="submit" name="add">Add</button><td>
                    </tr>
                </table>
        </form> 

        <?php
             if(isset($_POST['add'])){

                $deptName = $_POST['department'];
                
                

                 $nameSelect = 'SELECT name from departments where name = ? Limit 1';

                 $stmt = $connection -> prepare($nameSelect);
                 $stmt -> bind_param("s",$deptName);
                 $stmt -> execute();
                 $stmt -> bind_result($deptName);
                 $stmt -> store_result();
                 $rows = $stmt ->num_rows;

                 if($rows == 0){


                    /*$hodSelect = 'SELECT hod from departments where hod = ? Limit 1';

                    $stmt = $connection -> prepare($hodSelect);
                    $stmt -> bind_param("s",$hod);
                    $stmt -> execute();
                    $stmt -> bind_result($hod);
                    $stmt -> store_result();
                    $row = $stmt ->num_rows;

                    if($row == 0){*/
                        $null = "";
                        $insert = 'INSERT INTO departments values("'.$deptName.'","'.$null.'")';

                        $query = mysqli_query($connection, $insert);
                        if($query){
                        echo '
                        <script>alert("new department added")</script>
                        ';
                        }
                        else{
                            echo '
                        <script>alert("department could not be added, try again or contact the admin")</script>
                        ';
                        }

                       

                       
                        


                    /*}
                    else{
                        echo hodError();
                    } */
                    
                 }
                 else{
                     echo nameError();
                 }
                
            }
            
        ?>
       
            
        </section>
       
       
    </section>
    
    <a href="profile.php?name=74735"><section class="left">
        <div class="profile">
            <div class="dp"></div>
            <?php echo '<h2 class="name">'.$fetch['firstname'].'</h2>
            <p class="title">'.$fetch['title'].'</p>'?>
        </div></a>
        
        
   

       </div>   
    </section>
     

   

    
   
</div>

     <footer>
            <p>copyright&copy;faisal 2022</p>
        </footer>

        <style>
        .left .profile .dp{
            border:3px solid white;
            width:100px;
            height:100px;
            margin:20px auto 5px;
            border-radius:360px;
            background-color: rgb(195, 203, 211);
            <?php echo 'background-image: url("../images/'.$fetch['emp_id'].'.png");'?>
            background-repeat:round;
}

<?php
#echo hodError();
function nameError(){
    return '
    <style>
      #hidden{
          color:red;
      }
      input[type="text"]{
          border:1px solid red;
          box-shadow: 0px 5px 7px rgb(231, 133, 133);
      }
    </style>
    ';
}

function hodError(){
    return '
    <style>
      .hidden{
          color:red;
      }
      select{
          border:1px solid red;
          box-shadow: 0px 5px 7px rgb(231, 133, 133);
      }
    </style>
    ';
}
?>
        </style>
</body>
</html>