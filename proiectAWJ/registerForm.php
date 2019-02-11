<?php
  session_start();
  $_SESSION['message'] = '';

  $host = "localhost";
  $user = "tudorindan";
  $password = "-----------";
  $db = "ProiectAWJ";

  $connection =  mysqli_connect($host,$user,$password,$db);

  $sql ="select * from users where username ='".$_POST['username']."' OR email='".$_POST['email']."' limit 1";
  $result = mysqli_query($connection,$sql);
  mysqli_close($connection);

  if(mysqli_num_rows($result) == 1){
      $_SESSION['message'] = 'Userul exista in baza de date.Incercati alt username sau email';
  }else{
    if( $_POST['password'] == $_POST['confirmPassword']){
        $mysqli = new mysqli($host,$user,$password,$db);
        $username = $mysqli->real_escape_string($_POST['username']);
        $userpass = $mysqli->real_escape_string($_POST['password']);
        $email = $mysqli-> real_escape_string($_POST['email']);
        $image = $_FILES['avatar']['name'];
        $target = "avatar/".basename($image);
        if(preg_match("!image!",$_FILES['avatar']['type'])){

          if(move_uploaded_file($_FILES['avatar']['tmp_name'],$target)){
            $sql = "INSERT INTO users (username,password,email,useravatar) VALUES ('$username','$userpass','$email','$target')";

            if($mysqli->query($sql) == true){
              header("location: loginRegisterMenu.php");
            }else{
              $_SESSION['message'] = 'Something went wrong adding into database';
            }
          }else{
            $_SESSION['message'] = 'Unable to upload file';
          }
      }else{
           $_SESSION['message'] = 'Please submit only image format types';
      }
    }else{
      $_SESSION['message'] = 'Parolele nu se potrivesc';
    }
  }

?>


<!DOCTYPE html>
<html>
  <head>
    <title>Registration Form</title>
    <link rel="stylesheet" href="registerForm.css">
  </head>

  <body>
      <div class="registerBox">
        <img src="proiectAWJpoze/registernow.png">
        <form action="#" method="post" enctype="multipart/form-data">
          <input type="text" name="username" placeholder="Username" required >
          <input type="text" name="email" placeholder="Email" required>
          <input type="password" name="password" placeholder="Password" required>
          <input type="password" name="confirmPassword" placeholder="ConfirmPassword" required>
          <input type="file" name="avatar"  required>
          <p style="color:red; font-size:17px;z-index = 3;position:absolute;top:250px;"><?=$_SESSION['message'] ?></p>
          <input type="submit" name="register" value="Register">
        </form>
      </div>
  </body>


</html>
