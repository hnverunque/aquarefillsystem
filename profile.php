<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: profile.php");
  exit();
}

$dsn = 'mysql:host=127.0.0.1;dbname=uvw3';
$username_db = 'root';
$password_db = '';

try {
    $pdo = new PDO($dsn, $username_db, $password_db);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM credentials WHERE username=:username";
$stmt = $pdo->prepare($sql);
$stmt->execute(['username' => $username]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$result) {
    echo "No user found with the username: " . htmlspecialchars($username);
    exit();
}

$_SESSION['email'] = $result['email'];
?>

<!DOCTYPE html>
<html>
<link
      rel="icon"
      href="aquarefill.png"
      type="image/x-icon"
        />
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $_SESSION['username']; ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body {
      font-family: "Calibri";
      background-color: #DEF4FC;
      margin: 0;
      padding: 0;
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
      border-radius: 0;
    }
    section {
      margin: 0;
      padding: 15px;
      color: white;
      overflow: hidden;
      background-color: #454545;
    }
    h1 {
      font-size: 25px;
    }
    footer {
      font-size: 13px;
      margin: 0px;
      padding: 15px;
      color: white;
      overflow: hidden;
      background-color: #454545;
    }
    .active {
      background-color: #DEF4FC;
    }
    .container {
      border: black;
      width: 97%;
      height: 100%;
      background-color: #DEF4FC;
      padding: 20px;
      display: block;
    }
    p {
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
<body>
  <header>
    <ul>
	<li><img src="aquarefill.png" alt="Logo" style="padding:10px;" width="73" height="25"> </li>
      <li><a href="home.php"><i class="fa fa-fw fa-home"></i>Home</a></li>
      <li><a href="orderform.php"><i class="fa fa-fw fa-buysellads"></i>Order Now</a></li>
      <li><a href="transactions.php"><i class="fa fa-fw fa-history"></i>Transactions</a></li>
      <li><a href="analytics.php"><i class="fa fa-fw fa-bar-chart"></i>Analytics</a></li>
      <li><a href="contact.php"><i class="fa fa-fw fa-envelope"></i>Contact Us</a></li>
      <li><a href="about.php"><i class="fa fa-fw fa-info"></i>About Us</a></li>
      <li style="float:right"><a href="logout.php"><i class="fa fa-fw fa-close"></i>Logout</a></li>
      <li style="float:right"><a class="active" href="profile.php"><i class="fa fa-fw fa-user"></i>Profile</a></li>
    </ul>
  </header>

  <div class="container">
    <h1>User details</h1>
    <div class="container1">
      <p>
        <strong>Username</strong> <br> <?php echo $_SESSION['username']; ?> <br><br>
        <strong>Email address</strong> <br> <?php echo $_SESSION['email']; ?> <br><br>
        <strong>Organization</strong> <br> Water For Less Water Refilling Station<br><br>
        <strong>Address</strong> <br> Tacloban City, Leyte<br><br>
        <strong>Country</strong> <br> Philippines <br><br>
        <strong>Position</strong> <br> <i>Not applicable</i><br><br>
      </p>
    </div>
  </div>
</body>
<footer>
  <section>
    <div class="footertext">
      <i>©2024 UVW3.</i> <strong>All rights reserved.</strong> <br>
      <strong>Aqua Flush Refill System</strong> is the educational project of Group 3 section UVW. <br>
      All other trademarks and media used on this site are the property of their respective owners. <br>
      <div id="phTime"></div> <br>
    </div>
  </section>
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
