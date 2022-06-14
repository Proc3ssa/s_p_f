<!DOCTYPE html>

<?php
session_start();
    $filename = $_GET['name'];
    $empid = $_GET['empid'];
    $adminid = $_SESSION['empid'];

    if($adminid == ""){
        header('Location: /');
    }

    
    include 'connection.php';

    $admselect = 'SELECT firstname,title,emp_id from admin where emp_id = '.$adminid.'';
    $query = mysqli_query($connection,$admselect);
    $fetch = mysqli_fetch_assoc($query);

    $empselect = 'SELECT  firstname,othernames,title from employees where emp_id = "'.$empid.'"';
    $empquery = mysqli_query($connection,$empselect);
    $empres = mysqli_fetch_assoc($empquery);


    $fileselect = 'SELECT *from files where emp_id = '.$empid.' and path="'.$filename.'"';
    $filequery = mysqli_query($connection, $fileselect);
    $fileres = mysqli_fetch_assoc($filequery);
    

    #echo $fileselect;
    
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
        <h1 id="head" align="center">Adansi South District Assembly</h1>
        
    <?php
        echo '<i id="id">'.$empres['firstname'].' '.$empres['othernames'].'</i>
        <h1 class="department">'.$fileres['filename'].'</h1>
        
    
        <iframe src="files/'.$fileres['path'].'" class="iframe" id="iframe">
  

        </iframe >
       
        <div class="buttons"><a href="http://localhost/files/'.$fileres['path'].'" download="'.$fileres['path'].'"><button id="dl">Download</button>
        </a><button id="pt" onClick="window.print();">Print</button><a href="delete.php?path='.$fileres['path'].'&empid='.$empid.'"><button id="dt">delete</button></div>
    </section>
    
    <a href="profile.php?name='.$fetch['emp_id'].'"><section class="left">';?>
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
        </style>
</body>
</html>