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
$res="select date from xkcd1";
$stmt1 = $con->prepare($res);
$stmt1->bind_result($vas);
$stmt1->execute();
$stmt1->fetch();
echo $vas;

echo "The current server timezone is: " . $timezone. $date;

?>
