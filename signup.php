<?php
$SERVER="remotemysql.com";
    $username="zM4DxHP5rI";
    $password="BPC16e7X6D";
    $con=mysqli_connect($SERVER,$username,$password);
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $mail=$_POST['email'];
    if(!$con){
        die("Connection to this database failed due to".mysqli_connect_error());
    }
    $sql = "INSERT INTO zM4DxHP5rI.xkcd(firstname,lastname,email)
VALUES ('$fname','$lname','$mail')";
if ($con->query($sql) === TRUE) {
  echo "Verification Mail sent succuessfully";
    
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$headers = array(
                "Authorization: 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",
                'Content-Type: application/json'
            );
$to='pavankarthik961@gmail.com';
$from='comicmailer@gmail.com';
$subject='Test';
$content='Hii';
$data = array(
                    'personalizations' => array(
                        array(
                            'to' => array (
                                array(
                                    'email' => $to,
                                )
                            )
                        )
                    ),
                    'from' => array(
                        'email' => $from
                    ),
                    'subject' => $subject,
                    'Content' => array(
                        array(
                            'type' => 'text/html',
                            'value' => $content
                        )
                    )
                );   
 $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.sendgrid.com/v3/mail/send');
curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
   curl_close($ch);

            if($response != ''){
                return FALSE;
            }else{
                echo "Verification Mail sent succuessfully !@#$";
            }

?>
