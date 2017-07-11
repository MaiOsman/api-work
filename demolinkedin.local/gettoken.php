<?php
include 'DB.php';
$dbObj = new DB();

//******************* get code and token from URL ************************
$code = $_GET['code'];
$client_secret = $_GET['secret'];
//******************* get the client id who has this code ****************
$client_id = $dbObj->getClientIDByCode($code);
//******************* check if the token is correct for this client ******
$secret_check = $dbObj->checkSecret($client_id,$client_secret);

if($secret_check == "False"){
    $output = [
      'code' => '404',
      'messege' => ['wrong secret'],
      'success' => 'false',
   ];
   $putput_json = json_encode($output);
   echo $putput_json;
}else{
//*************** if secret is correct , generate random token *************
    $token = md5(uniqid(rand(), true));
    $set_token = $dbObj->setToken(1, $token);

    if($set_token == False){
        $output = [
          'code' => '404',
          'messege' => ['some thing error , please try again'],
          'success' => 'false',
       ];
       $dbObj->disconnect();
       $putput_json = json_encode($output);
       echo $putput_json;
    }
    else{
        $output = [
          'code' => '200',
          'messege' => ['user token'],
          'success' => 'true',
          'token'  => $token
       ];
       $putput_json = json_encode($output);
       echo $putput_json;
    }

}

 ?>
