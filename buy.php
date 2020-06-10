<?php 
  session_start();
  $db = mysqli_connect("localhost", "root", "", "rems1");

  $var = $_GET['key'];

  $email = $_SESSION['email'];

  $result = mysqli_query($db, "SELECT * FROM property2 where pid='$var'");

  while ($row = mysqli_fetch_array($result)) {
          $pname = $row['pname'];
          $description = $row['description'];
          $location = $row['location'];
          $price = $row['price'];
          $image = $row['image'];
          $pid = $row['pid'];
          $_SESSION['pid'] = $pid;
          $_SESSION['price'] = $price;
        }

  $sql = "SELECT * from property1 left join users on property1.email = users.email where property1.pid = $var";
  $res = mysqli_query($db, $sql);
  while ($row1 = mysqli_fetch_array($res)) {
          $name=$row1['username'];
          $email=$row1['email'];
          $contact=$row1['contact'];
          $address=$row1['address'];
          $_SESSION['o_email']=$email;
          $_SESSION['o_name']=$name;
        }


?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Buy</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

header {
  background-color: #ADEFD1FF;
  padding: 10px;
  text-align: left;
  color: #00203FFF;
}

nav {
  float: left;
  width: 33.33%;
  height: 400px;
  background: #f1f1f1;
  padding: 20px;
  object-fit: cover; 
}

nav1 {
  float: left;
  width: 33.33%;
  height: 400px;
  padding: 20px;
  object-fit: cover;
}

nav ul {
  list-style-type: none;
  padding: 0;
}

.scrollable {
  float: left;
  width: 33.33%;
  height: 400px; 
  padding: 20px;
  object-fit: cover;
  overflow-y: auto;
}

article {
  float: left;
  padding: 20px;
  width: 70%;
  background-color: #f1f1f1;
  height: 300px; 
}

section:after {
  content: "";
  display: table;
  clear: both;
}

img {
  border-radius: 20px;
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 100%;
  max-height: 100%;
}

footer {
  background-color: #ADEFD1FF;
  padding: 10px;
  text-align: center;
  color: white;
}

.button {
  background-color: #00203FFF;
  border: none;
  color: #ADEFD1FF;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
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

<header>
  <h2>Steps to follow:</h2>
  <p>1.To buy the following property contact the owner of the property.</p>
  <p>2.If the seller is willing to sell the property learn the <i><b>key code</b></i> of the property.</p>
  <p>3.Click continue and enter the <i><b>key code</b></i> to complete the transaction.</p>
</header>

<section>
  <nav>
    <h3>Owner Information:</h3>
    <?php echo "<p><b>Name:</b> $name</p>";
          echo "<p><b>e-mail:</b> $email</p>";
          echo "<p><b>Contact:</b> $contact</p>";
          echo "<p><b>Address:</b> $address</p>";
    ?>
  </nav>
  <nav1>
    <img><?php echo "<img src='property2/".$image."' >" ?></img>
  </nav1>
  <div class="scrollable">
    <h3>Property Information:</h3>
    <h4><?php echo "Name: $pname" ?></h4>
    <p><?php echo "<h4>Description:</h4> $description" ?></p>
    <p><?php echo "<b>Price:</b> Rs.$price" ?></p>
    <p><?php echo "<b>Location</b>(pincode)<b>:</b> $location" ?></p>
  </div>
</section>

<footer>
  <a href="home.php" class="button">Back</a>
  <a href="book.php" class="button">Continue</a>
</footer>

</body>
</html>
