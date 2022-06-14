<?php
/*echo '
<script>
var conf = confirm("are you sure you want to delete this file?");

</script>
';*/
include 'connection.php';

$path = $_GET['path'];
$empid = $_GET['empid'];

$delete = 'DELETE from files where path = "'.$path.'"';

$query = mysqli_query($connection,$delete);
if($query){
    
   header('location: eachemp.php?empid='.$empid.'');
}
else{
    echo 'file was unable to delete';
}