<?php
include("connection.php"); 

// Check if the user is already logged in (via cookie)
if (isset($_COOKIE['shop_email'])) 
{
    $email = $_COOKIE['shop_email'];
    header("Location: merchent_dashboard.php?value=" . $email);
    exit();
}

if (isset($_POST['submit'])) 
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM shops WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) 
    {
        setcookie("shop_email", $email, time() + (86400), "/"); 
        setcookie("visited_shop", "true", time() + (86400), "/"); 
        
        header("Location: merchent_dashboard.php?value=" . $email);
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
            <li><a href="merchent.html">Home</a></li>
            <li><a href="merchent-about.html">About</a></li>
            <li><a href="merchent-contact.html">Contact</a></li>
            <li><a href="merchent-help.html">Help</a></li>
            <li><a href="merchent-signup.php">Sign up</a></li>
            <li><a class="active" href="merchent-login.php">Login</a></li>
        </ul>
    </div>
</section>

<div class="container">
    <div class="box form-box">
        <header>Login</header>
        <form action="" method="post">
            <div class="field input">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" required>
            </div>

            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="field">
                <input type="submit" class="btn" name="submit" value="Login">
            </div>

            <div class="links">
                Don't have an account? <a href="merchent-signup.php">Sign up now</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>