<?php
session_start();

// Database credentials


$servername = "localhost"; // Change this to your MySQL server name
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "krishi_db"; // Change this to your MySQL database name
// Establish database connection
$conn = mysqli_connect($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Login Form Handling
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $name = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM signup_tb WHERE name='$name' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User authenticated
        $_SESSION['name'] = $name;
        header("Location: adds.php");
        exit();
    } else {
        // Invalid credentials
        $login_error = "Invalid username or password";
    }
}

// Signup Form Handling
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $name = $_POST['name'];
    $farming_location = $_POST['farming_location'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "INSERT INTO signup_tb (name, farming_location, phone, email, password) VALUES ('$name', '$farming_location', '$phone', '$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        // Signup successful
        $signup_success = "Sign up successful";
    } else {
        $signup_error = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Signup Page</title>
   
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            background-image: url('https://wallpaperaccess.com/full/4893732.jpg');
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f7f7f7;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
            position: relative;
            overflow: hidden;
            animation: slide-in 0.6s ease-out;
        }
        @keyframes slide-in {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 2;
            }
        }
        .container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 24px;
        }
        .input-group {
            margin-bottom: 20px;
        }
        .input-group input {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }
        .input-group input:focus {
            outline: none;
            border-color: #4CAF50;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            padding: 15px;
            border-radius: 8px;
            display: block;
            width: 100%;
            box-sizing: border-box;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .bottom-text {
            margin-top: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        . {
            margin-top: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        .bottom-text a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }
        .bottom-text a:hover {
            text-decoration: underline;
        }
        .switch-form {
            display: none;
        }
    </style>
</head>
<body>

<div class="container" id="login-form">
    <h2>Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="input-group">
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" name="login" class="btn">Login</button>
        <div class="bottom-text">
            Don't have an account? <a onclick="switchForm()">Sign up</a>
        </div>
        <?php if (isset($login_error)) { echo "<div class='error'>$login_error</div>"; } ?>
    </form>
</div>

<div class="container switch-form" id="signup-form">
    <h2>Sign Up</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="input-group">
            <input type="text" name="name" placeholder="Username" required>
        </div>
        <div class="input-group">
            <input type="text" name="farming_location" placeholder="Farming Location" required>
        </div>
        <div class="input-group">
            <input type="tel" name="phone" placeholder="Phone Number" required>
        </div>
        <div class="input-group">
            <input type="email" name="email" placeholder="Email" required>
        </div>
        
        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" name="signup" class="btn">Sign Up</button>
        <div class="bottom-text">
            Already have an account? <a onclick="switchForm()">Login</a>
        </div>
        <?php if (isset($signup_success)) { echo "<div class='success'>$signup_success</div>"; } ?>
        <?php if (isset($signup_error)) { echo "<div class='error'>$signup_error</div>"; } ?>
    </form>
</div>

<script>
    function switchForm() {
        var loginForm = document.getElementById("login-form");
        var signupForm = document.getElementById("signup-form");
        
        if (loginForm.style.display === "none") {
            loginForm.style.display = "block";
            signupForm.style.display = "none";
        } else {
            loginForm.style.display = "none";
            signupForm.style.display = "block";
        }
    }
</script>

</body>
</html>