<?php
require 'connection.php';

$email_1 = $_GET['value1'];
$email = explode('@', $_GET['value1'])[0];
$shopName = $_GET['value2'];

?>

<!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatibal" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale= 1.0">
        <link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
        <link rel="stylesheet" type="text/css" href="index.css">
        <title>Garment Collection</title>
    </head>
    <body style="background-color:rgb(134, 134, 134)">
        <section id="header">
            <a href="#"><img src="img/logo.png" id="logo" class="logo" alt=""></a>
            <div>
                <ul id="navbar">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="track_order.php">Tract Order</a></li>
                    <li><a href="customer_logout.php">Logout</a></li>
                    <li><a href="cart.php"><i class="far fa-shopping-bag"></i></a></li>
                </ul>
            </div>
        </section>

        <section id="product1" class="section-p1">
            <div class="pro-container">
                <?php
                
                $query = "SELECT * FROM `$email` ORDER BY id DESC";  
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
                                <h4>&#8377; <?php echo htmlspecialchars($row['price'])."/Meter"; ?></h4>
                            </div>
                            <a href="spage.php?value1=<?php echo $email; ?>&value2=<?php echo $row['id']; ?>&value3=<?php echo $email_1; ?>&value4=<?php echo $shopName; ?>"><i class="fal fa-shopping-cart cart"></i></a>
                        </div>
                <?php
                    endforeach;
                else :
                ?>
                    <p>No products found.</p>
                <?php endif; ?>
            </div>
    </section>

</body>
</html>