<?php
 

     function SendMail($from,$to,$subject,$content,$attachment){

    /*$from="xkcd038@gmail.com";
    $to="pavankarthik960@gmail.com";
    $subject="Hii";
    $content="Hey man";
    $attachment=Null;*/
    $headers = array(
        "Authorization: Bearer ".getenv('Api'),
        'Content-Type: application/json'
    );

    if($attachment == NULL){
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
            }else{
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
                        ),
                    'attachments' => array(
                        array(
                            'content' => $attachment,
                            'type' => 'image/jpeg',
                            'filename' => 'comic',
                            'disposition' => 'attachment',
                            'content_ID' => 'image-attachment',
                        )
                    ) 
                );
            }
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.sendgrid.com/v3/mail/send');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);

          
        }
    
?>
