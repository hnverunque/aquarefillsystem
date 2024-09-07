<?php
$dsn = 'mysql:host=127.0.0.1;dbname=uvw3';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

session_start();

if(isset($_GET['search']) && !empty($_GET['search'])){
    $search = $_GET['search'];
 
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE customerName LIKE ?");
    $stmt->execute(["%$search%"]);
} else {

    $stmt = $pdo->query("SELECT * FROM orders");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
	<link
      rel="icon"
      href="aquarefill.png"
      type="image/x-icon"
        />
    <style>
        body {
            font-family: "Calibri";
            background-color: #DEF4FC;
            margin: 0;
            padding: 0;
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
        }
        header, footer {
            background-color: #454545;
            color: white;
            overflow: hidden;
        }
        header ul {
            padding: 0;
        }
        header li {
            display: inline;
        }
        .container {
            width: 97%;
            background-color: #DEF4FC;
            padding: 20px;
            margin: auto;
        }
        h1 {
            font-size: 25px;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        footer {
            font-size: 13px;
            margin: 0;
            padding: 25px;
        }
        .footertext {
            text-align: left;
        }
        .active {
            background-color: #DEF4FC;
        }
    </style>
</head>
<body>
    <header>
        <ul>
		<li><img src="aquarefill.png" alt="Logo" style="padding:10px;" width="73" height="25"> </li>
            <li><a href="home.php"><i class="fa fa-fw fa-home"></i>Home</a></li>
            <li><a href="orderform.php"><i class="fa fa-fw fa-buysellads"></i>Order Now</a></li>
            <li><a class="active" href="transactions.php"><i class="fa fa-fw fa-history"></i>Transactions</a></li>
            <li><a href="analytics.php"><i class="fa fa-fw fa-bar-chart"></i>Analytics</a></li>
            <li><a href="contact.php"><i class="fa fa-fw fa-envelope"></i>Contact Us</a></li>
            <li><a href="about.php"><i class="fa fa-fw fa-info"></i>About Us</a></li>
            <li style="float:right"><a href="logout.php"><i class="fa fa-fw fa-close"></i>Logout</a></li>
            <li style="float:right"><a href="profile.php"><i class="fa fa-fw fa-user"></i>Profile</a></li>
        </ul>
    </header>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div class="container">
        <h1>Transactions</h1>
        
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search by Customer Name">
            <button type="submit">Search</button>
        </form>
        
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Bottles</th>
                    <th>Total Cost</th>
                    <th>Contact Number</th>
                    <th>Delivery Preference</th>
                    <th>Customer Address</th>
                    <th>Loyalty Points</th>
                    <th>Status</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['orderId']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['customerName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['bottles']) . "</td>";
                    echo "<td>₱" . htmlspecialchars($row['totalCost']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['contactNumber']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['deliveryPreference']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['customerAddress']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['loyaltyPoints']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['orderDate']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

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
</body>
</html>
