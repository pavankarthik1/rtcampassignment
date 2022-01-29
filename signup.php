<?php
$SERVER="remotemysql.com";
    $username="zM4DxHP5rI";
    $password="BPC16e7X6D";
    $con=mysqli_connect($SERVER,$username,$password);
    if(!$con){
        die("Connection to this database failed due to".mysqli_connect_error());
    }
?>
