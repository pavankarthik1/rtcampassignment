<?php
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
$from='pavankarthik960@gmail.com';
$message="<a href='https://pavanrtcampassignemnt.herokuapp.com/verify.php?vkey=$verifykey'>Verify Account</a>";
 $email1 = SendEmail::SendMail($from,$mail,'Email verification for comic book',$message,NULL);
if($email1 == FALSE){
                    $stmt = $con->prepare('DELETE FROM users WHERE email = ?');
                    $stmt->bind_param('s',$email);
                    $stmt->execute();
                }else{
                    $mail_success = 'Verification mail has been sent <br>(Note: The email would be in spam or other section)';
}
?>
