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

    $deptselect = 'SELECT *from departments';
    $deptquery = mysqli_query($connection,$deptselect);


    function stringParse($string){

        if(strlen($string) > 14){
            $parsed = substr($string, 0, 14)."...";
        }
        else{
            $parsed = $string;
        }
            return $parsed;
    }
    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="shortcut icon" href="images/favicon.png " type="image/x-icon">
</head>
<body>
<div class="whole"> 
    <section class="right">
        <div class="search">
            <input type="search" name="search" placeholder="search for files, employee profiles etc">
            <div class="button"><button type="submit">Search</button></div>
        </div>
        <h1 class="department">Departments -ASDA</h1>
        <section class="departments">
        <?php 
        while($deptfetch = mysqli_fetch_assoc($deptquery)){
            echo'
        
            <a href="department.php?name='.$deptfetch['name'].'" title='.$deptfetch['name'].'><div class="each-dept">
                <div class="poster">

                </div>
                <h2 class="dept-name">'.stringParse($deptfetch['name']).'</h2>
                <p class="hod">H.O.D</p>
                <i class="hod-name">'.$deptfetch['hod'].'</i>
                
            </div></a>
            ';
        }
            ?>

           

           

            
            

            <a href="newdepartment.php"><div class="each-dept">
                <div class="poster1">
                    <h1 class="add">+</h1>
                </div>
                <i class="dept-name">Add new department</i>
               
                
            </div></a>

            
        </section>
       
       
    </section>
    
    <?php echo'<a href="profile.php?name='.$empid.'"><section class="left">';?>
        <div class="profile">
            <div class="dp"></div>
            <?php echo '<h2 class="name">'.$fetch['firstname'].'</h2>
            <p class="title">'.$fetch['title'].'</p>'?>
        </div></a>
        
        <div class="add-two">
        <div id="img">+</div>
        <div id="btn"> <a href="newdepartment.php"><button class="addtwo">Add new department </button></a></div>
   

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
        </style>
</body>
</html>