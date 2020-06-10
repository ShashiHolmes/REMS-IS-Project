<?php 
 session_start(); 
?>

<?php
  $db = mysqli_connect("localhost", "root", "", "rems1");

  $msg = "";
  $email = $_SESSION['email'];

  if (isset($_POST['upload'])) {

    $image = $_FILES['image']['name'];

    $target = "images/".basename($image);
 
    $sql = "UPDATE users set image='$image' where email='$email'";
    mysqli_query($db, $sql);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
      $msg = "Successful";
    }else{
      $msg = "Failed";
    }

    if(mysqli_query($db, $sql)){
      header('Location: profile.php');
      exit;
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Update Profile Pic</title>
  <link rel="stylesheet" type="text/css" href="loginstyle.css">
  <style>
    ul{
     list-style-type: none;
     margin: 0;
     padding: 0;
     overflow: hidden;
     background-color: #00203FFF;
     color: ffffff;
   }
   li{
     float: left;
   }
   li a{
     display: block;
     color: white;
     text-align: center;
     padding: 14px 16px;
     text-decoration: none;

   }
   li a:hover{
     background-color: #111;
   }
  </style>
</head>
<body>
<div>
  <?php  if (isset($_SESSION['email'])) : ?>
    <ul>
      <li style="float: right;"> <a href="home.php?logout='1'">Logout</a></li>
      <li> <a href="profile.php">Back</a></li>
      <li> <a href="home.php">Home</a></li>
    </ul>
  <?php endif ?>
</div>
<div class="login-page">
<div class="login-form">
<div class="form">
    <form class="login-form" method="POST" action="pic.php" enctype="multipart/form-data">
          <input type="hidden" name="size" value="1000000000" required>
          <div>
            <input type="file" name="image" accept="image/*" title="Select an image" required>
          </div>
            <button type="submit" name="upload">Update</button>
    </form>
</div>
</div>
</div>
</body>
</html>