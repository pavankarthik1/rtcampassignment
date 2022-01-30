<?php
    require_once dirname( __DIR__ ) . '/classes/config.php';
    $con=mysqli_connect(getenv('SERVER'),getenv('dbusername'),getenv('dbpassword'),getenv('dbname'));
    $fname=filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
    $lname=filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
    $mail=filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $verifykey=md5(time().$mail);
    if(!$con){
        die("Connection to this database failed due to".mysqli_connect_error());
    }

    $sql = "INSERT INTO xkcd(firstname,lastname,email)
VALUES ('$fname','$lname','$mail','$verifykey')";
if ($con->query($sql) === TRUE) {
    echo "Hello";
    echo getenv('api');
    $headers = array(
        "Authorization: Bearer ".getenv('Api'),
        'Content-Type: application/json'
    );
print_r($headers);
    $data=array(
        'personalizations'=>array(
            array(
                'to'=>array(
                    array(
                        'email'=>$email;
                    )
                )
            )
        ),
        'from'=>array(
            'email'=>'xkcd038@gmail.com'
        ),
        'subject'=>'Email Verifaction',
        'content'=> array(
            array(
                'type'=>'text/html',
                'value'=>"<a href='https://pavanrtcampassignemnt.herokuapp.com/verify.php?vkey=$vkey'>Verify Account</a>"
            )
        )

    );
    //'{"personalizations": [{"to": [{"email": "solletyketankumar@gmail.com"}]}],"from": {"email": "xkcd038@gmail.com"},"subject": "Sending with SendGrid is Fun","content": [{"type": "text/plain", "value": "and easy to do anywhere, even with cURL"}]}'
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.sendgrid.com/v3/mail/send');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    echo $response;
    curl_close($ch);
    


} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
