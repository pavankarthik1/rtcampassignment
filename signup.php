<?php
//This file will add all the details in to the database and send the verification mail to user 
if (isset($_POST['email'], $_POST['fname'], $_POST['lname'],$_SERVER['HTTP_HOST'],$_SERVER['HTTP_X_FORWARDED_PROTO'])) {
    include 'mail.php';
    $hs=$_SERVER['HTTP_HOST'];
    $proto=$_SERVER['HTTP_X_FORWARDED_PROTO'];
    $fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
    $lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
    $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $con = mysqli_connect(getenv('SERVER'), getenv('dbusername'), getenv('dbpassword'), getenv('dbname'));
    if (!$con) {
        die('Connection to this database failed due to' . mysqli_connect_error());
    }

    $query = 'select * from xkcd where email=?';
    $stmt = $con->prepare($query);
    $stmt->bind_param('s', $mail);
    $stmt->execute();
    $stmt->store_result();
    echo $stmt->num_rows;
    if ($stmt->num_rows == 0) {
        $verifykey = md5(time() . $mail);

        $sql = "INSERT INTO xkcd(firstname,lastname,email,verifykey)
VALUES (?,?,?,?)";
        $stmt1 = $con->prepare($sql);
        $stmt1->bind_param('ssss', $fname, $lname, $mail, $verifykey);
        $stmt1->execute();
  
        echo '<style>body{
    margin: 0;
    padding: 0;
    background-repeat: repeat-x;
    background-size: cover;
    background-position: center;
    font-family: sans-serif;
}</style><body background="unsplash01.jpg"></body><div style="width: 250px;
    height: 250px;
    
    color: #fff;
    top: 50%;
    left: 50%;
    position: absolute;
    transform: translate(-50%,-50%);
    box-sizing: border-box;
    padding: 70px 30px;
    background: linear-gradient(to bottom, #00ff99 0%, #ccff99 100%);
                border-radius: 10px;">
                <h1>Verification mail sent successfully</h1>
                </div>';
        

        $message = "Please Verify Your mail address for recieving comics<a href='$proto://$hs/verify.php?vkey=$verifykey'>Verify Account</a>";
        $email1 = SendMail(getenv('emailfrom'), $mail, 'Email verification for comic book', $message, null);
    
    } else {
        echo '<style>body{
    margin: 0;
    padding: 0;
    background-repeat: repeat-x;
    background-size: cover;
    background-position: center;
    font-family: sans-serif;
}</style><body background="unsplash01.jpg"></body><div style="width: 200px;
    height: 200px;
    
    color: #fff;
    top: 50%;
    left: 50%;
    position: absolute;
    transform: translate(-50%,-50%);
    box-sizing: border-box;
    padding: 70px 30px;
    background: linear-gradient(to bottom, #ff0000 0%, #ff6666 100%);
                border-radius: 10px;">
                <h1>You have already Registered</h1>
                </div>';
    }
}
$con->close();
?>

