<?php
  class DB{
      public $db ;

//*********** constructor : establish connection to database **********
      function __construct(){
          $this->db = mysqli_connect('localhost','root','123456','apidb');
          //echo "ok <br>";
          if( mysqli_connect_error()){
                echo "Can not connect";
                exit;
          }
      }

//*********** executeQueries : for insert and update data **********
      function executeQueries($query){
          $result = mysqli_query($this->db , $query);
          if(! $result){
              return False;
          }else{
              return True;
            }
        }
//*********** getEmail : retrive email for spicific user **********
      function checkEmail($useEmail){

          $query = "select email from Users where email='".$useEmail."'";
          $result = @mysqli_query($this->db , $query);
          if($result){
              $count = mysqli_num_rows($result);
              if($count > 0){
                 return True;
              }
          }
          return False;
      }
//*********** getEmail : retrive email for spicific user **********
      function checkPasswd($useEmail,$userPasswd){

          $query = "select passwd from Users where email='".$useEmail."'";
          $result = @mysqli_query($this->db , $query);
          if($result){
              $count = mysqli_num_rows($result);
              if($count > 0){
                 $res = mysqli_fetch_assoc($result);
                 print_r($res);
                 echo $res['passwd']."=".$userPasswd;
                 if($res['passwd'] == $userPasswd){
                     echo "yeeeeeees";
                     return True;
                 }
              }
          }
          return False;
      }

      //*********** destructor  **********
            // function __destruct() {
          	// 	//$this->disconnect();
            //   $this->db->close();
            //   mysqli_close($this->db);
          	// }

            // function disconnect() {
          	// 	if ($this->db) {
          	// 		//@pg_close($this->db);
            //     $this->db->close();
          	// 	}
          	// }
}
  // $query = "select * from Goods";
  //                 $result = mysqli_query($db,$query);
  //                 if( ! $result ){
  //                     echo "can not query";
  //                     exit;
  //                 }
  //                 $count = mysqli_num_rows($result);
  //                 echo "you have ".$count."records<br>";
  //                 for($i=0 ; $i<$count ; $i++){
  //                     $r = mysqli_fetch_assoc($result); // to

  ?>
