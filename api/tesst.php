<?php
  class DB{
      public $db ;

//*********** constructor : establish connection to database **********
      function __construct(){
          $this->db = mysqli_connect('localhost','root','123456','codeIginter');
          //echo "ok <br>";
          if( mysqli_connect_error()){
                echo "Can not connect";
                exit;
          }
      }

//*********** getEmail : retrive email for spicific user **********
      function checkEmail(){
          $query = "select * from news ";
          $result = @mysqli_query($this->db , $query);
          if($result){
              $count = mysqli_num_rows($result);
              $res = mysqli_fetch_assoc($result);
              print_r($res);

      }
      echo "llllllllllllll";

}
$db = new DB();

$db->checkEmail();

  ?>
