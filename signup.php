<?php
    include 'mail.php';
    $con=mysqli_connect(getenv('SERVER'),getenv('dbusername'),getenv('dbpassword'),getenv('dbname'));
    $fname=filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
    echo $fname;
    $lname=filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
    $mail=filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $verifykey=md5(time().$mail);
    if(!$con){
        die("Connection to this database failed due to".mysqli_connect_error());
    }
    $sql = "INSERT INTO xkcd(firstname,lastname,email,verifykey)
VALUES ('$fname','$lname','$mail','$verifykey')";
if ($con->query($sql) === TRUE) {
    echo "Verification Mail Sent Successfully";}

$message="Please Verify Your mail address for recieving comics<a href='https://pavanrtcampassignemnt.herokuapp.com/verify.php?vkey=$verifykey'>Verify Account</a>";
 $email1 = SendMail(getenv('emailfrom'),$mail,'Email verification for comic book',$message,NULL);

?>
