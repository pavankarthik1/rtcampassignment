<?php
$timezone = date_default_timezone_get();
$date = date('Y-m-d H:i:s');
echo "Hello";
$con=mysqli_connect(getenv('SERVER'), getenv('dbusername'), getenv('dbpassword'), getenv('dbname'));
echo "Hello";
$update=$con->query("INSERT INTO xkcd1(date) VALUES ($date)");
echo $update;
echo "The current server timezone is: " . $timezone. $date;

?>
