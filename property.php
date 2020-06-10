<?php 
 session_start(); 
 
  if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: index.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: index.php");
  }
?>
<?php
  $db = mysqli_connect("localhost", "root", "", "rems1");

  $msg = "";
  $email = $_SESSION['email'];

  $result = mysqli_query($db, "SELECT * FROM property1 inner join property2 on property1.pid=property2.pid where property1.email='$email' and property2.status='unsold'");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Your Properties</title>
  <style>
    * {
       box-sizing: border-box;
      }
    body {
      background: #76b852; 
      background: -webkit-linear-gradient(right, #ADEFD1FF, #ADEFD1FF);
      background: -moz-linear-gradient(right, #ADEFD1FF, #ADEFD1FF);
      background: -o-linear-gradient(right, #ADEFD1FF, #ADEFD1FF);
      background: linear-gradient(to left, #ADEFD1FF, #ADEFD1FF);
      font-family: "Roboto", sans-serif;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;      
    }
    .form {
      position: relative;
      z-index: 1;
      background: #FFFFFF;
      width: 80%;
      margin-left: auto;
      margin-right: auto;
      margin-top: 40px;
      padding: 45px;
      text-align: center;
      box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }
    .form button {
      font-family: "Roboto", sans-serif;
      text-transform: uppercase;
      outline: 0;
      background: #00203FFF;
      width: 50%;
      border: 0;
      padding: 15px;
      color: #ADEFD1FF;
      font-size: 14px;
      -webkit-transition: all 0.3 ease;
      transition: all 0.3 ease;
      cursor: pointer;
    }
    .form button:hover,.form button:active,.form button:focus {
      background: #43A047;
    }
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
   img{
    float:center;
    margin: 0px;
    width: 100%;
    height: 100%;
   }
   nav{
      float: left;
      width: 40%;
      height: 300px;
      padding: 5px;
      object-fit: cover;
    }
    article{
      float: left;
      width: 60%;
      height: 300px;
      padding: 20px;
      overflow-y: auto;
    }
    section:after {
      content: "";
      display: table;
      clear: both;
    }
    @media (max-width: 600px) {
      nav, article {
        width: 100%;
        height: auto;
      }
    }
  </style>
</head>
<body>

<div>
    <?php  if (isset($_SESSION['email'])) : ?>
	  <ul>
      <li style="float: right;"> <a href="home.php?logout='1'">Logout</a></li>
      <li> <a href="home.php">Home</a></li>
      <li> <a href="add.php">Add Property</a></li>
	  </ul>
    <?php endif ?>
</div>
<h2 style="text-align:center; color: #00203FFF;">Your Properties</h2>
<form method="POST" action="property.php">
      <?php
        while ($row = mysqli_fetch_array($result)) {
          $pid =$row['pid'];
          $name = 'btn['.$pid.']';
          echo "<div class='form'>";
            echo "<section>";
              echo "<nav>";
                  echo "<img src='property2/".$row['image']."' >";
              echo "</nav>";
              echo "<article>";
                  echo "<p><h3>".$row['pname']."</h3></p>"; 
                  echo "<p><i>".$row['description']."</i></p>";
                  echo "<p>Price: <b>Rs.".$row['price']."</b></p>";
                  echo "<p>Pincode: ".$row['location']."</p>";
                  echo "<button type='submit' name= '$name' value = '$name'>Remove Property</button>";
              echo "<article>"; 
            echo "</section>";
          echo "</div>"; 
        }
      ?>
</form>
</body>
</html>

<?php 
  if(isset($_POST['btn'])){
  foreach($_POST['btn'] as $key => $value){
    $_SESSION['pid'] = $key;
    echo("<script>location.href = 'verify_key.php';</script>");
  }
}
?>