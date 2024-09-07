<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>
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
      content: 100px;
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
    h1 {
      font-size: 25px;
    }
    .box {
        display: inline-block;
        align: center;
        width: 400px;
        height: 400px;
        background-color: #f0f0f0;
        margin-right: 10px;
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
  height:100%;
  background-color: #DEF4FC;
  padding: 20px;
  display: block;
} p {
  font-size: 19px;
  color: #333;
  text-align: justify;
  font-family: "Calibri";
}
.center {
display: block;
margin-left: auto;
margin-right: auto;
width: 40%;
}
    
  </style>
</head>
  <header>
    <ul>
	<li><img src="aquarefill.png" alt="Logo" style="padding:10px;" width="73" height="25"> </li>
      <li><a href="home.php"><i class="fa fa-fw fa-home"></i>Home</a></li>
      <li><a href="orderform.php"><i class="fa fa-fw fa-buysellads"></i>Order Now</a></li>
      <li><a href="transactions.php"><i class="fa fa-fw fa-history"></i>Transactions</a></li>
      <li><a href="analytics.php"><i class="fa fa-fw fa-bar-chart"></i>Analytics</a></li>
      <li><a href="contact.php"><i class="fa fa-fw fa-envelope"></i>Contact Us</a></li>
      <li><a class="active" href="about.php"><i class="fa fa-fw fa-info"></i>About Us</a></li>
      <li style="float:right"><a href="logout.php"><i class="fa fa-fw fa-close"></i>Logout</a></li>
      <li style="float:right"><a href="profile.php"> <i class="fa fa-fw fa-user"></i>Profile</a></li>
    </ul>
  </header>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>
<div class="container">
  <h1>About the Website</h1>
  <img src="aquarefill.png" alt="Aqua Flush Refill System Logo" width="" height="" class="center">
  <p> <strong>Water For Less Water Refilling Station</strong> is dedicated to providing high-quality water refilling services to our community. As a trusted provider of essential goods and services, we continually seek ways to enhance our operations and improve customer satisfaction. To achieve this, we have developed the <strong>Aqua Flush Refill System</strong>, a state-of-the-art Water Refilling Management System designed to streamline business processes. <br><br>
    To support the implementation of our Term-End Project, we utilize computers or tablets for data entry and software usage, a printer for generating invoices and receipts, and internet connectivity for cloud-based software and communication with customers. This comprehensive approach ensures that our services are both efficient and reliable. <br><br>
    Our team, composed of dedicated students <i>Christian Yvo Holanda, Cyianine Munar, Hannah Jane Quebec, Elary Frances Ryel Sarcos, Jude Khristine Japzon, and Harley N. Verunque </i> from <strong>BA 183.2 Basic Programming and Database Management</strong> section <strong>UVW</strong> for the Second <strong>Semester of Academic Year 2023-2024</strong>, is committed to leveraging technology to improve our operations and elevate the customer experience at Water For Less Water Refilling Station.
  </p>
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
