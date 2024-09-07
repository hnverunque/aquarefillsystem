<?php
session_start();
if(!isset($_SESSION['username'])) {
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome</title>
	<link
      rel="icon"
      href="aquarefill.png"
      type="image/x-icon"
        />
  <style>
    body {
      font-family: "Calibri";
      background-color: #DEF4FC;
      margin: 0px;
      padding: 0px;
      border: 10px;
      content: 100px
      
    }
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #74ccf4;
    }
    li {
      float: left;
    }
    li a {
      display: block;
      color: #454545;
      font-size: 19px;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }
    li a:hover {
      background-color: #bababa;
      border-radius: 0px;
    }
    section {
      margin: 0px;
      padding: 20;
      color: white;
      overflow: hidden;
      background-color: #454545;
    }
    h2 {
      font-size: 25px;
    }
section {
      margin: 0px;
      padding: 20;
      color: white;
      overflow: hidden;
      background-color: #454545;
    }
    footer {
      font-size: 13px;
      margin: 0px;
      padding: 25px;
      color: white;
      overflow: hidden;
      background-color: #454545;
    }
    .active {
  background-color: #DEF4FC;
}
.container {
  width: 97%;
  height: 100%;
  background-color: #DEF4FC;
  padding: 20px;
  display: block;
} p {
    font-size: 19px;
      color: #333;
      text-align: justify;
      font-family: "Calibri";
} .center {
display: block;
margin-left: auto;
margin-right: auto;
width: 40%;
border: 1px solid #bababa;
}

  </style>
</head>
  <header>
    <ul>
	<li><img src="aquarefill.png" alt="Logo" style="padding:10px;" width="73" height="25"> </li>
      <li><a class="active" href="home.php"><i class="fa fa-fw fa-home"></i>Home</a></li>
      <li><a href="orderform.php"><i class="fa fa-fw fa-buysellads"></i>Order Now</a></li>
      <li><a href="transactions.php"><i class="fa fa-fw fa-history"></i>Transactions</a></li>
      <li><a href="analytics.php"><i class="fa fa-fw fa-bar-chart"></i>Analytics</a></li>
      <li><a href="contact.php"><i class="fa fa-fw fa-envelope"></i>Contact Us</a></li>
      <li><a href="about.php"><i class="fa fa-fw fa-info"></i>About Us</a></li>
      <li style="float:right"><a href="logout.php"><i class="fa fa-fw fa-close"></i>Logout</a></li>
      <li style="float:right"><a href="profile.php"> <i class="fa fa-fw fa-user"></i>Profile</a></li>
    </ul>
  </header>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>
<div class="container">
  <h2 class="text-center text-warning">
    Welcome, <?php echo $_SESSION['username'];?>!
    <br>
  </h2>
  <img src="waterforless.jpg" alt="Water For Less Water Refilling Station Logo" width="474" height="157" class="center">
  <p>
<strong>Water For Less Water Refilling Station</strong> is dedicated to providing high-quality water refilling services to our community. As a trusted provider of both goods and services, we are committed to ensuring that every customer receives pure, clean, and affordable water.
<br><br>
To enhance our service delivery and streamline our operations, we are proud to introduce our new Water Refilling Management System - the <strong>Aqua Flush Refill System</strong>. This advanced system is designed to complement our existing business processes, making our services more efficient and user-friendly.
<br><br>
<strong>System Overview</strong><br>
  <i>Customer Order Management</i><br>
  The Aqua Flush Refill System will handle all aspects of customer orders, from water refills to delivery services. It will: <br>
  &#x2022; Calculate total order amounts <br>
  &#x2022; Apply loyalty rewards to customers<br>
  &#x2022; Track the transactions history<br><br>

<i>Sales and Billing </i><br>
The system will also manage our sales and billing processes. It will: <br>
  &#x2022; Generate invoices or receipts for customer orders <br>
  &#x2022; Process payments <br>
  &#x2022; Calculate itemized costs and total amounts due <br><br>

<strong>Resources Needed</strong><br>
To implement the Aqua Flush Refill System, we will require: <br>
  &#x2022; Computers or tablets for data entry and software usage <br>
  &#x2022; Printer for generating invoices and receipts <br>
  &#x2022; Internet connectivity for cloud-based software and communication with customers <br><br>
  </p>
<p>Click here to learn more <a href="Group3BA183.2TermEndProjectDocumentation.pdf">Term-End Project Documentation</a></p>
<br><br>
<p style="text-align:center; font-size: 22px;"><i>"Our goal is to provide a seamless and efficient experience for our customers while maintaining the highest standards of service. <br> We look forward to serving you better with the Aqua Flush Refill System. Thank you for your continued support!"</i>
</p> <br><br>
    <h2>Map Overview</h2>
    <div> <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d489.14961894900927!2d125.00685016012065!3d11.246917442312549!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sph!4v1715708970116!5m2!1sen!2sph" 
      width="600" height="450" style="border: 2px solid #bababa; border-radius: 10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
</div>


</body>
<footer>
<section><div class="footertext"> <i>©2024 UVW3.</i> <strong>All rights reserved.</strong> <br> 
  <strong>Aqua Flush Refill System</strong> is the educational project of Group 3 section UVW. <br>
  All other trademarks and media used on this site are the property of their respective owners. <br>
  <div id="phTime"></div> <br>
</div></section>
<script>
  function updatePHTime() {
    var phTime = new Date().toLocaleString("en-US", {timeZone: "Asia/Manila"});
    document.getElementById("phTime").innerText = "Philippine Standard Time: " + phTime;
  }

  updatePHTime();
  setInterval(updatePHTime, 1000);
</script>
</footer>
</html>
