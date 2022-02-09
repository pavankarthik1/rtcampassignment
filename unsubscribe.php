<?php
//This will unsubscribe the user mail id  
$con=mysqli_connect(getenv('SERVER'), getenv('dbusername'), getenv('dbpassword'), getenv('dbname'));
if (isset($_GET['vkey'])) {
        $vkey=$_GET['vkey'];
        $query="select `activation`,`verifykey` from `xkcd` where `activation`= 1 and `verifykey`=?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('s', $vkey);
        $stmt->execute();
        $stmt->store_result();
    if ($stmt->num_rows==1) {
        $stmt->close();
        $query1="DELETE FROM `xkcd` WHERE `verifykey`=?";
        $stmt1 = $con->prepare($query1);
        $stmt1->bind_param('s', $vkey);
    if ($stmt1->execute()) {
            $stmt1->close();
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
                <h1>You have been unsubscribed</h1>
                </div>';
        } else {
            echo $con->error;
        }
    } else {
        echo 'This account is already unsubscibed';
    }
} else {
    die('Something went wrong');
}
$con->close();
?>
