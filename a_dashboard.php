<?php include('server.php') ?>
<?php 
   if (!isset($_SESSION['admin_email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: admin.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['admin_email']);
    header("location: admin.php");
  }
  ?>
  
  <?php
  $admin_email = $_SESSION['admin_email'];
  $db = mysqli_connect("localhost", "root", "", "rems1");

  if (isset($_POST['users'])) {
  	$result = mysqli_query($db, "SELECT * FROM users");
   }
   else{
    $result = mysqli_query($db, "SELECT * FROM users where email = 'abc'");
   }

   if (isset($_POST['props'])) {
    $result1 = mysqli_query($db, "SELECT * FROM property2");
   }
   else{
    $result1 = mysqli_query($db, "SELECT * FROM property2 where pid = -1");
   }

   if (isset($_POST['trans'])) {
    $result2 = mysqli_query($db, "SELECT * FROM booking1 inner join booking2 on booking1.pid=booking2.pid");
   }
   else{
    $result2 = mysqli_query($db, "SELECT * FROM users where email = 'abc'");
   }
   
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
  <link rel="stylesheet" type="text/css" href="loginstyle.css">
  <style>
   ul{
     list-style-type: none;
     margin: 0;
     padding: 0;
     overflow: hidden;
     background-color: #00203FFF;
   }
   li{
     float: left;
   }
   li a{
     display: block;
     color: #ffffff;
     text-align: center;
     padding: 14px 16px;
     text-decoration: none;
   }
   li a:hover{
     background-color: #379683;
   }
   li button{
     color: #ffffff;
     text-align: center;
     padding: 14px 16px;
     text-decoration: none;
     background-color: #00203FFF;
   }
   li button:hover{
     background-color: #379683;
   }
   table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
th{
  background-color: #00203FFF;
  color: white;
  text-align: left;
  padding: 8px;
  border: 2px solid #dddddd;
}
td {
  border: 2px solid #dddddd;
  text-align: left;
  padding: 8px;
}
tr:nth-child(odd) {
  background-color: #f1f1f1;
}
tr:nth-child(even) {
  background-color: #ffffff;
}
form{
    width: 100%;
   }
.abc{
    width: 80%;
    padding-top: 40px;
    margin: 0 auto;
   }

   .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }

  /* Modal Content */
  .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
  }

  /* The Close Button */
  .close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
  }
  </style>
</head>
<body style="background-color: #ADEFD1FF">
  <form method="POST" action="a_dashboard.php" enctype="multipart/form-data">

    <?php  if (isset($_SESSION['admin_email'])) : ?>
	  <ul>
      <li style="float: right;"> <a href="home.php?logout='1'">Logout</a></li>
      <li style="float: right;"> <a id="myBtn">Add Admin</a></li>
      <li> <button type="submit" name="users">View Users</button></li>
      <li> <button type="submit" name="props">View Properties</button></li>
      <li> <button type="submit" name="trans">View Transactions</button></li>
	  </ul>
    <?php endif ?>

    </form>
      <div class="abc">
      <?php
      echo "<table>";
      if (isset($_POST['users'])){
        echo "<tr><th>Name</th><th>email</th><th>Contact no.</th><th>Address</th></tr>";
      }
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr><td>{$row['username']}</td><td>{$row['email']}</td><td>{$row['contact']}</td><td>{$row['address']}</td></tr>";
        }
        echo "</table>";

        echo "<table>";
      if (isset($_POST['props'])){
        echo "<tr><th>Name</th><th>Price</th><th>Pincode</th><th>Status</th></tr>";
      }
        while ($row1 = mysqli_fetch_array($result1)) {
            echo "<tr><td>{$row1['pname']}</td><td>{$row1['price']}</td><td>{$row1['location']}</td><td>{$row1['status']}</td></tr>";
        }
        echo "</table>";

        echo "<table>";
      if (isset($_POST['trans'])){
        echo "<tr><th>Owner email</th><th>Property ID</th><th>Buyer email</th></tr>";
      }
        while ($row2 = mysqli_fetch_array($result2)) {
            echo "<tr><td>{$row2['o_email']}</td><td>{$row2['pid']}</td><td>{$row2['b_email']}</td></tr>";
        }
        echo "</table>";
         ?>       

      <?php if(isset($_POST['check_pass'])){
          $query = "SELECT * FROM admin WHERE admin_email='$admin_email'";
          $results = mysqli_query($db, $query);
          while ($row = mysqli_fetch_array($results)) {
            $pass = $row['passcode'];
          }
          $password = mysqli_real_escape_string($db, $_POST['password']);
          if($password == $pass){ ?>
              <div class="login-page">
            <div class="login-form">
            <div class="form">
            
            <form class="login-form" method="post" action="a_dashboard.php">
              <?php include('errors.php'); ?>
              <input type="text" name="username" placeholder="Name" value="<?php echo $username; ?>" required/>
              <input type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email" title="example: email@gmail.com" placeholder="Email" required /><br>
              <input type="password" name="password" placeholder="password" required/>
              <input type="text"  name="contact" pattern="[0-9]{10}" placeholder="Contact number" title="Enter valid 10 digit phone no." value="<?php echo $contact; ?>" required/>
              <input type="text" name="address" placeholder="Address" value="<?php echo $address; ?>" required/>
              <br><br>
              <button type="submit" class="btn" name="add_admin">Add</button>
            </form>
            </div>
            </div>
          </div>
          <?php }else{ ?>
              <div class="login-page">
              <div class="login-form">
              <div class="form">
                  Wrong Password!
              </div>
              </div>
            </div>
          <?php }
      } ?>
      
      
          <!-- The Modal -->
          <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
              <span class="close">&times;</span>
              <?php include('errors.php'); ?>
              <p>Enter your password to continue</p><br>
              <form class="login-form" method="post" action="a_dashboard.php">
              <input type="password" name="password" id="psw" placeholder="password" required/>
              <button type="submit" class="btn" name="check_pass">Continue</button>
              </form>
            </div>
          </div>

      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
      <script>
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[0];
        
        btn.onclick = function() {
          modal.style.display = "block";
        }
        span.onclick = function() {
          modal.style.display = "none";
        }
        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
      </script>

    </div>
</body>
</html>