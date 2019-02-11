<?php

  session_start();
  $_SESSION['message'] = '';
  $_SESSION['username'] = '';

  $host = "localhost";
  $user = "tudorindan";
  $password = "------------";
  $db = "ProiectAWJ";

  $connection =  mysqli_connect($host,$user,$password,$db);

  if(isset($_POST['username'])){
    $uname = $_POST['username'];
    $password = $_POST['password'];

    $sql = "select * from users where username ='".$uname."' AND password='".$password."' limit 1";
    $result = mysqli_query($connection,$sql);

    if(mysqli_num_rows($result) == 1){
      $_SESSION['username'] = $uname;
      header("Location: http://localhost/proiectAWJ/mainApp.php?username=".$uname);
      exit();
    }else{
      $_SESSION['message'] = 'Password or username inccorect';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login or register</title>
    <link rel="stylesheet" href="./loginRegisterMenu.css">
  </head>

  <body>
    <div class = "loginBox">
          <img src="proiectAWJpoze/login-user-png-7.png" class="avatar">
          <h1>Login Here</h1>
            <form action="#" method = "post">
                <p>Username: </p>
                <input type="text" name = "username" placeholder="EnterUsername" required>
                <p>Password: </p>
                <input type="password" name = "password" placeholder="EnterPassword" required>
                <p style="color:red;font-size: 15px"><?=$_SESSION['message']?></p>
                <input type="submit" name="action" value="Login">
            </form>
            <form action="registerForm.php" >
                <input type="submit" name="action" value="Register">
            </form>
      </div>
  </body>
</html>
