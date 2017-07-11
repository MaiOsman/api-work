<?php
  require_once('DB.php');
  if(isset($_POST['fname_f']) && isset($_POST['lname_f']) &&
    isset($_POST['username_f']) && isset($_POST['email_f']) &&
    isset($_POST['passwd_f']) && isset($_POST['passwd_f'])){
    //print_r($_POST);
       $db1 = new DB();
       extract($_POST);
       $query = "insert into Users (fname,lname,username,email,passwd) values('".$fname_f."', '".$lname_f."' , '".$username_f."' , '".$email_f."' , '".$passwd_f."' );";
       $res= $db1->executeQueries($query);
       if($res){
          header('Location: home.php');
       }else {
         echo "can't insert . there is something wrong";
       }
    }
 ?>
<html>
  <head>
      <title>login page</title>
  </head>
  <body>
    <form method="POST" action="signup.php">
        <label for="fname"> First Name : </label>
        <input type="text" name="fname_f"><br>
        <label for="lname"> Last Name : </label>
        <input type="text" name="lname_f"><br>
        <label for="username"> User Name : </label>
        <input type="text" name="username_f"><br>
        <label for="email"> E-mail : </label>
        <input type="email" name="email_f"><br>
        <label for="passwd"> Password : </label>
        <input type="password" name="passwd_f"><br>
        <label for="re-passwd"> Re-Password : </label>
        <input type="password" name="re-passwd_f"><br>
        <button type="submit">Submit</button>
    </form>
  </body>
</html>
