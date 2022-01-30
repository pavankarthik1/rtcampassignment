<?php
echo "Hello";
$con=mysqli_connect(getenv('SERVER'),getenv('dbusername'),getenv('dbpassword'),getenv('dbname'));
$api_url="https://xkcd.com/614/info.0.json";
$json_data = file_get_contents($api_url);
$response_data = json_decode($json_data,true);
$link =  $response_data["img"]; 
$link=base64_encode(file_get_contents($link));
 $htmlContent = "<html>
                            <head>
                            <title>$response_data->safe_title</title>
                            <style>
                                button{
                                    padding: 10px;
                                    font-size: 1rem;
                                    border: none;
                                    background-color: #427fed;
                                    color: white;
                                    cursor: pointer;
                                }
                                h3{
                                    color: red;
                                }
                            </style>
                            </head>
                            <body>
                                <h2>Title : $response_data->alt</h2>
                                <img src="$link" alt=".$response_data->img." /><br/>
                                
                                <h3>If you want to unsubscribe this comic mail tap on the below button</h3>
                               
                            </body>
                            </html>";
$headers = array(
        "Authorization: Bearer ".getenv('Api'),
        'Content-Type: application/json'
    );

    $data=array(
        'personalizations'=>array(
            array(
                'to'=>array(
                    array(
                        'email'=>'pavankarthik960@gmail.com'
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
                'value'=>$htmlcontent
            )
        ),
            'attachments' => array(
                        array(
                            'content' => $link,
                            'type' => 'image/jpeg',
                            'filename' => 'comic',
                            'disposition' => 'attachment',
                            'content_ID' => 'image-attachment',
                        ))

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
