<!DOCTYPE html>

<?php
session_start();
    $dept = $_GET['name'];

    $empid = $_SESSION['empid'];

    if($empid == ""){
        header('Location: /');
    }
    include 'connection.php';

    $admselect = 'SELECT firstname,title,emp_id from admin where emp_id = '.$empid.'';
    $query = mysqli_query($connection,$admselect);
    $fetch = mysqli_fetch_assoc($query);

    $empselect = 'SELECT *from employees where department = "'.$dept.'"';
    $empquery = mysqli_query($connection,$empselect);

    //confirming if department has employees
    $deptSelect = 'SELECT department from employees where department = "'.$dept.'"';
    $deptquery = mysqli_query($connection, $deptSelect);
    $deptres = mysqli_fetch_assoc($deptquery);

    //confirming if department has an H.O.D
    $deptSelect1 = 'SELECT  *from departments where name = "'.$dept.'"';
    $deptquery1 = mysqli_query($connection, $deptSelect1);
    $deptres1 = mysqli_fetch_assoc($deptquery1);

    

    #echo $empselect;
    #echo $deptSelect;
    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php echo'<title>sPF -'.$dept.'</title>' ?>
    <link rel="stylesheet" href="css/department.css">
    <link rel="shortcut icon" href="images/favicon.png " type="image/x-icon">
</head>
<body>
<div class="whole"> 
    <section class="right">
        <div class="search">
            <input type="search" name="search" placeholder="search for files, employee profiles etc">
            <div class="button"><button type="submit">Search</button></div>
        </div>
        <?php echo'<h1 class="department">'.$dept.' -ASDA</h1>';
        
        function addHod(){
            $dept = $_GET['name'];
            include 'connection.php';
            $empselect = 'SELECT *from employees where department = "'.$dept.'"';
            $empquery2 = mysqli_query($connection,$empselect);
            echo'
        <i style="color:red">This department does not have an H.O.D</i>
        <form action="department.php?name='.$dept.'" method="POST">
            <select name="newHod">
            <option>-- Add H.O.D--</option>';
            while($empres2 = mysqli_fetch_assoc($empquery2)){
                echo'
             <option>'.$empres2['firstname'].' '.$empres2['othernames'].'</option>
             ';
            }
             echo '
            </select>
            <button type="submit" name="addhod">Add</submit></button>
        </form>
        
        ';
        }

        if(isset($_POST['addhod'])){
            $hod = $_POST['newHod'];

            $add = 'UPDATE departments SET hod = "'.$hod.'" WHERE name = "'.$dept.'"';
            
            if($query = mysqli_query($connection, $add)){
               
                header('Location: ./department.php?name='.$dept.'');
                 echo'
                <script>
                 alert("new H.O.D added");
                </script>
                ';
            }
            else{
                echo'
                <script>
                 alert("H.O.D could not be added, contact admin");
                </script>
                ';
            }
        }
        
        ?>


        <section class="employee">
            
            <?php 
            if($deptres1['hod'] == ""){

                if($deptres['department'] != ""){
                addHod();
                }
            }
            while($empres = mysqli_fetch_assoc($empquery)){

            echo'
            <a href="eachemp.php?empid='.$empres['emp_id'].'"><div class="each-emp">
                <div class="inside">
                    
                </div>
                <p id="name"><b>'.$empres['firstname'].' '.$empres['othernames'].'</b></p><i id="title">'.$empres['title'].'</i>
            
            </div>
           
        </a>

        '
            ;
            }
            ?>
           
           <?php echo' <a href="newstaff.php?department='.$dept.'">';?> <div class="each-emp">
                    <div class="inside2">
                       <div class="add-one">
                           <p>+</p>
                       </div><br>
                      
                    </div>
                     <i>add new staff</i>
                
                </div>
               
            </a>
           
           
        

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
        <div id="btn"> <?php echo '<a href="newstaff.php?department='.$dept.'"><button class="addtwo">Add new staff </button></a></div>
   
';?>
       </div>   
    </section>
    

   

    
   
</div>

     <footer>
            <p>copyright&copy;faisal 2022</p>
        </footer>
</body>

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
</html>