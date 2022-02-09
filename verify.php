<?php
//Verify php file will  verify the user mail Id
$con = mysqli_connect(getenv('SERVER'), getenv('dbusername'), getenv('dbpassword'), getenv('dbname'));
if (isset($_GET['vkey'])) {
    $vkey = $_GET['vkey'];
    $query1="select `activation`,`verifykey` from `xkcd` where `activation`= 0 and `verifykey`=? LIMIT 1";

     $stmt1 = $con->prepare($query);
     $stmt1->bind_param('s', $vkey);
     $stmt1->store_result();
    if ($stmt1->num_rows == 1) {
        $stmt1->close();
        $query="update `xkcd` set activation =1 where `verifykey`=? LIMIT 1";
        $stmt = $con->prepare($query);
        $stmt->bind_param('s', $vkey);
        if ($stmt->execute()) {
            echo '<style>body{
    margin: 0;
    padding: 0;
    background-repeat: repeat-x;
    background-size: cover;
    background-position: center;
    font-family: sans-serif;
}</style><body background="unsplash01.jpg"></body>
<div style="width: 200px;
    height: 200px;
    
    color: #fff;
    top: 50%;
    left: 50%;
    position: absolute;
    transform: translate(-50%,-50%);
    box-sizing: border-box;
    padding: 70px 30px;
    background: linear-gradient(to bottom, #00ff00 0%, #99ff99 100%);
                border-radius: 10px;">
                <h1>You have been subscribed</h1>
                </div>';
        } else {
            echo $con->error;
        }
    } else {
        echo 'This account is invalid or already verified.';
    }
} else {
    die('Something went wrong');
}
$con->close();
?>

