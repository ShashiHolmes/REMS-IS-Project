<?php 
 session_start(); 
?>

<?php
  $db = mysqli_connect("localhost", "root", "", "rems1");

  $msg = "";
  $email = $_SESSION['email'];

  if (isset($_POST['upload'])) {

    $image = $_FILES['image']['name'];

    $pname = mysqli_real_escape_string($db, $_POST['pname']);

    $description = mysqli_real_escape_string($db, $_POST['description']);

    $price = mysqli_real_escape_string($db, $_POST['price']);

    $location = mysqli_real_escape_string($db, $_POST['location']);

    $key = mysqli_real_escape_string($db, $_POST['key_code']);

    $key_code = md5($key);

    $target = "property2/".basename($image);
 
    $sql = "INSERT INTO property2 (image, pname, description, price, location, key_code ) VALUES ('$image', '$pname', '$description', '$price', '$location', '$key_code')";
  
    $get_email = $_SESSION['email'];
	  $sql1 = "INSERT INTO property1 (email) VALUES('$get_email')";
    mysqli_query($db, $sql1);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
      $msg = "Successful";
    }else{
      $msg = "Failed";
    }

    if(mysqli_query($db, $sql)){
      echo("<script>location.href = 'home.php';</script>");
      exit;
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
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
      <li> <a href="home.php">Home</a></li>
      <li> <a href="profile.php">Profile</a></li>
    </ul>
  <?php endif ?>
</div>

<h2 style="text-align:center; color: #00203FFF;">Add Property to Sell</h2>
<div class="form">
    <form class="login-form" method="POST" action="add.php" enctype="multipart/form-data">
          <input type="hidden" name="size" value="1000000000" required>
          <div>
            <input type="file" name="image" accept="image/*" title="Select an image" required>
          </div>

            <input type="text" 
              id="text0" 
              cols="40" 
              rows="1" 
              name="pname" 
              placeholder="Property name..." required>
          
            <input type="text"
              id="text" 
              cols="40" 
              rows="4" 
              name="description" 
              placeholder="Property description..." required>
          
            <input type="number"  
              id="text1" 
              cols="40" 
              rows="1" 
              name="price" 
              placeholder="Enter price in Indian Rs" required>
          
            <input type="text"
              id="text2" 
              cols="40" 
              rows="1" 
              pattern="[0-9]{6}"
              title="Enter valid 6 digit pincode"
              name="location" 
              placeholder="Enter the pincode" required>
          
            <input
              type="password" 
              id="text3"  
              rows="1" 
              name="key_code" 
              placeholder="Enter the key code" required>
      
            <button type="submit" name="upload">Sell</button>
    </form>
</div>
</body>
</html>