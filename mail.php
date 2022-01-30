<?php
    
    
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
                        'email'=>'pavankarthik960@gmail.com'.'solletyketankumar@gmail.com'
                    )
                )
            )
        ),
        'from'=>array(
            'email'=>'xkcd038@gmail.com'
        ),
        'subject'=>'Hi',
        'content'=> array(
            array(
                'type'=>'text/html',
                'value'=>'Hey man'
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
    

    curl_close($ch);
    
?>
