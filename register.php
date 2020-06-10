<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>
  <link rel="stylesheet" type="text/css" href="loginstyle.css">
</head>
<body>
<div class="login-page">
	<div class="login-form">
  <div class="form">
  <form class="login-form" method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	  <input type="text" name="username" placeholder="Name" value="<?php echo $username; ?>" required/>

  	  <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email" title="example: email@gmail.com" placeholder="Email" value="<?php echo $email; ?>" required/>

  	  <input type="text"  name="contact" pattern="[0-9]{10}" placeholder="Contact number" title="Enter valid 10 digit phone no." value="<?php echo $contact; ?>" required/>


  	  <input type="text" name="address" placeholder="Address" value="<?php echo $address; ?>" required/>
		<input type="password" pattern=".{6,}" name="password_1" title="Enter atleast 6 characters" placeholder="password" required>

  	  <input type="password" name="password_2" placeholder="confirm password" required>
      <input type="text" pattern=".{6,}" name="question" title="Enter atleast 6 characters" placeholder="Security question" required>
      <input type="text" pattern=".{6,}" name="answer" title="Enter atleast 6 characters" placeholder="Security answer" required>
	  
	  <label class="container">Premium?
		<input type="checkbox" id="premium" name="premium" value="yes">
		<span class="checkmark"></span>
	  </label>
	  

  	  <button type="submit" class="btn" name="reg_user">Register</button>

  	<p class="message">
  		Already registered? <a href="login.php">Sign in</a>
  	</p>
  </form>
</div>
</div>
</div>
</body>
</html>
