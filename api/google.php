<?php
session_start();
$email=$_GET['Email'];
$google_id=$_GET['ID'];

echo $email;
echo $google_id .'<br>3';
require_once('DB.php');
    $db = new DB();
    $res_email = $db->checkEmail($email);
    echo $res_email;

    if($res_email){
       //$_SESSION['userlog']="true";
       header('Location: home.php');
    }else{
        $_SESSION['request_type'] = "google_request";
        $_SESSION['external_id']=$google_id;
        $_SESSION['request_email'] = $email;
       header('Location: signup.php');
    }

 ?>
