<?php
function alert($message):string{
    return '
    <script>alert("'.$message.'")</script>
    ';
}

#echo alert("messagw");
?>
