<?php 
	session_start();
	
	$o_email = $_SESSION['o_email'];
	$pid = $_SESSION['pid'];
	$email = $_SESSION['email'];
	$o_name = $_SESSION['o_name'];
	$price = $_SESSION['price'];
?>


<!DOCTYPE html>
<html>
<head>
  <title>Booking</title>
  <link rel="stylesheet" type="text/css" href="loginstyle.css">
</head>
<body>
	 <div class="login-page">
   <div class="login-form">
   <div class="form">
  <form class="login-form" method="POST" action="book.php">
  	<div>
  		<label>Owner Name : </label>
  		<?php echo "<b>$o_name</b>"; ?><br><br>
  	</div>
  	<div>
  		<label>Amount Payable : </label>
  		<?php echo "<b>Rs. $price</b>"; ?><br><br><br>
  	</div>
  	<div>
  		<input type="password" name="key_code" placeholder="Keycode"><br><br>
  	</div>
  	<div>
  		<input type="password" name="password" placeholder="Password"><br><br>
  	</div>
  	<div>
  		<button type="submit" class="btn" name="confirm">Confirm</button>
  	</div>
  	<p>
  		Abort transaction? <a href="home.php">Back</a>
  	</p>
  </form>
    </div>
  </div>
</div>
</body>
</html>

<?php

$db = mysqli_connect("localhost", "root", "", "rems1");
  $errors = array(); 
  if (isset($_POST['confirm'])) {

      $key_code = mysqli_real_escape_string($db, $_POST['key_code']);

      $password = mysqli_real_escape_string($db, $_POST['password']);
     
      if (empty($key_code)) {
      	array_push($errors, "Key Code is required");
      }
      if (empty($password)) {
      	array_push($errors, "Password is required");
      }

      if (count($errors) == 0) {
      	$password = md5($password);
      	$key_code = md5($key_code);
      	$query1 = "SELECT * FROM property2 WHERE pid='$pid' AND key_code='$key_code'";
      	$query2 = "SELECT * FROM users WHERE email='$email' AND password='$password'";
      	$results1 = mysqli_query($db, $query1);
      	$results2 = mysqli_query($db, $query2);
      	
      	if ((mysqli_num_rows($results1) == 1)&&(mysqli_num_rows($results2) == 1)) {
      		$query3 = "INSERT INTO booking1 (pid, b_email) VALUES ('$pid', '$email')";
      		$query4 = "INSERT INTO booking2 (pid, o_email) VALUES ('$pid', '$o_email')";
      		mysqli_query($db, $query3);
      		mysqli_query($db, $query4);
          $query5 = "UPDATE property2 SET status='sold' where pid='$pid'";
          mysqli_query($db, $query5);
      	  header('location: success.php');
      	}else {
      		array_push($errors, "Wrong keycode/password combination");
      	}
      }
   }
?>