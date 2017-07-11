<?php
include 'DB.php';
$key = $_GET['key'];

$dbObj = new DB();
//********* get client id by key *****************
$client_id = $dbObj->getClientID($key);
//********* generate random code *****************
$code = md5(uniqid(rand(), true));
//********* set the code for this client *********
$result = $dbObj->insertCode($client_id,$code,1);
// $dbObj->disconnect();
if($result == False){
    $output = [
      'code' => '404',
      'messege' => ['some thing error , please try again'],
      'success' => 'false',
   ];
      $dbObj->disconnect();
   $putput_json = json_encode($output);
   echo $putput_json;
}else{
    header("Location: http://mywebsite.local.com/callback.php?code=$code");
}




 ?>
