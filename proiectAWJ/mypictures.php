<?php
  session_start();
  $username = $_SESSION['username'];
  $host = "localhost";
  $user = "tudorindan";
  $password = "---------";
  $db = "ProiectAWJ";

  $connection = mysqli_connect($host,$user,$password,$db);

  if(isset($_POST['back'])){
    header("location:mainApp.php");
  }

  if($_POST['delete']){
    $sql = "DELETE FROM post where postId = '" .$_POST['delete']. "'";
    mysqli_query($connection,$sql);
  }
?>

<!DOCTYPE html>
<html>
    <head>
      <title>myPictures</title>
      <link rel="stylesheet" href="mypictures.css">
    </head>

    <body>
      <div class="backbutton">
        <form action="#" method="post">
          <span><input type="submit" name="back" value="Back"></span>
        </form>
      </div>
      <ul>
        <?php
        $sql = "SELECT postid,image FROM post INNER JOIN users u on post.idusers = u.idusers WHERE username = '".$username."' ORDER BY nrlike ASC,datapublicarii DESC";
        $posts = mysqli_query($connection,$sql);
          if(mysqli_num_rows($posts) < 1){
            $_SESSION['message'] = "No photos uploaded";?>
            <p style="color:lightgrey; font-size:20px; position:absolute;top:50%;left:calc(50% - 100px)"><?=$_SESSION['message']?></p>
    <?php }else{
              while($row = mysqli_fetch_array($posts)){ ?>
                <li>
                  <div class="imagebox">
                    <img src="<?=$row['image']?>">
                    <form action="#" method="post">
                      <input type="submit" name="delete" value="<?=$row['postid']?>">
                    </form>
                  </div>
                </li>
      <?php  } ?>
    <?php } ?>
           <!-- <li>
           <div class="imagebox">
               <img src="img/teren1.jpg">
               <form action="#" method="post">
                 <input type="submit" name="delete" value="delete">
               </form>
           </div>
         </li> -->

      </ul>

    </body>

</html>
