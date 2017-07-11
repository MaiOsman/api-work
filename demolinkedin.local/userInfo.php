<?php
include 'DB.php';
$dbObj = new DB();
//***************get token from URL ***********************
$token = $_GET['token'];
//*************** get user Info ***************************
$result = $dbObj->getUserInfo($token);
// $dbObj->disconnect();
//*************** o/p in case of wrong token **************
if($result == False){
    $output = [
      'code' => '404',
      'messege' => ['invalid token'],
      'success' => 'false',
   ];

   $putput_json = json_encode($output);
   echo $putput_json;
}else{
//*************** o/p in case of correct token **************
    $output = [
      'code' => '200',
      'messege' => [''],
      'success' => 'true',
      'userID' => $result['id'],
      'user_name' => $result['name'],
      'user_email' => $result['email'],
   ];
   $putput_json = json_encode($output);
   echo $putput_json;
}
?>
