<?php
    session_start();
    // if(isset($_SESSION['userlog']) && $_SESSION['userlog']=="true"){
    //   header('Location: home.php');
    // }
    if(! isset($_SESSION['request_type']) && ! isset($_SESSION['request_email'])){
        $_SESSION['request_type'] = "ord_request";
        $_SESSION['request_email'] =" ";
    }
    $_SESSION['request_type'] = "ord_request";
    $_SESSION['request_email'] =" ";
    require_once('DB.php');
    if(isset($_POST['email_f']) && isset($_POST['passwd_f'])){
        $user_email = $_POST['email_f'];
        $user_passwd = md5($_POST['passwd_f']);

        $db = new DB();
        $res_email = $db->checkEmail($user_email);
        if($res_email){
            $res_passwd = $db->checkPasswd($user_email,$user_passwd);
            if($res_passwd){
                //$_SESSION['userlog']="true";
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
      <meta name="google-signin-client_id" content="447999419591-i1dblb458cp4vcjjrls1r18v34v1fnbc.apps.googleusercontent.com">
      <script src="https://apis.google.com/js/platform.js" async defer></script>
  </head>
  <body>
      <?php include('header.php') ; ?>

      <div class="container">
      <div class="panel panel-primary">
       <div class="panel-heading">
         <h1><center>Login</center>
      </div>

      <div class="panel-body">
            <form method="POST" action="login.php">
                <label for="email"> E-mail : </label>
                <input type="email" name="email_f" required=""><br>
                <label for="passwd"> Password : </label>
                <input type="password" name="passwd_f" required=""><br>
                <button type="submit">submit</button>
                <a href="signup.php">Sign Up</a>

                <a href="https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=86su0gbobbk8x9&redirect_uri=http://api.com/index1.php&state=987654321&scope=r_basicprofile%20r_emailaddress">sign in with LinkedIn</a>
                <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
                 <script>

                   function onSignIn(googleUser) {
                     // Useful data for your client-side scripts:
                     var profile = googleUser.getBasicProfile();
                     console.log("ID: " + profile.getId()); // Don't send this directly to your server!
                     console.log('Full Name: ' + profile.getName());
                     console.log('Given Name: ' + profile.getGivenName());
                     console.log('Family Name: ' + profile.getFamilyName());
                     console.log("Image URL: " + profile.getImageUrl());
                     console.log("Email: " + profile.getEmail());

                     // The ID token you need to pass to your backend:
                     var id_token = googleUser.getAuthResponse().id_token;
                     console.log("ID Token: " + id_token);
                     location.href='google.php?ID='+profile.getId()+'&Name='+profile.getName()+'&Image='+profile.getImageUrl()+'&Email='+profile.getEmail();
                   };
                 </script>
           </form>
      </div>
      </div>
      </div>
  </body>
</html>
