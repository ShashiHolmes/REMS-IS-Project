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
  $premium = $_SESSION['premium'];

  $result = mysqli_query($db, "SELECT * FROM property1 left join property2 on property1.pid= property2.pid where property2.status='unsold' AND property1.email<>'$email'");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
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

<body>
<div>
    <?php  if (isset($_SESSION['email'])) : ?>
	  <ul>
      <li style="float: right;"> <a href="home.php?logout='1'">Logout</a></li>
      <li> <a href="profile.php">Profile</a></li>
      <?php if($premium == 'yes'){ ?>
        <li> <a href="search.php">Search</a></li>
      <?php } else{ ?>
        <li> <a id="myBtn">Search</a></li>
      <?php } ?>
      <li> <a href="add.php">Add Property</a></li>
      <li> <a href="property.php">Your Properties</a></li>
	  </ul>
    <?php endif ?>
</div>

<h2 style="text-align:center; color: #00203FFF;">Properties on Sale</h2>

<form method="POST" action="home.php">
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
                  echo "<button type='submit' name= '$name' value = '$name'>BUY</button>";
              echo "<article>"; 
            echo "</section>";
          echo "</div>"; 
        }
      ?>
</form>

<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Sorry, currently you don't have access to this feature.<br>You need to have a premium account to access this feature!</p>
  </div>
</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

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