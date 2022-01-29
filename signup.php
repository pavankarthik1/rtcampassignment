<?php
$SERVER="remotemysql.com";
    $username="zM4DxHP5rI";
    $password="BPC16e7X6D";
    $con=mysqli_connect($SERVER,$username,$password);
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $mail=$_POST['email'];
    if(!$con){
        die("Connection to this database failed due to".mysqli_connect_error());
    }
    $sql = "INSERT INTO zM4DxHP5rI.xkcd(firstname,lastname,email)
VALUES ('$fname','$lname','$mail')";
if ($con->query($sql) === TRUE) {
  echo "Verification Mail sent succuessfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
