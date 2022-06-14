<!DOCTYPE html>

<?php
session_start();
    $empid = $_GET['empid'];
    if($empid == ""){
        header('Location: /');
    }

    $adminid = $_SESSION['empid'];
    include 'connection.php';

    $admselect = 'SELECT firstname,title,emp_id from admin where emp_id = '.$adminid.'';
    $query = mysqli_query($connection,$admselect);
    $fetch = mysqli_fetch_assoc($query);

    $empselect = 'SELECT  firstname,othernames,title from employees where emp_id = "'.$empid.'"';
    $empquery = mysqli_query($connection,$empselect);
    $empres = mysqli_fetch_assoc($empquery);


    $filesselect = 'SELECT *from files where emp_id = '.$empid.'';
    $filequery = mysqli_query($connection, $filesselect);
    

    #echo $empselect;
    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <?php echo '
     <title>sPF -'.$empres['firstname'].'</title>';?>
    <link rel="stylesheet" href="css/eachemp.css">
    <link rel="shortcut icon" href="images/favicon.png " type="image/x-icon">
</head>
<body>
<div class="whole"> 
    <section class="right">
        <div class="search">
            <input type="search" name="search" placeholder="search for files">
            <div class="button"><button type="submit">Search</button></div>
        </div>
        
    <?php
        echo '
        <h1 class="department">'.$empres['firstname'].' '.$empres['othernames'].'</h1>
        <i id="id">'.$empres['title'].'</i>
    '
        ?>
        
        

        <section class="employee">
  <?php

  while($fileres = mysqli_fetch_assoc($filequery)){

    echo'
       
            <a href="file.php?name='.$fileres['path'].'&empid='.$empid.'"><div class="each-emp">
                <iframe src="files/'.$fileres['path'].'" class="file" >
                    
                </iframe>
                <p id="name"><b>'.$fileres['filename'].'</b></p>
            
            </div>';
  }
            ?>
           
        </a>
       
        

        

           

        <?php echo'<a href="newfile.php?name='.$empid.'">';?><div class="each-emp">
                    <div class="inside2">
                       <div class="add-one">
                           <p>+</p>
                       </div><br>
                      
                    </div>
                     <i>add new file</i>
                
                </div>
               
            </a>
           
        

        </section>
       
       
    </section>
    
    <?php echo'<a href="profile.php?name='.$fetch['emp_id'].'"><section class="left">';?>
        <div class="profile">
            <div class="dp"></div>
            <?php echo '<h2 class="name">'.$fetch['firstname'].'</h2>
            <p class="title">'.$fetch['title'].'</p>'?>
        </div></a>
        
        <div class="add-two">
        <div id="img">+</div>
        <div id="btn"> <?php echo'<a href="newfile.php?name='.$empid.'">';?><button class="addtwo">Add new file </button></a></div>
   

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