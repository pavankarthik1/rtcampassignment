<?php
$con=mysqli_connect(getenv('SERVER'),getenv('dbusername'),getenv('dbpassword'),getenv('dbname'));
if(isset($_GET['vkey']))
    {
        $vkey=$_GET['vkey'];
        $result=$con->query("select `activation`,`verifykey` from `xkcd` where `activation`= 1 and `verifykey`='$vkey'");
        if($result->num_rows==1)
        {
            $update =$con->query("DELETE FROM `xkcd` WHERE verifykey='$vkey'");
            if($update)
            {
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
            }
            else
            {
                echo $con->error;
            }
        }
        else
        {
            echo "This account is already unsubscibed";
        }
    }
    else
    {
        die("Something went wrong");
    }
?>
