<?php
$value = isset($_GET['value']) ? htmlspecialchars($_GET['value']) : 'default';
?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatibal" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale= 1.0">
	<title>Service Plan</title>
    <link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" type="text/css" href="payment_1.css" />	
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
            <li><a href="merchent-login.php">Login</a></li>
        </ul>
    </div>
    </section>

    <section id="plan1" class="section-p1">
        <h2>Service Plan</h2>
        <p>Our service plan is designed to ensure a seamless and satisfying experience for every customer. We offer the following key elements:</p>
        <div class="pro-container">
                    <div class="pro">
                        <img src="img/plan/plan1.png" width="300px" height="350px" alt="">
                        <div class="des">
                            <span>Ideal for short-term</span>
                            <h5>Get premium services at an affordable monthly rate</h5>
                            <div class="star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <a class="btn" name="submit" href="payment.php?value1=300&value2=<?php echo $value; ?>">Buy now</a>
                    </div>

                    <div class="pro">
                        <img src="img/plan/plan2.png" width="300px" height="350px" alt="">
                        <div class="des">
                            <span>Ideal for medium-term</span>
                            <h5>Get premium services at an affordable four monthly rate</h5>
                            <div class="star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <a class="btn" name="submit" value="1000" href="payment.php?value1=1000&value2=<?php echo $value; ?>">Buy now</a>
                    </div>

                    <div class="pro">
                        <img src="img/plan/plan3.png" width="300px" height="350px" alt="">
                        <div class="des">
                            <span>Ideal for medium-term</span>
                            <h5>Get premium services at an affordable eight monthly rate</h5>
                            <div class="star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <a class="btn" name="submit" value="1800" href="payment.php?value1=1800&value2=<?php echo $value; ?>">Buy now</a>
                    </div>

                    <div class="pro">
                        <img src="img/plan/plan4.png" width="300px" height="350px" alt="">
                        <div class="des">
                            <span>Ideal for long-term</span>
                            <h5>Get premium services at an affordable yearly rate</h5>
                            <div class="star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <a class="btn" name="submit" value="3500" href="payment.php?value1=3500&value2=<?php echo $value; ?>">Buy now</a>
                    </div>
        </div>
    </section>
    </body>
    </html>