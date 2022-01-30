<?php

    $con=mysqli_connect(getenv('SERVER'),getenv('dbusername'),getenv('dbpassword'),getenv('dbname'));
    $fname=filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
    $lname=filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
    $mail=filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    if(!$con){
        die("Connection to this database failed due to".mysqli_connect_error());
    }

    $sql = "INSERT INTO xkcd(firstname,lastname,email)
VALUES ('$fname','$lname','$mail')";
if ($con->query($sql) === TRUE) {
  echo "Verification Mail sent succuessfully";
    
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
