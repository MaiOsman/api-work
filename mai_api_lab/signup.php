<?php
  session_start();
  // if($_SESSION['userlog']=="true"){
  //   header('Location: home.php');
  // }
  require_once('DB.php');
  if (isset($_SESSION['request_type'])){
      $request_type = $_SESSION['request_type'];
  }else{
      $request_type ="";
  }

  if (isset($_SESSION['request_email'])){
      $req_email = $_SESSION['request_email'];
    //  echo $req_email;
   }//else{
  //     //$req_email =" ";
  // }

  if(isset($_POST['fname_f']) && isset($_POST['lname_f']) &&
    isset($_POST['username_f']) && isset($_POST['email_f']) &&
    isset($_POST['passwd_f']) && isset($_POST['passwd_f'])){
    //print_r($_POST);
       $db1 = new DB();
       extract($_POST);

       if($request_type == "ord_request"){
           $query = "insert into Users (fname,lname,username,email,passwd) values('".$fname_f."', '".$lname_f."' , '".$username_f."' , '".$email_f."' , '".$passwd_f."' );";
           $res= $db1->executeQueries($query);
           if($res){
              //$_SESSION['userlog']="true";
              header('Location: home.php');
           }else {
             echo "can't insert . there is something wrong";
           }
       }
       else if($request_type == "linkedin_request" || $request_type == "google_request" || $request_type == "twitter_request"){
            $external_id = $_SESSION['external_id'];
            //echo $request_type ."---------". $passwd_f;
            //echo $ext_id_linkedin;
           $query = "insert into Users (external_id,fname,lname,username,email,passwd,type) values('".$external_id."','".$fname_f."', '".$lname_f."' , '".$username_f."' , '".$email_f."' , '".$passwd_f."','".$request_type."' );";
           $res= $db1->executeQueries($query);
           if($res){
              //$_SESSION['userlog']="true";
              header('Location: home.php');
           }else {
             echo "can't insert 1. there is something wrong";
           }
       }
       else if($request_type == "twitter_request"){

       }

    }
 ?>
<html>
  <head>
      <title>signup page</title>
  </head>
  <body>
    <?php include('header.php') ; ?>

    <div class="container">
    <div class="panel panel-primary">
     <div class="panel-heading">
       <h1><center>Sign Up</center>
    </div>

    <div class="panel-body">
          <form method="POST" action="signup.php">
              <label for="fname"> First Name : </label>
              <input type="text" name="fname_f"><br>
              <label for="lname"> Last Name : </label>
              <input type="text" name="lname_f"><br>
              <label for="username"> User Name : </label>
              <input type="text" name="username_f"><br>
              <label for="email"> E-mail :    </label>
              <input type="email" name="email_f" value="<?= $req_email ?>" ><br>
              <label for="passwd"> Password : </label>
              <input type="password" name="passwd_f"><br>
              <label for="re-passwd"> Re-Password : </label>
              <input type="password" name="re-passwd_f"><br>
              <button type="submit">Submit</button>
          </form>
        </div>
      </div>
    </div>

  </body>
</html>
