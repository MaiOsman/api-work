<?php
session_start();
$url= "https://www.linkedin.com/oauth/v2/accessToken";
$arrayapi=array(
  'grant_type'=>'authorization_code',
  'code'=>$_GET['code'],
	'redirect_uri'=>urldecode('http://api.com/index1.php'),
  'client_id'=>'86su0gbobbk8x9',
	'client_secret'=>'Di5VtQTSXVIS58BJ');
$field_string="";
foreach($arrayapi as $key=>$value)
{

	$field_string=$field_string.$key.'='.$value.'&';

}
$field_string=rtrim($field_string,'&');
	//echo $field_string;

$ch=curl_init();
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,False);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,False);
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch,  CURLOPT_POSTFIELDS,$field_string);

$result=curl_exec($ch);
//print_r($result);
//$accessToken=json_decode($result);
curl_close($ch);

$tokenRequest = json_decode($result,true);

// create curl resource
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, 'https://api.linkedin.com/v1/people/~:(email-address,firstName,id)?format=json');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer '.$tokenRequest['access_token'],
    'Connection: Keep-Alive'
    ));
//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
$output = curl_exec($ch);

// close curl resource to free up system resources
curl_close($ch);

print_r($output);
//echo $output['firstName'];
//print_r($output['emailAddress']);
$jsonDecoded = json_decode($output,true);
//echo $jsonDecoded['r_emailaddress'];
echo $jsonDecoded['emailAddress'];
print_r($jsonDecoded['emailAddress']);
require_once('DB.php');
    $db = new DB();
    $res_email = $db->checkEmail($jsonDecoded['emailAddress']);
    echo $res_email;
    if($res_email){
      //$_SESSION['userlog']="true";
      header('Location: home.php');
    }else{
        $_SESSION['request_type'] = "linkedin_request";
        $_SESSION['external_id']=$jsonDecoded['id'];
        $_SESSION['request_email'] = $jsonDecoded['emailAddress'];
        header('Location: signup.php');
    }



?>
