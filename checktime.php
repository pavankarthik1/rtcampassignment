<?php
$timezone = date_default_timezone_get();
$date=new DateTime(date('Y-m-d H:i:s'));
$res=$date->format('Y-m-d H:i:s');
$con=mysqli_connect(getenv('SERVER'), getenv('dbusername'), getenv('dbpassword'), getenv('dbname'));
$update=$con->query("INSERT INTO xkcd1(date) VALUES ('$res");
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
//$date1=new DateTime($vas);
//echo $date1;
//$date2=new DateTime($date);
/*$date_input = strtotime($date);
$date_input1 = getDate($date_input); 
$date_fetch = strtotime($vas);
$date_fetch1 = getDate($date_fetch1); 
echo gettype($date_input1);
echo gettype($date_fetch1);*/
$diff=$date1->diff($date2);
echo $diff->format('Y-m-d H:i:s');

echo "The current server timezone is: " . $timezone. $date;

?>
