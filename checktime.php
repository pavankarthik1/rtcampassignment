<?php
$timezone = date_default_timezone_get();
#$date = new DateTime(date('Y-m-d H:i:s'));
#$res=$date->format('Y-m-d H:i:s');
$update=$con->query("INSERT INTO xkcd1(date) VALUES ('$date')");
/*$con=mysqli_connect(getenv('SERVER'), getenv('dbusername'), getenv('dbpassword'), getenv('dbname'));
   $sql = "INSERT INTO xkcd1(date) VALUES (?)";
    $stmt1 = $con->prepare($sql);
    $stmt1->bind_param('s',$date );
    $stmt1->execute();*/
echo $update;
echo "The current server timezone is: " . $timezone. $date;

?>
