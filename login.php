<?php
$success = 0;
$user = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dsn = 'mysql:host=127.0.0.1;dbname=uvw3';
    $username_db = 'root';
    $password_db = '';

    try {
        $pdo = new PDO($dsn, $username_db, $password_db);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Database connection failed: ' . $e->getMessage());
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM credentials WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username, 'password' => $password]);
    $num = $stmt->rowCount();

    if ($num > 0) {
        $success = 1;
        session_start();
        $_SESSION['username'] = $username;
        header('location: home.php');
    } else {
        $user = 1;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
	<link
      rel="icon"
      href="aquarefill.png"
      type="image/x-icon"
        />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #DEF4FC;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
            text-align: center;
            font-family: "Calibri";
            background-color: #74ccf4;
            border-bottom: 2px solid #ddd;
            margin: 0px;
            padding: 15px;
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
        input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .error-message {
            color: red;
            margin-top: 5px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            display: block;
            margin: 10px auto;
            max-width: 200px;
            text-align: center;
        }

        .alert {
            position: relative;
            background-color: #f8d7da;
            color: #721c24;
            padding: 16px;
            margin-bottom: 0px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .btn-close {
            position: absolute;
            top: 0;
            right: 15px;
            padding: 12px 20px;
            color: inherit;
        }

        p {
            font-size: 13px;
            text-align: center;
        }.center {
	display: block;
	margin-left: auto;
	margin-right: auto;
	width: 35%;
	}
    </style>
</head>
<body>

<?php
    if ($user) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Invalid credentials. Please try again later.
            <span class="btn-close" aria-label="Close"><i class="fas fa-times"> X </i></span>
          </div>';
    }
    ?>
    
    <h2>Aqua Flush Refill Login</h2>
	<img src="aquarefill.png" alt="Logo" style="padding:10px;" width="120" height="150" class="center">

    <form action="login.php" method="post">
        <label for="userName">Username</label>
        <input type="text" placeholder="Enter your username"  name="username" required>

        <div class="password-container">
            <label for="password">Password</label>
            <input type="password" placeholder="Enter your password" name="password" required>
            <span class="toggle-password" onclick="togglePasswordVisibility(this)">
                <i class="far fa-eye"></i>
            </span>
        </div>

        <button type="submit">Login</button>
        <a href="signup.php"> <p>Don't have an account yet?</p></a>
    </form>

    <script>
        function togglePasswordVisibility(toggle) {
            const inputField = toggle.previousElementSibling;
            if (inputField.type === "password") {
                inputField.type = "text";
                toggle.querySelector("i").classList.remove("far", "fa-eye");
                toggle.querySelector("i").classList.add("fas", "fa-eye-slash");
            } else {
                inputField.type = "password";
                toggle.querySelector("i").classList.remove("fas", "fa-eye-slash");
                toggle.querySelector("i").classList.add("far", "fa-eye");
            }
        }
    </script>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var closeButtons = document.querySelectorAll(".btn-close");

        closeButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                var alert = this.parentElement;
                alert.style.display = "none";
            });
        });
    });
</script>
</html>
