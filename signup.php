<?php
include("connection.php"); 

// Check if the page was visited
if (isset($_COOKIE['visited']) && isset($_COOKIE['user_email'])) 
{
    $email = htmlspecialchars($_COOKIE['user_email']);
    header("Location: customer_dashboard.php");
    exit();
}

if (isset($_POST['submit'])) 
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password']; 

    $verify_query = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $verify_query->bind_param("s", $email);
    $verify_query->execute();
    $verify_query->store_result();

    if ($verify_query->num_rows > 0) 
    {
        echo "<script>alert('This email is already used. Try another one, please!')</script>";
    } 
    else 
    {
        $stmt = $conn->prepare("INSERT INTO users (fname, lname, phone, email, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $fname, $lname, $phone, $email, $password);

        if ($stmt->execute()) 
        {
            setcookie("visited", "true", time() + (86400), "/"); 
            setcookie("user_email", $email, time() + (86400), "/"); 

            header("Location: customer_dashboard.php");
            exit();
        } 
    }
}
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatibal" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale= 1.0">
	<link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
	<link rel="stylesheet" type="text/css" href="log_and_signup.css">
	<title>Sign up</title>
</head>

<body>
<section id="header">
    <a href="#"><img src="img/logo.png" id="logo" class="logo" alt=""></a>
    <div>
        <ul id="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="track_order.php">Tract Order</a></li>
            <li><a class="active" href="signup.php">Sign up</a></li>
            <li><a href="cart.php"><i class="far fa-shopping-bag"></i></a></li>
        </ul>
    </div>
</section>

<div class="container">
		<div class="box form-box">
			<header>Sign up</header>
			<form onsubmit="return myfun()" action="" method="post">

				<div class="field input">
					<label for="fname">First Name</label>
					<input type="text" name="fname" id="fname" required>
				</div>

                <div class="field input">
					<label for="lname">Last Name</label>
					<input type="text" name="lname" id="lname" required>
				</div>

				<div class="field input">
					<label for="phone">Phone number</label>
					<input type="text" name="phone" id="phone" required>
				</div>

                <div class="field input">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" placeholder="Enter valid email only" required>
				</div>

                <div class="field input">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" required>
				</div>

				<div class="field">
					<input type="submit" class="btn" name="submit" value="Sign up">
				</div>

				<div class="links">
					Already have an account? <a href="login.php"> Login now</a>
				</div>

		</div>
	</div>
    
<script>
function myfun() 
        {
            var res = "INVALID ";
            var phone = document.getElementById("phone").value;
            var pass = document.getElementById("password").value;
            var email = document.getElementById("email").value;

            var pat1 = /^[1-9]\d{9}$/;
            var pat2 = /^[a-zA-Z0-9!@#$%^&*]{8,}$/;
            var pat3 = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            var phoneval = pat1.test(phone);
            var passval = pat2.test(pass);
            var emailval = pat3.test(email);

            if (!phoneval) 
            {
                res += "CONTACT(must be 10 digit long) ";
            }

            if (!emailval) 
            {
                res += "EMAIL ";
            }

            if (!passval) 
            {
                res += "PASSWORD(at least 8 character long).";
            }

            if (res !== "INVALID ") 
            {
                alert(res); 
                return false;
            }
            return true;
        }
</script>
</body>
</html>