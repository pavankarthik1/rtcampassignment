<?php
// Send Comic will send random comic for every 5 minutes
require 'mail.php';
echo "Hello";
$con=mysqli_connect(getenv('SERVER'), getenv('dbusername'), getenv('dbpassword'), getenv('dbname'));
$api='https://c.xkcd.com/random/comic/';
$head=get_headers($api);
$n=parse_url(substr($var[15], 10))['path'];
$r=rand(1, str_replace('/', '', $n));
echo $r;
$api_url="https://xkcd.com/${r}/info.0.json";
$json_data = file_get_contents($api_url);
$response_data = json_decode($json_data, true);
$link =  $response_data["img"]; 
$link1=base64_encode(file_get_contents($link));// phpcs:ignore 

$sql = $con->prepare("select * from xkcd where activation = 1");
$sql->bind_result($fname, $lname, $email, $verifykey,$activation);
$sql->execute();
while ($sql->fetch()) {
	if(isset($_SERVER['HTTP_HOST'],$_SERVER['HTTP_X_FORWARDED_PROTO'])) {
	$hs=$_SERVER['HTTP_HOST'];
	$proto=$_SERVER['HTTP_X_FORWARDED_PROTO'];
	echo "Hii";
        $key=$verifykey;
        $name=$fname.$lname;
        $message="<head><body>
<h2>hello $name</h2>
<br><img src='$link'/>
<br>
please click here for<a href='$proto//$hs/unsubscribe.php?vkey=$key'> unsubscribe</a>
</body>
</head>";
    SendMail(getenv('emailfrom'), $email, 'comic book', $message, $link1);
}
}
$con->close();
?>
