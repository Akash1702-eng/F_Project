<?php
include("connection.php"); 

// Check if the page was visited
if (isset($_COOKIE['visited_shop']) && isset($_COOKIE['shop_email'])) 
{
    $email = htmlspecialchars($_COOKIE['shop_email']);
    header("Location: merchent_dashboard.php?value=" . $email);
    exit();
}

if (isset($_POST['submit'])) 
{
    $sname = $_POST['sname'];
    $country = $_POST['country'];
    $addresss = $_POST['addresss'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $transaction = "";
    $amount = "";

    $verify_query = $conn->prepare("SELECT email FROM shops WHERE email = ?");
    $verify_query->bind_param("s", $email);
    $verify_query->execute();
    $verify_query->store_result();

    if ($verify_query->num_rows > 0) 
    {
        echo "<script>alert('This email is already used. Try another one, please!')</script>";
    } 
    else 
    {
        $stmt = $conn->prepare("INSERT INTO shops (sname, country, addresss, phone, email, password, amount, transaction) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $sname, $country, $addresss, $phone, $email, $password, $amount, $transaction);

        if ($stmt->execute()) 
        {
            setcookie("visited", "true", time() + (86400), "/"); 
            setcookie("user_email", $email, time() + (86400), "/"); 

            header("Location: payment_1.php?value=" . $email);
            exit();
        } 
        $stmt->close();
    }
    $verify_query->close();
    $conn->close();
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
	<title>Sign Up</title>
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
            <li><a class="active" href="merchent-signup.php">Sign up</a></li>
            <li><a href="merchent-login.php">Login</a></li>
        </ul>
    </div>
</section>

<div class="container">
		<div class="box form-box">
			<header>Sign up</header>
			<form onsubmit="return myfun()" action="" method="post">

				<div class="field input">
					<label for="fname">Shop Name</label>
					<input type="text" name="sname" id="sname" required>
				</div>

                <div class="field input">
					<label for="country">Select Country</label>
					<select name="country" id="country">
                        <option value=""> </option>
                        <option value="india">India</option>
                        <option value="china">China</option>
                        <option value="us">US</option>
                        <option value="indonesia">Indonesia</option>
                        <option value="pakistan">Pakistan</option>
                        <option value="nigeria">Nigeria</option>
                        <option value="brazil">Brazil</option>
                        <option value="bangladesh">Bangladesh</option>
                        <option value="russia">Russia</option>
                        <option value="mexico">Mexico</option>
                        <option value="japan">Japan</option>
                        <option value="egypt">Egypt</option>
                        <option value="iran">Iran</option>
                        <option value="turkey">Turkey</option>
                        <option value="germany">Germany</option>
                        <option value="uk">Afghanistan</option>
                        <option value="spain">Spain</option>
                        <option value="canada">Canada</option>
                        <option value="australia">Australia</option>
                    </select>
				</div>

               <div class="field input">
					<label for="addresss">Address</label>
					<input type="text" name="addresss" id="addresss" required>
				</div>

				<div class="field input">
					<label for="phone">Phone number</label>
					<input type="text" name="phone" id="phone" required>
				</div>

                <div class="field input">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" required>
				</div>

                <div class="field input">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" required>
				</div>

				<div class="field">
					<input type="submit" class="btn" name="submit" value="Sign up">
				</div>

				<div class="links">
					Already have an account? <a href="merchent-login.php"> Login now</a>
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
            var country = document.getElementById("country").value;

            if (country == "") 
            {
                alert("Please select a country.");
                return false;
            }

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