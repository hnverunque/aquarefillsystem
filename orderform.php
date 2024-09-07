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


if (!isset($_SESSION["orders"])) {
    $_SESSION["orders"] = [];
}


function generateOrderId($pdo) {
    do {
        $orderId = 'AR-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE orderId = :orderId");
        $stmt->execute(['orderId' => $orderId]);
        $count = $stmt->fetchColumn();
    } while ($count > 0);
    return $orderId;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerName = $_POST["customerName"];
    $bottles = (int)$_POST["bottles"];
    $contactNumber = $_POST["contactNumber"];
    $deliveryPreference = $_POST["deliveryPreference"];
    $customerAddress = isset($_POST["customerAddress"]) ? $_POST["customerAddress"] : '';

    $bottleCost = $deliveryPreference === "Pickup" ? 25 : 30;
    $totalCost = $bottles * $bottleCost;
    $loyaltyPoints = floor($totalCost / 50);

    $orderId = generateOrderId($pdo);
    $orderDate = date("Y-m-d H:i:s");

    $order = [
        "orderId" => $orderId,
        "customerName" => $customerName,
        "bottles" => $bottles,
        "totalCost" => $totalCost,
        "contactNumber" => $contactNumber,
        "deliveryPreference" => $deliveryPreference,
        "customerAddress" => $customerAddress,
        "loyaltyPoints" => $loyaltyPoints,
        "status" => "Processing",
        "orderDate" => $orderDate
    ];

    $_SESSION["orders"][] = $order;
    $_SESSION["latestOrder"] = $order;

    $stmt = $pdo->prepare("
        INSERT INTO orders (orderId, customerName, bottles, totalCost, contactNumber, deliveryPreference, customerAddress, loyaltyPoints, status, orderDate)
        VALUES (:orderId, :customerName, :bottles, :totalCost, :contactNumber, :deliveryPreference, :customerAddress, :loyaltyPoints, :status, :orderDate)
    ");

    $stmt->execute($order);

    // Redirect to avoid form resubmission
    header("Location: orderform.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
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
        h2 {
            color: #333;
            text-align: center;
            padding: 1px;
            background-color: #fff;
            border-bottom: 2px solid #ddd;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        select {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
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
        footer {
            font-size: 13px;
            margin: 0px;
            padding: 25px;
            color: white;
            overflow: hidden;
            background-color: #454545;
        }section {
	   margin: 0px;
	   padding: 20;
       	   color: white;
     	   overflow: hidden;
     	   background-color: #454545;
	}

        .active {
            background-color: #DEF4FC;
        }
        #receiptSection {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #74ccf4;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: none;
        }
        #deliveryAddress {
            display: none;
        }
    </style>
    <script>
        function toggleAddressField() {
            var deliveryPreference = document.getElementById("deliveryPreference").value;
            var addressField = document.getElementById("deliveryAddress");
            if (deliveryPreference === "Standard Delivery") {
                addressField.style.display = "block";
            } else {
                addressField.style.display = "none";
            }
        }
    </script>
</head>
<body>
    <header>
        <ul>
	<li><img src="aquarefill.png" alt="Logo" style="padding:10px;" width="73" height="25"> </li>
            <li><a href="home.php"><i class="fa fa-fw fa-home"></i>Home</a></li>
            <li><a class="active" href="orderform.php"><i class="fa fa-fw fa-buysellads"></i>Order Now</a></li>
            <li><a href="transactions.php"><i class="fa fa-fw fa-history"></i>Transactions</a></li>
            <li><a href="analytics.php"><i class="fa fa-fw fa-bar-chart"></i>Analytics</a></li>
            <li><a href="contact.php"><i class="fa fa-fw fa-envelope"></i>Contact Us</a></li>
            <li><a href="about.php"><i class="fa fa-fw fa-info"></i>About Us</a></li>
            <li style="float:right"><a href="logout.php"><i class="fa fa-fw fa-close"></i>Logout</a></li>
            <li style="float:right"><a href="profile.php"><i class="fa fa-fw fa-user"></i>Profile</a></li>
        </ul>
    </header>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <form id="orderForm" method="post" action="orderform.php">
        <h2>Water Order Form</h2>
        <label for="customerName">Customer Name</label>
        <input type="text" id="customerName" name="customerName" required>

        <label for="bottles">Number of Bottles</label>
        <input type="number" id="bottles" name="bottles" required>

        <label for="contactNumber">Contact Number</label>
        <input type="text" id="contactNumber" name="contactNumber" required>

        <label for="deliveryPreference">Delivery Preference</label>
        <select id="deliveryPreference" name="deliveryPreference" onchange="toggleAddressField()">
            <option value="Pickup">Self-Pickup</option>
            <option value="Standard Delivery">Standard Delivery</option>
        </select>

        <div id="deliveryAddress">
            <label for="customerAddress">Delivery Address</label>
            <input type="text" id="customerAddress" name="customerAddress">
        </div>

        <button type="submit">Submit Order</button>
    </form>

    <div id="receiptSection">
        <h2>Receipt</h2>
        <p><strong>Order ID:</strong> <?php echo $_SESSION["latestOrder"]["orderId"]; ?></p>
        <p><strong>Date and Time:</strong> <?php echo date("Y-m-d H:i:s"); ?></p>
        <p><strong>Name:</strong> <?php echo $_SESSION["latestOrder"]["customerName"]; ?></p>
        <p><strong>Delivery Preference:</strong> <?php echo $_SESSION["latestOrder"]["deliveryPreference"]; ?></p>
        <p><strong>Address:</strong> <?php echo $_SESSION["latestOrder"]["customerAddress"]; ?></p>
        <p><strong>Amount Due:</strong> ₱<?php echo $_SESSION["latestOrder"]["totalCost"]; ?></p>
        <p><strong>Loyalty Points:</strong> <?php echo $_SESSION["latestOrder"]["loyaltyPoints"]; ?></p>
    </div>

    <?php
   
    if (isset($_SESSION["latestOrder"])) {
        echo '<script>document.getElementById("receiptSection").style.display = "block";</script>';
        unset($_SESSION["latestOrder"]); 
    }
    ?>

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
