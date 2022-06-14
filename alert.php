<?php
function alert($message){
    return '
    <script>alert("'.$message.'")</script>
    ';
}

#echo alert("messagw");
?>