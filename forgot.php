<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <link rel="stylesheet" type="text/css" href="loginstyle.css">
</head>
<body>
	<div class="login-page">
  <div class="login-form">
  <div class="form">
	 
  <form class="login-form" method="post" action="forgot.php">
  	<?php include('errors.php'); ?>
	<input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email" title="example: email@gmail.com" placeholder="Email" required /><br><br>
  <input type="text" name="question" pattern=".{6,}" title="Enter atleast 6 characters" placeholder="Security question" required/><br><br>
  <input type="text" name="answer" pattern=".{6,}" title="Enter atleast 6 characters" placeholder="Security answer" required/><br><br>
	<input type="password" name="password" pattern=".{6,}" title="Enter atleast 6 characters" placeholder="new password" required/><br><br>
  <input type="password" name="password1" placeholder="confirm password" required/><br><br>
  	<button type="submit" class="btn" name="forgot_user">Verify</button>
  	<p class="message">
  		Not yet a member? <a class="forgot" href="register.php">Create an account</a>
  	</p>
    <p class="message">
      Already registered? <a href="login.php">Sign in</a>
    </p>
  </form>
  </div>
  </div>
</div>
</body>
</html>