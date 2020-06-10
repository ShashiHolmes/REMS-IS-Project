<!DOCTYPE html>
<html>
<head>
  <title>Welcome</title>
<style>
* {
  box-sizing: border-box;
}
body {
  font-family: Arial;
  padding: 10px;
 /* background-color: #FFFFFF;*/
}
.header {
  height: 500px;
  padding: 30px;
  text-align: center;
  background: white;
  background-attachment: fixed;
  background-image: url(images/overlay.png) , url(images/banner.jpg);
  background-position: center center;
  background-size: cover;
}
.header h1 {
  margin-top: 50px;
  font-size: 60px;
  color: #ffffff;
}
.topnav {
  overflow: hidden;
  background-color: #00203FFF;
}
.topnav a {
  float: left;
  display: block;
  color: #FFFFFF;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}
.topnav a:hover {
  background-color: #FFFFFF;
  color: #00203FFF;
}
.leftcolumn {   
  float: left;
  width: 80%;
}
.rightcolumn {
  float: left;
  width: 20%;
  padding-left: 20px;
}
.img {
  background-color: #aaa;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  margin-left: auto;
  margin-right: auto;
  display: block;
}
.card {
  color: #FFFFFF; 
  padding: 5px;
  margin-top: 20px;
  background-attachment: fixed;
  background-image: url(images/overlay.png) , url(images/banner.jpg);
  background-position: center center;
  background-size: cover;

  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.row:after {
  content: "";
  display: table;
  clear: both;
}
.footer {
  padding: 20px;
  text-align: center;
  background: #ddd;
  margin-top: 20px;
  background-attachment: fixed;
  background-image: url(images/overlay.png) , url(images/banner.jpg);
  background-position: center center;
  background-size: cover;
}
@media screen and (max-width: 800px) {
  .leftcolumn, .rightcolumn {   
    width: 100%;
    padding: 0;
  }
}
@media screen and (max-width: 400px) {
  .topnav a {
    float: none;
    width: 100%;
  }
}
</style>
</head>
<body>

<div class="header">
  <h1>Real Estate Management System</h1>
  <p style="color: #A9A9A9; font-size:30px;">Let Us Guide You Home</p>
</div>

<div class="topnav">
  <a href="login.php" style="float:right">User Login</a>
  <a href="register.php" style="float:right">User SignUp</a>
  <a href="admin.php" style="float:right">Login as Admin</a>
</div>

<div class="row">
  <div class="leftcolumn">
    <div style="height: 423px;" class="card">
      <h2>About this project</h2>
      <h5>Real Estate Management System, June 10, 2020</h5>
      <p>This project deals with online buying and selling of properties. Some of the properties of this project are <br><br> 1. Price and pincode based search for properties.<br><br>2. Verification of buyer using keycode gained by contacting the seller offline.<br><br> 3. Password encryption during database updation to ensure safety even from the admin<br><br>4. Unique transaction reference number on every successful transaction through the website.</p>
    </div>
  </div>
  <div class="rightcolumn">
    <h2 style="text-align: center; color: #00203FFF;">About Us</h2>
    <div class="card">
      <img src="images/shashi.jpeg" class="img">
      <p style="text-align: center;">Shashi Kumar M S<br>VI sem CSE dept.</p>
    </div>
    <div class="card">
      <img src="property2/sanath.jpg" class="img">
      <p style="text-align: center;">Sanath Ramesh<br>VI sem CSE dept.</p>
    </div>
  </div>
</div>

<div class="footer">
  <p style="color: #FFFFFF;">This project is done under the course Information Security<br>Computer Science and Engineering Dept.<br>National Institute of Technology Karnataka, Surathkal<br><br><i>Guided by :Mahendra Pratap Singh Sir</i></p>
</div>

</body>
</html>