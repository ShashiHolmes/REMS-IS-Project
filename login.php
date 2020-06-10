<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>User login</title>
  <link rel="stylesheet" type="text/css" href="loginstyle.css">
</head>
<body>
	<div class="login-page">
  <div class="login-form">
  <div class="form">
	 
  <form class="login-form" method="post" action="login.php">
  	<?php include('errors.php'); ?>
	<input type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email" title="example: email@gmail.com" placeholder="Email" required /><br><br>
	<input type="password" name="password" placeholder="password" required/><br><br>
  	<button type="submit" class="btn" name="login_user">Login</button>
  	<p class="message">
  		Not yet a member? <a class="forgot" href="register.php">Create an account</a>
  	</p>
    <p class="message">
      <a class="forgot" href="forgot.php">Forgot Password?</a>
    </p>
  </form>
  </div>
  </div>
</div>
</body>
</html>
