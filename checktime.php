<?php
function check(){
$timezone = date_default_timezone_get();
$date=new DateTime(date('Y-m-d H:i:s'));
$con=mysqli_connect(getenv('SERVER'), getenv('dbusername'), getenv('dbpassword'), getenv('dbname'));
$res="select date from xkcd1";
$stmt1 = $con->prepare($res);
$stmt1->bind_result($vas);
$stmt1->execute();
$stmt1->fetch();
$vas1=new DateTime($vas);
$stmt1->close();
$differ=$vas1->diff($date);
if($differ->format('%i')>=5){
   $res1=$date->format('Y-m-d H:i');
   $sql = 'update xkcd1 SET date = ?';
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s',$res1);
    $stmt->execute();   
   return 1;
}
   else
   {
      return 0;
   }
$con->close();
}
?>
