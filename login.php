<?php
include("connection.php"); 

// Check if the user is already logged in (via cookie)
if (isset($_COOKIE['user_email'])) 
{
    $email = $_COOKIE['user_email'];
    header("Location: customer_dashboard.php");
    exit();
}

if (isset($_POST['submit'])) 
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) 
    {
        setcookie("user_email", $email, time() + (86400), "/"); 
        setcookie("visited", "true", time() + (86400), "/"); 
        
        header("Location: customer_dashboard.php");
        exit();
    } 
    else 
    {
        echo "<script>alert('Wrong email or password!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
<link rel="stylesheet" type="text/css" href="log_and_signup.css">
<title>Login</title>
</head>
<body>
<section id="header">
    <a href="#"><img src="img/logo.png" id="logo" class="logo" alt=""></a>
    <div>
        <ul id="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="track_order.php">Track Order</a></li>
            <li><a href="signup.php">Sign up</a></li>
            <li><a href="cart.php"><i class="far fa-shopping-bag"></i></a></li>
        </ul>
    </div>
</section>

<div class="container">
    <div class="box form-box">
        <header>Login</header>
        <form action="" method="post">
            <div class="field input">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="field">
                <input type="submit" class="btn" name="submit" value="Login">
            </div>

            <div class="links">
                Don't have an account? <a href="signup.php">Sign up now</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>