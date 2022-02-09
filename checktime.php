<?php
$timezone = date_default_timezone_get();
$date = date('Y-m-d H:i:s');
#$res=$date->format('Y-m-d H:i:s');
$con=mysqli_connect(getenv('SERVER'), getenv('dbusername'), getenv('dbpassword'), getenv('dbname'));
$update=$con->query("INSERT INTO xkcd1(date) VALUES ('$date')");
/*
   $sql = "INSERT INTO xkcd1(date) VALUES (?)";
    $stmt1 = $con->prepare($sql);
    $stmt1->bind_param('s',$date );
    $stmt1->execute();*/
echo $update;
echo "The current server timezone is: " . $timezone. $date;

?>
