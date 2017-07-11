<?php
  include ('config.php');
  class DB{
      public $db ;
//*********** constructor : establish connection to database **********
      function __construct(){
          $this->db = mysqli_connect(configDB::$DBHost,configDB::$DBUserd,configDB::$DBUserdpass,configDB::$DBName);
          //echo "ok <br>";
          if( mysqli_connect_error()){
                echo "Can not connect";
                exit;
          }
      }
//*********************** dicinnect fn  **************************************
      function disconnect() {
            $this->db->close();
     }
//************************ get Client ID function ***************************************
      function getClientID($key){
          $query = "select id from `clients` where clientKey ='".$key."'";
          $result = mysqli_query($this->db , $query) or die(mysqli_error($this->db));
          if($result){
              $count = mysqli_num_rows($result);
              if($count > 0){
                  $res = mysqli_fetch_assoc($result);
                   return $res['id'];
                }
          }
          return False;
      }

//************************ Insert code into client_code table ***************************
      function insertCode($id , $code ,$user_id){
          $query = "insert into `client_code` (client_id,code,user_id) values ('".$id."','".$code."','".$user_id."')";
          $result = mysqli_query($this->db , $query) or die(mysqli_error($this->db));
          if(! $result){
              return False;
          }
          return True;
        }

//************************* get Client ID By Code function **************************************
      function getClientIDByCode($code){
          $query = "select client_id from `client_code` where code ='".$code."'";
          $result = mysqli_query($this->db , $query) or die(mysqli_error($this->db));
          if($result){
              $count = mysqli_num_rows($result);
              if($count > 0){
                  $res = mysqli_fetch_assoc($result);
                   return $res['client_id'];
                }
          }
          return False;
      }

//************************ check secret function **********************************************
      function checkSecret($client_id , $secret){
          $query = "select id from clients where id='".$client_id."' and secret='".$secret."'";
          $result = mysqli_query($this->db , $query) or die(mysqli_error($this->db));
          if($result){
              $count = mysqli_num_rows($result);
              if($count > 0){
                 return "True";
              }
          }
          return "False";
        }

//************************ set token into user  table ***************************
      function setToken($user_id, $token){
          $query = "update `user` set token = '".$token."' where id ='".$user_id."'";
          $result = mysqli_query($this->db , $query) or die(mysqli_error($this->db));
          if(! $result){
              return False;
          }
          return True;
        }

//************************ select user info function **********************************************
      function getUserInfo($token){
          $query = "select id,name,email from user where token ='".$token."'";
          $result = mysqli_query($this->db , $query) or die(mysqli_error($this->db));
          $count = mysqli_num_rows($result);
          if($result && $count > 0){
              $data = mysqli_fetch_assoc($result);
              return $data;
          }
          return False;
        }

}

$ss = new DB();
// $ss->disconnect();
// $mm = $ss->getClientID('12345');
//$mm = $ss->insertCode(1,"jhklkll",1);
// $mm = $ss->getClientIDByCode("a9fecf999736890dc42213ece4dac129");
// $mms = $ss->checkSecret($mm,"4c719a0a5dcfe93bc2367ea8a7811d45");
// $mms = $ss->setToken(1,"50f3a378b881a10b4661022135a1bbc2");
// $mms = $ss->getUserInfo("75f9345e3030e32c124fc3ef60fb880c");
// print_r($mms);
// echo $mms;
  ?>
