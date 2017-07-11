<?php
$code = $_GET['code'];
$client_secrete = "4c719a0a5dcfe93bc2367ea8a7811d45";
//***********send code and client secret to get token **************************
$json_content = file_get_contents("http://demolinkedin.local.com/gettoken.php?code=".$code."&secret=".$client_secrete);
$result = json_decode($json_content,true);
// print_r($result);
// exit;
//**********send token to user info page to recieve user data ******************
$json_content = file_get_contents("http://demolinkedin.local.com/userInfo.php?token=".$result['token']);
$result = json_decode($json_content,true);
print_r($result);
 ?>
