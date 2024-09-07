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

$query = "
    SELECT 
        DATE(orderDate) as orderDay,
        COUNT(*) as customers,
        SUM(totalCost) as dailySales
    FROM orders
    GROUP BY DATE(orderDate)
    ORDER BY DATE(orderDate)
";
$stmt = $pdo->query($query);
$dailyData = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalSalesQuery = "
    SELECT SUM(totalCost) as totalSales
    FROM orders
";
$totalSalesStmt = $pdo->query($totalSalesQuery);
$totalSales = $totalSalesStmt->fetch(PDO::FETCH_ASSOC)['totalSales'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics</title>
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
            height: 100%;
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
        <ul>
		<li><img src="aquarefill.png" alt="Logo" style="padding:10px;" width="73" height="25"> </li>
            <li><a href="home.php"><i class="fa fa-fw fa-home"></i>Home</a></li>
            <li><a href="orderform.php"><i class="fa fa-fw fa-buysellads"></i>Order Now</a></li>
            <li><a href="transactions.php"><i class="fa fa-fw fa-history"></i>Transactions</a></li>
            <li><a class="active" href="analytics.php"><i class="fa fa-fw fa-bar-chart"></i>Analytics</a></li>
            <li><a href="contact.php"><i class="fa fa-fw fa-envelope"></i>Contact Us</a></li>
            <li><a href="about.php"><i class="fa fa-fw fa-info"></i>About Us</a></li>
            <li style="float:right"><a href="logout.php"><i class="fa fa-fw fa-close"></i>Logout</a></li>
            <li style="float:right"><a href="profile.php"><i class="fa fa-fw fa-user"></i>Profile</a></li>
        </ul>
    </header>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div class="container">
        <h1>Analytics</h1>

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Number of Customers</th>
                    <th>Daily Sales (₱)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dailyData as $data): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($data['orderDay']); ?></td>
                        <td><?php echo htmlspecialchars($data['customers']); ?></td>
                        <td><?php echo htmlspecialchars($data['dailySales']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Total Sales: ₱<?php echo number_format($totalSales, 2); ?></h2>

        <canvas id="customerChart"></canvas>
        <canvas id="salesChart"></canvas>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctxCustomers = document.getElementById('customerChart').getContext('2d');
            var ctxSales = document.getElementById('salesChart').getContext('2d');
            var dailyData = <?php echo json_encode($dailyData); ?>;
            var labels = dailyData.map(function(data) { return data.orderDay; });
            var customerData = dailyData.map(function(data) { return data.customers; });
            var salesData = dailyData.map(function(data) { return data.dailySales; });

            var customerChart = new Chart(ctxCustomers, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Number of Customers',
                        data: customerData,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var salesChart = new Chart(ctxSales, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Daily Sales (₱)',
                        data: salesData,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
