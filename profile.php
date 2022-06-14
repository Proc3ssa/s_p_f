<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sPF - login</title>
    <link rel="stylesheet" href="css/profile.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>
<body>

    <section> 
       
        <div class="login"> 
            <div class="right">
                <h1 id="login-text">Profile</h1>
                <div class="profile"></div>
            </div>

        <?php
        $emp_id = $_GET['name'];
        function alert($message){
            return '
            <script>alert('.$message.')</script>
            ';
        }

        include 'connection.php';

        if(!$connection){
             echo alert('database connection could not be established');
        }
        else{
            echo alert('connection established');
        }

        $select = 'SELECT *FROM admin where emp_id = '.$emp_id.'';
        $query = mysqli_query($connection, $select);
        $res = mysqli_fetch_assoc($query);

        #echo $_SERVER['REMOTE_PORT'];

        ?>

            <table>
                <tr>
                    <td><label>First name</label><br>
                    <input type="text" value="<?php echo $res['firstname'] ?>"  name="fname">
                    </td>

                    <td><label>Other names</label><br>
                        <input type="text" value="<?php echo $res['Othername'] ?>"  name="oname">
                        </td>
                </tr>

                <tr>
                    <td><label>Staff ID</label><br>
                    <input type="text" value="<?php echo $res['emp_id'] ?>" disabled name="id">
                    </td>

                    <td><label>E-mail</label><br>
                        <input type="mail" value="<?php echo $res['email'] ?>" name="email" >
                        </td>
                </tr>

                <tr>

                    <td><label>Password</label><br>
                        <input type="text" value="<?php echo $res['password'] ?>" name="password" >
                    </td>

                    <td><br>
                        <input type="submit" value="Update" name="update" >
                    </td>
                </tr>
            </table>

            
              
            
            <p id="p">copyright&copy;faisal 2022</p>
            </div>


    </section>

    <style>
    .profile{
    border:3px solid blue;
    width:100px;
    height:100px;
    margin:20px auto 5px;
    border-radius:360px;
    background-color: rgb(195, 203, 211);
    <?php echo "background-image: url('../images/".$emp_id.".png')"?>;
    background-repeat:round;
}

    </style>
    
</body>
</html>