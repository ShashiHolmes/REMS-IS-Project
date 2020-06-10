<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <link rel="stylesheet" type="text/css" href="loginstyle.css">
</head>
<body>
  
  <div class="login-page">
  <div class="login-form">
  <div class="form">
	 
  <form method="post" action="admin.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<input type="text" name="email" placeholder="email">
  	</div>
  	<div class="input-group">
  		<input type="password" name="password" placeholder="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="admin_user">Login</button>
  	</div>
  </form>
</div></div></div>
</body>
</html>