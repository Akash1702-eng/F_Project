<?php require 'connection.php' ?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatibal" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale= 1.0">
	<title>Online Clothier</title>
    <link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" type="text/css" href="index.css" />	
</head>

<body>
    <section id="header">
        <a href="#"><img src="img/logo.png" id="logo" class="logo" alt=""></a>

        <div>
            <ul id="navbar">
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="track_order.php">Track Order</a></li>
                <li><a href="signup.php">Sign up</a></li>
                <li><a href="cart.php"><i class="far fa-shopping-bag"></i></a></li>
            </ul>
        </div>
    </section>

    <section id="hero">
        <h4>Customize-your-garments</h4>
        <h2>Super value deals on all products</h2>
        <h1>Choose shop according to you</h1>
        <p>Shop smart enjoy more</p>
        <a href="login.php"><button>Explore now</button></a>
    </section>

    <section id="feature" class="section-p1">
        <a href="custom_garments.html"<div class="fe-box">
            <img src="img/features/feature1.png" width="150px" alt="">
            <h6>Custom Garments</h6>
        </div>
        <a href="track_order.php"<div class="fe-box">
            <img src="img/features/feature2.png" width="150px" alt="">
            <h6>Order Tracking</h6>
        </div></a>
        <a href="shell.html"<div class="fe-box">
            <img src="img/features/feature3.png" width="150px" alt="">
            <h6>Happy Shell</h6>
        </div></a>
        <a href="_24.html"<div class="fe-box">
            <img src="img/features/feature4.png" width="150px" alt="">
            <h6>24/7 Support</h6>
        </div></a>
        <a href="login.php"<div class="fe-box">
            <img src="img/features/feature5.png" width="150px" alt="">
            <h6>Select Shop</h6>
        </div></a>
        <a href="cart.php"<div class="fe-box">
            <img src="img/features/feature6.png" width="150px" alt="">
            <h6>Cart Facility</h6>
        </div></a>
    </section>

    <section id="product1" class="section-p1">
        <h2>Ready Made Products</h2>
        <p>Garment Collection New Modern Design</p>
        <div class="pro-container">
            <?php 
            $query = "SELECT * FROM ready_made_product ORDER BY id DESC";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }

            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

            if (!empty($rows)) :
                foreach ($rows as $row) : 
            ?>
                    <div class="pro">
                        <img src="img/merchent_product/<?php echo htmlspecialchars($row['image']); ?>" width="300px" height="350px" alt="">
                        <div class="des">
                            <span><?php echo htmlspecialchars($row['brand']); ?></span>
                            <h5><?php echo htmlspecialchars($row['description']); ?></h5>
                            <div class="star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4>&#8377; <?php echo htmlspecialchars($row['price']); ?></h4>
                        </div>
                        <a href="spage_login.php?value1=<?php echo explode('@', $row['email'])[0]; ?>&value2=<?php echo $row['id']; ?>&value3=<?php echo $row['email']; ?>&value4=<?php echo $row['sname']; ?>"><i class="fal fa-shopping-cart cart"></i></a>
                    </div>
            <?php 
                endforeach; 
            else : 
            ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div>
    </section>

    <section id="banner" class="section-m1">
        <h4>Repair Services</h4>
        <h2>Up to <span>30% Off</span> - On all Products</span></h2>
        <a href="login.php"><button class="normal">Explore More</button></a>
    </section>

    <section id="banner3">
        <div class ="banner-box">
            <h2>Tailored to Perfection</h2>
            <h3>Custom fits that showcase your style</h3>
        </div>
         <div class ="banner-box banner-box2">
            <h2>Confidence in Every Stitch</h2>
            <h3>Experience power of perfect tailoring</h3>
        </div>
         <div class ="banner-box banner-box3">
            <h2>Luxury Tailoring</h2>
            <h3>From design to delivery, all made easy</h3>
        </div>
    </section>

    <footer class="section-p1">
        <div class="col">
            <img class="logo2" src="img/logo.png" width="220px" alt="">
            <h4>Contact</h4>
            <p><strong>Address: </strong> Namdeo Chowk, Pipeline Road, Savedi, Ahmednagar, 414003</p>
            <p><strong>Phone: </strong> (+91) 7020214496 / (+91) 8010480463 / (+91) 8459563003</p>
            <div class="follow">
                <br><h4>Follow us</h4>
                <div class="icon">
                    <a href="https://www.instagram.com/akash.khurd/"><i class="fab fa-instagram"></i></a>
                    <a href="https://youtube.com/@Akash..Khurd..Creation/"><i class="fab fa-youtube"></i></a>
                    <a href="https://in.pinterest.com/akashkhurd1702/"><i class="fab fa-pinterest-p"></i></a>
                    <a href="https://www.linkedin.com/in/akash-khurd-040b87314/"><i class="fab fa-linkedin"></i></a>
                    <a href="https://github.com/Akash1702-eng/"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </div>

        <div class="col">
            <h4>About</h4>
            <a href="about.html">About Us</a>
            <a href="delivery_info.html">Delivery Information</a>
            <a href="pri_poly.html">Privacy Policy</a>
            <a href="term_cond.html">Terms & Conditions</a>
            <a href="contact.html">Contact Us</a>
        </div>

        <div class="col">
            <h4>My Account</h4>
            <a href="signup.php">Sign In</a>
            <a href="cart.php">View Cart</a>
            <a href="wishlist.html">My Wishlist</a>
            <a href="track_order.php">Track My Order</a>
            <a href="help.html">Help</a>
        </div>

        <div class="col">
            <h4>Order By</h4>
            <p>All</p>
            <p>Men</p>
            <p>Women</p>
            <p>Kids</p>
            <p>Stores</p><br>
            <h4>Secure Payment Options</h4>
            <img src="img/pay/pay.jpg" width="220px" alt="">
        </div>

        <div class="copyright">
            <p></p>
        </div>

    </footer>

<script>
function isMobileDevice() 
{
    return /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}
if (isMobileDevice()) 
{
    document.body.innerHTML = "";
    document.body.style.backgroundColor = "white";
    alert("OnlineClothier does not support mobile please open website only on desktop or laptop");
}
</script>
</body>
</html>