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
                echo '<style >
	div {
  border: 2px solid black;
  box-shadow: 10px 10px 8px 10px #888888;
    margin: auto;
  width: 50%;
    height: 180px;
  width: 350px;
}
</style>
<div align="center" >
	<img src="index.png " height =80 width=80/>
	<h1 style="font-family:verdana;">You have been subscibed</h1>
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
