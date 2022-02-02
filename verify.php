<?php
    $con=mysqli_connect(getenv('SERVER'),getenv('dbusername'),getenv('dbpassword'),getenv('dbname'));
    if(isset($_GET['vkey']))
    {
        $vkey=$_GET['vkey'];
        $result=$con->query("select `activation`,`verifykey` from `xkcd` where `activation`= 0 and `verifykey`='$vkey' LIMIT 1 ");
        if($result->num_rows==1)
        {
            $update =$con->query("update `xkcd` set activation =1 where `verifykey`='$vkey' LIMIT 1");
            if($update)
            {
                echo '
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
            }
            else
            {
                echo $con->error;
            }
        }
        else
        {
            echo "This account is invalid or already verified.";
        }
    }
    else
    {
        die("Something went wrong");
    }
?>
