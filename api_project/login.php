<?php
    require_once('DB.php');
    if(isset($_POST['email_f']) && isset($_POST['passwd_f'])){
        $user_email = $_POST['email_f'];
        $user_passwd = $_POST['passwd_f'];

        $db = new DB();
        $res_email = $db->checkEmail($user_email);
        if($res_email){
            $res_passwd = $db->checkPasswd($user_email,$user_passwd);
            if($res_passwd){
                header('Location: home.php');
            }else{
                echo "wrong password";
            }
        }else{
            echo "wrong email";
        }
    }
 ?>
<html>
  <head>
      <title>login page</title>
  </head>
  <body>
      <form method="POST" action="login.php">
          <label for="email"> E-mail : </label>
          <input type="email" name="email_f" required=""><br>
          <label for="passwd"> Password : </label>
          <input type="password" name="passwd_f" required=""><br>
          <button type="submit">submit</button>
          <a href="signup.php">Sign Up</a>
     </form>
  </body>
</html>
