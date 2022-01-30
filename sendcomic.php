<?php
echo "Hello";
$con=mysqli_connect(getenv('SERVER'),getenv('dbusername'),getenv('dbpassword'),getenv('dbname'));
$api_url="https://xkcd.com/614/info.0.json";
$json_data = file_get_contents($api_url);
$response_data = json_decode($json_data);

echo $response_data;
?>
