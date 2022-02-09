<?php
$timezone = date_default_timezone_get();
$date = date('Y-m-d H:i:s');
$con=mysqli_connect(getenv('SERVER'), getenv('dbusername'), getenv('dbpassword'), getenv('dbname'));
$update=$con->query("INSERT INTO xkcd1(date) VALUES ($date)");
echo "The current server timezone is: " . $timezone. $date;

?>
