<?php 
	session_start();
	
    $pid = $_SESSION['pid'];
    $errors = array();

    $db = mysqli_connect("localhost", "root", "", "rems1");
    if(isset($_POST['confirm'])) {

      $key_code = mysqli_real_escape_string($db, $_POST['key_code']);
     
      if (empty($key_code)) {
      	array_push($errors, "Key Code is required");
      }

      if (count($errors) == 0) {
      	$key_code = md5($key_code);
      	$query1 = "SELECT * FROM property2 WHERE pid='$pid'";
      	$results1 = mysqli_query($db, $query1);
      	while ($row = mysqli_fetch_array($results1)) {
            $key = $row['key_code'];
        }
      	if($key_code == $key){
            $sql2 = "DELETE FROM property1 where pid='$pid'";
            $sql3 = "DELETE FROM property2 where pid='$pid'";
            mysqli_query($db, $sql2);
            mysqli_query($db, $sql3);
      	    header('location: property.php');
      	}else {
      		array_push($errors, "Wrong keycode!!");
      	}
      }
   }

?>


<!DOCTYPE html>
<html>
<head>
  <title>Verify Key</title>
  <link rel="stylesheet" type="text/css" href="loginstyle.css">
</head>

<body>
<h2 style="text-align:center; color: #00203FFF;">Confirm Key Code</h2>
   <div class="form">
  <form class="login-form" method="POST" action="verify_key.php">
    <?php include('errors.php'); ?> 
  	<div>
  		<label>Enter the key code of this property:</label>
  		<br><br>
  	</div>
  	<div>
  		<input type="password" name="key_code" placeholder="Keycode"><br><br>
  	</div>
  	<div>
  		<button type="submit" class="btn" name="confirm">Confirm</button>
  	</div>
  	<p>
  		Don't want to remove this property? <a href="property.php">Back</a>
  	</p>
  </form>
</div>
</body>
</html>