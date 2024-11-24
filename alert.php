<?php 
    $name =  $_POST['name'];
    $typeContact = $_POST['tpyeContact'];
    $numberBlack = $_POST['numberBlack'];
    $roomSelect = $_POST['roomSelect'];

    $message = " คุณ  :".$name."\n หมายเลขคดี :".$numberBlack."\n ผู้มาติดต่อในฐานะ : ".$typeContact."\n ติดต่อกลุ่มงาน : ".$roomSelect;    



// 2DLQqy62EUHrb0rIznh2TfdwQ7EjFw74VM1kQGqDd09  //Line Notify
    $tokenLine = '2DLQqy62EUHrb0rIznh2TfdwQ7EjFw74VM1kQGqDd09';


$url        = 'https://notify-api.line.me/api/notify';
$token      = $tokenLine;
$headers    = [
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Bearer '.$tokenLine
            ];
$fields     = 'message='.$message;
$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, $url);
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec( $ch );
curl_close( $ch );

var_dump($result);
$result = json_decode($result,TRUE);


?>