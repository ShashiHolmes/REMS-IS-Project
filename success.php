<?php
	session_start();
	
	$db = mysqli_connect("localhost", "root", "", "rems1");
    
    $email = $_SESSION['email'];
    $o_email = $_SESSION['o_email'];
    $price = $_SESSION['price'];
    $pid = $_SESSION['pid'];
    $trans = md5($pid);

    $sql = "SELECT * FROM users where email='$email'";
    $sql1 = "SELECT * FROM users where email='$o_email'";
    $sql2 = "SELECT * FROM booking1 where pid='$pid'";

    $result = mysqli_query($db, $sql);
    $result1 = mysqli_query($db, $sql1);
    $result2 = mysqli_query($db, $sql2);

    if($row = mysqli_fetch_array($result)) {
          $username = $row['username'];
        }

    if($row1 = mysqli_fetch_array($result1)) {
          $o_username = $row1['username'];
        } 

    if($row2 = mysqli_fetch_array($result2)) {
          $bid = $row2['bid'];
        } 

    $query = "INSERT INTO payment (bid, trans_ref) VALUES ('$bid', '$trans')";
    mysqli_query($db, $query);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Success</title>
	<style>
    body{
      background-color: #ADEFD1FF;
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
   table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
      box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }
    th{
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

div{
    width: 80%;
    padding-top: 20px;
    margin: 0 auto;
   }
   h1 {
    text-align: center;
    color: #00203FFF;
   }
  </style>
</head>
<body>
	  <ul>
      		<li> <a href="home.php">Home</a></li>
	  </ul>
    <h1>Transaction Successful</h1>
    <div>
        <table>
          <tr>
          	<td>Client Name</td>
            <th><?php echo "$username"; ?></th>
          </tr>
          <tr>
            <td>Paid to</td>
            <th><?php echo "$o_username"; ?></th>
          </tr>
          <tr>
            <td>Amount</td>
            <th><?php echo "Rs. $price"; ?></th>
          </tr>
          <tr>
            <td>Transaction Reference No.</td>
            <th><?php echo "$trans"; ?></th>
          </tr>
        </table>
    </div>
</body>
</html>