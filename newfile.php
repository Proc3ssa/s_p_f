<!DOCTYPE html>

<?php

session_start();
    $name = $_GET['name'];
    $adminid = $_SESSION['empid'];
    include './alert.php';
    if($adminid == ""){
        header('Location: /');
    }

   
    include 'connection.php';

    $admselect = 'SELECT firstname,title,emp_id from admin where emp_id = '.$adminid.'';
    $query = mysqli_query($connection,$admselect);
    $fetch = mysqli_fetch_assoc($query);

    $profileSelect = 'SELECT *FROM employees WHERE emp_id = '.$name.'';
    $profileQuery = mysqli_query($connection, $profileSelect);
    $profileResult = mysqli_fetch_assoc($profileQuery);
    

    #echo $empselect;
    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <?php echo '
     <title>sPF -'.$profileResult['firstname'].'</title>';?>
    <link rel="stylesheet" href="css/newfile.css">
    <link rel="shortcut icon" href="images/favicon.png " type="image/x-icon">
</head>
<body>
<div class="whole"> 
    <section class="right">
     <h1>Add new file</h1>
     
        <section class="employee">
       
        <?php echo'<form action="newfile.php?name='.$name.'" method="POST" enctype="multipart/form-data">';?>
        <table>
            <tr>
                <td><b>File name</b></td>
                <td><b>Select file</b></td>
            </tr>
            <tr>
                <td><input type="text" name="filename" required></td>
                <td><input type="file" name="file"></td>
            </tr>
            <tr>
                <td><button type="submit" name="submit" required>Add file</button></td>
            </tr>
        </table>
        </form>
           <?php 
                if(isset($_POST['submit'])){
                    $filename = $_POST['filename'];
                    $file = $_FILES['file'];
                    $fileTmpNam = $_FILES['file']['tmp_name'];
                    $filename2 = $_FILES['file']['name'];
                    $extension = explode('.', $filename2);
                    $ext = $extension[1];
                   
                    if($ext == 'png' || $ext == 'pdf' || $ext == 'jpeg' || $ext == 'jpg' || $ext == 'PNG' || $ext == 'PDF' || $ext == 'JPEG' || $ext == 'JPG'  ){
                        $filedestination = $name.'-'.$filename.'-'.date('h-m-s.').$ext;
                            $finaldestination = "./files/".$filedestination;
                            if(move_uploaded_file($fileTmpNam,$finaldestination)){
                             $fileinsert = 'INSERT INTO fileS value("'.$filename.'","'.$filedestination.'","'.$name.'","'.date('Y-M-D').'")';
                             $insertquery = mysqli_query($connection,$fileinsert);
                             

                                echo alert($filename." file added");
                            }
                            else{
                                echo alert("file could not be added");
                            }

                    }
                    else{
                        echo alert('file must be a pdf document or an image file');
                    }
                        
                    
                    
                    
                        
                }
           ?>
        
       
        

        

           

        
           
        

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
        <div id="btn"> <?php echo'<a href="newfile.php?name='.$name.'">';?><button class="addtwo">Add new file </button></a></div>
   

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