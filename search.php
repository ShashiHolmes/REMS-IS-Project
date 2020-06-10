<?php 
  session_start(); 
 
  $db = mysqli_connect("localhost", "root", "", "rems1");

  $email = $_SESSION['email'];

  if (isset($_POST['search'])) {
  	$min_price = mysqli_real_escape_string($db, $_POST['min_price']);
  	$max_price = mysqli_real_escape_string($db, $_POST['max_price']);
  	$pin = mysqli_real_escape_string($db, $_POST['pin']);
  	$result = mysqli_query($db, "SELECT * FROM property2 where status='unsold' AND price >='$min_price' AND price<='$max_price' AND location = '$pin'");
   }
   else{
   	$result = mysqli_query($db, "SELECT * FROM property2 where status='un'");
   }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Search</title>
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
    .login-page {
      width: 360px;
      padding: 8% 0 0;
      margin: auto;
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
    .form1 {
      position: relative;
      z-index: 1;
      background: #FFFFFF;
      width: 40%;
      margin-left: auto;
      margin-right: auto;
      margin-top: 40px;
      padding: 45px;
      text-align: center;
      box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }
    .form1 button {
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
    .form1 button:hover,.form1 button:active,.form1 button:focus {
      background: #43A047;
    }
    .form1 input {
      font-family: "Roboto", sans-serif;
      outline: 0;
      background: #f2f2f2;
      width: 100%;
      border: 0;
      margin: 0 0 15px;
      padding: 15px;
      box-sizing: border-box;
      font-size: 14px;
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
      <li style="float: right;"> <a href="home.php?logout='1'">logout</a></li>
      <li> <a href="home.php">Home</a></li>
      <li> <a href="profile.php">Profile</a></li>
	  </ul>
    <?php endif ?>
</div>

<div class="form1">
<form method="POST" action="search.php">
        <input type="number"
          id="text1" 
          cols="40" 
          rows="1" 
          name="min_price" 
          placeholder="Minimum price" required>
      
        <input type="number"
          id="text2" 
          cols="40" 
          rows="1" 
          name="max_price" 
          placeholder="Maximum price" required>
      
        <input type="text"
          id="text3" 
          cols="40" 
          pattern="[0-9]{6}"
          title="Enter valid 6 digit pincode"
          rows="1" 
          name="pin" 
          placeholder="Enter pincode" required>
      
        <button type="submit" name="search">Search</button>
</form>
</div>
<form method="POST" action="search.php">
      <?php
        while ($row = mysqli_fetch_array($result)) {
          $pid =$row['pid'];
          echo "<div class='form'>";
            echo "<section>";
              echo "<nav>";
                  echo "<img src='property2/".$row['image']."' >";
              echo "</nav>";
              echo "<article>";
                  echo "<p><h3>".$row['pname']."</h3></p>"; 
                  $name = 'btn['.$pid.']';
                  echo "<p><i>".$row['description']."</i></p>";
                  echo "<p>Price: <b>Rs.".$row['price']."</b></p>";
                  echo "<p>Pincode: ".$row['location']."</p>";
                  echo "<button type='submit' name= '$name' value = '$name'>BUY</button>";
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
    $sql2 = "SELECT * FROM property1 where pid='$key'";
    $result2 = mysqli_query($db, $sql2);
    $row2 = mysqli_fetch_array($result2);
    $new_email = $row2['email'];
    if($email != $new_email){
    	//header("Location: buy.php?key=$key");
      echo("<script>location.href = 'buy.php?key=$key';</script>");
    }
  }
}
?>
