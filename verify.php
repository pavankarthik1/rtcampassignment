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
                echo "Your account has been verified. From now you will recieve comics.";
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
