<?php
session_start();

$username = "";
$email    = "";
$contact  = "";
$address  = "";
$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'rems1');

if (isset($_POST['reg_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $contact = mysqli_real_escape_string($db, $_POST['contact']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $question = mysqli_real_escape_string($db, $_POST['question']);
  $answer = mysqli_real_escape_string($db, $_POST['answer']);

  if(isset($_POST['premium'])){
    $premium = mysqli_real_escape_string($db, $_POST['premium']);
  }
  else{
    $premium = mysqli_real_escape_string($db, 'no');
  }

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($question)) { array_push($errors, "Question is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) {    
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  if (count($errors) == 0) {
  	$password = md5($password_1);

  	$query = "INSERT INTO users (username, email, contact , address , password, question, answer, premium) 
  			  VALUES('$username', '$email', '$contact', '$address', '$password', '$question', '$answer', '$premium')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['premium'] = $premium;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: home.php');
  }
}

if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
  	array_push($errors, "Email is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $results = mysqli_query($db, $query);
    
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
      $_SESSION['email'] = $email;
      while ($row = mysqli_fetch_array($results)) {
        $premium=$row['premium'];
      }
      $_SESSION['premium'] = $premium;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: home.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

if (isset($_POST['admin_user'])) {
  $admin_email = mysqli_real_escape_string($db, $_POST['email']);
  $admin_password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($admin_email)) {
    array_push($errors, "Email is required");
  }
  if (empty($admin_password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $query = "SELECT * FROM admin WHERE admin_email='$admin_email' AND passcode='$admin_password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['admin_email'] = $admin_email;
      $_SESSION['success'] = "You are now logged in";
      header('location: a_dashboard.php');
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

if (isset($_POST['forgot_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $question = mysqli_real_escape_string($db, $_POST['question']);
  $answer = mysqli_real_escape_string($db, $_POST['answer']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $password1 = mysqli_real_escape_string($db, $_POST['password1']);

  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }
  if ($password != $password1) {
  array_push($errors, "The two passwords do not match");
  }

  if (count($errors) == 0) {
    $query = "SELECT * FROM users WHERE question='$question' AND answer='$answer' AND email='$email'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $password=md5($password);
      $q1= "UPDATE users set password='$password' where email='$email'";
      mysqli_query($db, $q1);
      $_SESSION['success'] = "Password reset successful";
      header('location: login.php');
    }else {
      array_push($errors, "Wrong details");
    }
  }
}

if (isset($_POST['add_admin'])) {
  $name = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $contact = mysqli_real_escape_string($db, $_POST['contact']);
  $address = mysqli_real_escape_string($db, $_POST['address']);

  if (empty($email)) {
  	array_push($errors, "Email is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  $user_check_query = "SELECT * FROM admin WHERE admin_email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) {    
    if ($user['admin_email'] === $email) {
      array_push($errors, "admin email already exists");
    }
  }

  if (count($errors) == 0) {
  	$query = "INSERT INTO admin (admin_email, name, contact , address , passcode) 
  			  VALUES('$email', '$name', '$contact', '$address', '$password')";
    mysqli_query($db, $query);
    header('location: a_dashboard.php');
  }
}


?>

