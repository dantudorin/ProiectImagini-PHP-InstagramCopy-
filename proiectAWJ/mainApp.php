<?php
  session_start();
  $username = $_SESSION['username'];
  $host = "localhost";
  $user = "tudorindan";
  $password = "-----------";
  $db = "ProiectAWJ";

  $connection = mysqli_connect($host,$user,$password,$db);
  $sql = "SELECT useravatar,idusers FROM users where username ='".$username."'";
  $result = mysqli_query($connection,$sql);
  $row = mysqli_fetch_row($result);
  $userAvatar = $row[0];
  $userid = $row[1];

  if(isset($_POST['addPicture'])){
    $image = $_FILES['picture']['name'];
    $target = "img/".basename($image);
      if(preg_match("!image!",$_FILES['picture']['type'])){
        if(move_uploaded_file($_FILES['picture']['tmp_name'],$target)){
          $timestamp = date("Y-m-d H:i:s");
          $sql = "INSERT INTO post(image,idusers,nrlike,datapublicarii) VALUES ('$target','$userid','0','$timestamp')";

          if (mysqli_query($connection, $sql)) {
              echo "New record created successfully";
          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($connection);
            }

          // header("location: mainApp.php");
        }else{
          $_SESSION['message'] = 'image could not be loaded';
        }
      }else{
        $_SESSION['message'] = 'Please upload an image';
      }
  }

  if(isset($_POST['like'])){
    $sql = "SELECT nrlike FROM post where postid = '".$_POST['like']."'";
    $like_result = mysqli_query($connection,$sql);
    $like = mysqli_fetch_array($like_result);
    $like[0] = $like[0] + 1;

     $sql = "UPDATE post SET nrlike ='".$like[0]."' WHERE postid='".$_POST['like']."'";
     mysqli_query($connection,$sql);
     echo "hello";
    $sql = "INSERT INTO user_like (idusers,postid) VALUES('$userid','".$_POST['like']."');";
    mysqli_query($connection,$sql);
    header("location: mainApp.php");
  }

  if(isset($_POST['unlike'])){
    $sql = "SELECT nrlike FROM post where postid = '".$_POST['unlike']."'";
    $like_result = mysqli_query($connection,$sql);
    $like = mysqli_fetch_array($like_result);
    $like[0] = $like[0] - 1;

     $sql = "UPDATE post SET nrlike ='".$like[0]."' WHERE postid='".$_POST['unlike']."'";
     mysqli_query($connection,$sql);

     $sql = "DELETE FROM user_like WHERE idusers='".$userid."' AND postid='".$_POST['unlike']."'";
     mysqli_query($connection,$sql);
     header("location: mainApp.php");
  }

  if(isset($_POST['mypictures'])){
    header("location: mypictures.php");
  }

  if(isset($_POST['logout'])){
    session_destroy();
    header("location: loginRegisterMenu.php");
  }

  if(isset($_POST['addComm'])){
    if($_POST['comment'] != ''){
      $sql= "INSERT INTO comments (postid,comm) VALUES ('".$_POST['addComm']."','".$_POST['comment']."')";
      echo $sql;
      mysqli_query($connection,$sql);
      header("location: mainApp.php");
    }else{
      echo "string"; '! write something to add in comments';
    }
  }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>MainApp</title>
        <link rel="stylesheet" href="mainApp.css">
    </head>
    <body>
      <div class="userPannel">
        <img src="<?=$userAvatar?>">
        <p><?=$username?></p>
        <div class="dropdown-content">
          <form action="#" method="post">
            <input type="submit" name="mypictures" value="My Pictures">
            <input type="submit" name="logout" value="Log out">
          </form>
        </div>
      </div>

      <div class="picturesFrame">
      </div>

    <ul>
        <!-- Cod pentru fiecare poza si fiecare comentariu -->

      <?php
          $sql = "SELECT postid,image,nrlike,useravatar,username FROM post
                  INNER JOIN users u on post.idusers = u.idusers";
          $posts = mysqli_query($connection,$sql);
          while($row = mysqli_fetch_array($posts)){ ?>
            <li>
              <div class="userDetail">
                <p><?=$row['username']?></p>
                <img src="<?=$row['useravatar']?>">
              </div>
              <form action="#" method="post">
                <div class="postFull">
                    <img src="<?=$row['image']?>">
                    <?php
                      $sql = "SELECT * FROM user_like WHERE idusers='".$userid."' AND postid='".$row['postid']."'";
                      $results = mysqli_query($connection,$sql);

                      if(mysqli_num_rows($results) == 1): ?>
                        <input type="submit" name="like" value="<?=$row['postid']?>" style="display:none">
                        <input type="submit" name="unlike" value="<?=$row['postid']?>">
                    <?php else: ?>
                      <input type="submit" name="like" value="<?=$row['postid']?>" >
                      <input type="submit" name="unlike" value="<?=$row['postid']?>" style="display:none">

                    <?php endif ?>

                    <p><?=$row['nrlike']?></p>
                    <textarea name="comment" placeholder="Leave a comment" rows="1" cols="30"></textarea>
                    <input type="submit" name="addComm" value="<?=$row['postid']?>">
                    </div>
                    <ul>
                      <?php
                        $sql = "SELECT comm FROM comments where postid = '".$row['postid']."'";
                        $commsarray = mysqli_query($connection,$sql);
                          while ($comm = mysqli_fetch_array($commsarray)) { ?>
                              <li><?=$comm['comm']?></li>
                            <?php } ?>
                            <br><br>
                  </ul>
             </form>
            </li>
            <?php } ?>
   </ul>

      <div class="addPicture">
        <form action="#" method="post" enctype="multipart/form-data">
           <input type="file" name="picture">
           <input type="submit" name="addPicture" value="+ ADD PICTURE">
           <p><?=$_SESSION['message']?></p>
        </form>
      </div>
    </body>
</html>
