<?php
require 'connection.php';

$emailToSearch = $_GET['value']; 
$emailPrefix = explode('@', $emailToSearch)[0]; 

$checkTableQuery = "SHOW TABLES LIKE '$emailPrefix'";
$tableResult = $conn->query($checkTableQuery);

if ($tableResult && $tableResult->num_rows > 0) 
{
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatibal" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale= 1.0">
        <link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
        <link rel="stylesheet" type="text/css" href="index.css">
        <title>Merchent Dashboard</title>
    </head>
    <body style="background-color:rgb(134, 134, 134)">
        <section id="header">
            <a href="#"><img src="img/logo.png" id="logo" class="logo" alt=""></a>
            <div>
                <ul id="navbar">
                    <li><a href="merchent.html">Home</a></li>
                    <li><a href="merchent-about.html">About</a></li>
                    <li><a href="merchent-contact.html">Contact</a></li>
                    <li><a href="merchent-help.html">Help</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </section>

        <section id="buttons">
            <br><br><a href="merchent_product.php?value=<?php echo $emailPrefix; ?>" class="btn">Add New Fabric</a>
            <a href="ready_made.php?value=<?php echo $emailPrefix; ?>" class="btn">Add To Ready Made</a>
            <a href="received_orders.php?value=<?php echo $emailToSearch; ?>" class="btn">Received Orders</a>
         </section>

        <section id="product1" class="section-p1">
            <div class="pro-container">
                <?php
                
                $query = "SELECT * FROM `$emailPrefix` ORDER BY id DESC";  
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
                        </div>
                <?php
                    endforeach;
                else :
                ?>
                    <p>No products found.</p>
                <?php endif; ?>
            </div>
        </section>

    <style>
        #buttons {
            text-align: center;
        }
        .btn {
        margin-left: 10px;
        text-decoration: none;
        margin-top: 3%;
        background: #1769a0;
        border: 1px solid #ffffff;
        border-radius: 15px;
        color: #fff;
        transition: all .3s;
        padding: 15px 30px;
        }

        .btn:hover {
            background-color: #6ba2c7;
        }
    </style>

    </body>
    </html>

<?php
} 
else 
{
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatibal" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale= 1.0">
        <link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
        <link rel="stylesheet" type="text/css" href="log_and_signup.css">
        <title>Dashboard Requested</title>
    </head>
    <body>
        <section id="header">
            <a href="#"><img src="img/logo.png" id="logo" class="logo" alt=""></a>
            <div>
                <ul id="navbar">
                    <li><a href="merchent.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="track.html">Help</a></li>
                    <li><a href="merchent-signup.php">Sign up</a></li>
                    <li><a href="merchent-login.php">Login</a></li>
                </ul>
            </div>
        </section>

        <div class="container">
            <br><p style="text-align: center">You will get access to Merchent dashboard after your transaction id and details are verified <br> (it will take approximately 24 hours)</p>
        </div>
    </body>
    </html>

<?php
}
// Close the connection
$conn->close();
?>