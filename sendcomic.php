<?php
include 'mail.php';
echo "Hello";
$con=mysqli_connect(getenv('SERVER'),getenv('dbusername'),getenv('dbpassword'),getenv('dbname'));
$r = rand(1,2500);
$api_url="https://xkcd.com/${r}/info.0.json";
$json_data = file_get_contents($api_url);
$response_data = json_decode($json_data,true);
$link =  $response_data["img"]; 
$link1=base64_encode(file_get_contents($link));
$sql = $con->mysql_query("select email from xkcd where activation = 1");
while($row = mysql_fetch_array($sql)) {
        $key=$row['verifykey'];
        $name=$row['fname'].$row['lname'];
        $message="<head><body>
<h2>hello $name</h2>
<br><img src='$link'/>
please click here for unsubscribe<a href='https://pavanrtcampassignemnt.herokuapp.com/unsubscribe.php?vkey=$key></a>
</body>
</head>";
 SendMail(getenv('emailfrom'),$row['email'],'comic book',$message,$link1);
}
?>
