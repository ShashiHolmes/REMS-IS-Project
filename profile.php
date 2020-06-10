<?php 
  session_start();
  
  $db = mysqli_connect("localhost", "root", "", "rems1");

  $email = $_SESSION['email'];

  $result = mysqli_query($db, "SELECT * FROM users where email='$email'");

  while ($row = mysqli_fetch_array($result)) {
          $name=$row['username'];
          $email=$row['email'];
          $contact=$row['contact'];
          $address=$row['address'];
          $image=$row['image'];
        }

?>



<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
.card {
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
  max-width: 300px;
  margin-top: 50px;
  padding-top: 1px;
  background-color: white;
  margin-left: auto;
  margin-right: auto;
  text-align: center;
  font-family: arial;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}
a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}
button:hover, a:hover {
  opacity: 0.7;
}
body{
  background-color: #ADEFD1FF;
}
img{
  background-color: #aaa;
  width: 150px;
  height: 150px;
  border-radius: 50%;
  margin-top: 20px;
  margin-left: auto;
  margin-right: auto;
  display: block;
}
</style>
</head>
<body>
<?php  if (isset($_SESSION['email'])) : ?>
    <ul>
      <li style="float: right;"> <a href="home.php?logout='1'">Logout</a></li>
      <li> <a href="home.php">Home</a></li>
      <li> <a href="property.php">Your Properties</a></li>
      <li> <a href="pic.php">Update Profile pic</a></li>
    </ul>
<?php endif ?>
<div class="card">
  <?php if($image){
    echo "<img src='images/".$image."' alt='$name'>";
  }
  else{
    echo "<img src='images/background.png' alt='$name'>";
  } ?>
  <h1><?php echo "$name"; ?></h1>
  <p class="title"><?php echo "$email"; ?></p>
  <p><?php echo "$address"; ?></p>
  <p><button><?php echo "$contact"; ?></button></p>
</div>

</body>
</html>