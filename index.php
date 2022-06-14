<?php
session_abort();
    ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sPF - login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>
<body>

    <section> 
       
        <div class="login"> 
            <div class="right">
                <h1 id="login-text">sPF -ASDA</h1>
                <h1 class="login-text">Login </h1><br>
            <form action="/" method="POST"> 
                <p>ID number <i id="hidden">unknown id</i></p><p><input type="text" name="idnumber" required title="type ID number"></p>
                <p>Password <i class="hidden">wrong password</i></p><p><input type="password" name="password" required title="type password"></p>
                <button type="submit" name="login">Next</button>
            </form>
            
            <p id="p">copyright&copy;faisal 2022</p>
            </div>


            <div class="left">
              <div class="left-image">
                
              </div>
            </div>


           

            </div>
        </div>

    </section>

<?php
if(isset($_POST['login'])){
  function iderror(){
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

  function paserror(){
    return '
    <style>
      .hidden{
          color:red;
      }
      input[type="password"]{
          border:1px solid red;
          box-shadow: 0px 5px 7px rgb(231, 133, 133);
      }
    </style>
    ';
  }
    include 'connection.php';

    if($connection){
        $empid = $_POST['idnumber'];
        $password = $_POST['password'];

       $select = 'SELECT *from admin where emp_id = '.$empid.'';
       $query = mysqli_query($connection, $select);
       $res = mysqli_fetch_assoc($query);

        if($empid == $res['emp_id']){
            if($password == $res['password']){
               
                session_start();
                $_SESSION['empid'] = $empid;

                header("Location: dashboard.php?success=login successful");

            }
            else{
                echo paserror();
            }
            
        }
        else{
            echo iderror();
        }


    }

    else{
       echo '
            <script>alert("error connecting to database!!")</script>
       ';
    }
}
?>

    

    
</body>
</html>