<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
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
      font-size: 18px;
      color: #333;
      text-align: justify;
      font-family: "Calibri";
    }
     .container1 {
      border-radius: 5px;
      width: 45%;
      height: 100%;
      background-color: #ffffff;
      padding: 30px;
      display: block;
      box-shadow: 2px;
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
      <li><a class="active" href="contact.php"><i class="fa fa-fw fa-envelope"></i>Contact Us</a></li>
      <li><a href="about.php"><i class="fa fa-fw fa-info"></i>About Us</a></li>
      <li style="float:right"><a href="logout.php"><i class="fa fa-fw fa-close"></i>Logout</a></li>
      <li style="float:right"><a href="profile.php"> <i class="fa fa-fw fa-user"></i>Profile</a></li>
    </ul>
  </header>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>
  <div class="container">
  <h1>Get in touch</h1>
  
  <div class="container1">
    <h3 style="text-align:left;"> GROUP 3 (UVW)</h3>
    <col>
    <p><strong>Christian Yvo Holanda </strong><br>holanda@up.edu.ph <br><br>
    <strong>Cyianine Munar </strong><br>cjmunar@up.edu.ph <br><br>
    <strong>Hannah Jane Quebec </strong><br>hjquebec@up.edu.ph <br><br>
    <strong>Elary Frances Ryel Sarcos </strong><br>efsarcos@up.edu.ph <br><br>
    <strong>Jude Khristine Japzon </strong><br>jbjapzon@up.edu.ph <br><br>
    <strong>Harley N. Verunque </strong><br>hnverunque@up.edu.ph</p>
  </col>
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