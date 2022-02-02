<?php
    include 'mail.php';
    $flag=0;
    $con=mysqli_connect(getenv('SERVER'),getenv('dbusername'),getenv('dbpassword'),getenv('dbname'));
    if(!$con){
        die("Connection to this database failed due to".mysqli_connect_error());
    }
    $fname=filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
    echo $fname;
    $lname=filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
    $mail=filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $query='select * from xkcd where email=?';
    $stmt=$con->prepare($query);
    $stmt->bind_param('s',$mail);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows==0){
    $verifykey=md5(time().$mail);
    
    $sql = "INSERT INTO xkcd(firstname,lastname,email,verifykey)
VALUES ('$fname','$lname','$mail','$verifykey')";
if ($con->query($sql) === TRUE) {
    echo "Verification Mail Sent Successfully";}

$message="Please Verify Your mail address for recieving comics<a href='https://pavanrtcampassignemnt.herokuapp.com/verify.php?vkey=$verifykey'>Verify Account</a>";
 $email1 = SendMail(getenv('emailfrom'),$mail,'Email verification for comic book',$message,NULL);
    }
else
{
    echo "You have already been Subscibed";
}
?>
