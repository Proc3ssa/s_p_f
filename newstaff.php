<!DOCTYPE html>

<?php
session_start();
    $empid = $_SESSION['empid'];
    $department = $_GET['department'];

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
    <link rel="stylesheet" href="css/newstaff.css">
    <link rel="shortcut icon" href="images/favicon.png " type="image/x-icon">
</head>
<body>
<div class="whole"> 
    <section class="right">
        
        <h1 class="department">New Staff -ASDA</h1>
        <section class="departments">
       <?php echo ' <form action="newstaff.php?department='.$department.'" method="POST">'; ?>
                <table>
                    <tr>
                        <td><b>First Name</b> </td>
                        <td><b>Other Name(s)</b></td>
                        <td><b>Title</b></td>
                        <td><b>Staff ID</b> <i id="hidden">staff already exist</i></td>
                        <td><b>Gender</b></td>
                        
                    </tr>
                    <tr>
                        <td><input type="text" name="firstname" required></td>
                        <td><input type="text" name="othername" required></td>
                        <td><input type="text" name="title" required></td>
                        <td><input type="number" name="staffid" required></td>
                        <td><select name="gender"><option>Female</option>
                        <option>Male</option>
                        </select></td>

                       
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

                $deptName = $_GET['department'];
                $firstname = $_POST['firstname'];
                $othername = $_POST['othername'];
                $title = $_POST['title'];
                $staffid = $_POST['staffid'];
                $gender = $_POST['gender'];

                
                

                 $nameSelect = 'SELECT emp_id from employees where emp_id = ? Limit 1';

                 $stmt = $connection -> prepare($nameSelect);
                 $stmt -> bind_param("i",$staffid);
                 $stmt -> execute();
                 $stmt -> bind_result($staffid);
                 $stmt -> store_result();
                 $rows = $stmt ->num_rows;

                 if($rows == 0){


                    
                        $null = "";
                        $insert = 'INSERT INTO employees values("'.$firstname.'","'.$othername.'",'.$staffid.',"'.$department.'","'.$title.'","'.$gender.'")';

                        $query = mysqli_query($connection, $insert);
                        if($query){
                        echo '
                        <script>alert("new staff added")</script>
                        ';
                        }
                        else{
                            echo '
                        <script>alert("new staff could not be added, try again or contact the admin")</script>
                        ';
                        }

                 #echo $insert;
                    
                 }
                 else{
                     echo staffIdError();
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
function staffIdError(){
    return '
    <style>
      #hidden{
          color:red;
      }
      input[type="number"]{
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