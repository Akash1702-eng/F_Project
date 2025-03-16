<?php
require 'connection.php';

if (!isset($_COOKIE['user_email'])) 
{
    header("Location: login.php"); 
    exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$customer_email = $_COOKIE['user_email'];
$params = [
    'value1' => $_GET['value1'],
    'value2' => $_GET['value2'],
    'value3' => $_GET['value3'],
    'value4' => $_GET['value4'],
];

// Fetch product details
$stmt = $conn->prepare("SELECT * FROM ready_made_product WHERE id = ?");
$stmt->bind_param("i", $_GET['value2']);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

// Fetch user details
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $customer_email);
$stmt->execute();
$rows = $stmt->get_result()->fetch_assoc();

function redirectWithMessage($params, $message) {
    header("Location: " . $_SERVER['PHP_SELF'] . "?" . http_build_query(array_merge($params, ['message' => $message])));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantity = $_POST['quantity'];

    if (isset($_POST['cart'])) {
    // Check if the product with the same customization exists in the cart
            $check_cart = "SELECT COUNT(*) AS count FROM cart WHERE customer_email = ? AND value2 = ? AND value3 = ?";
            $stmt = $conn->prepare($check_cart);
            $stmt->bind_param("sis", $customer_email, $params['value2'], $params['value3']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row_count = $result->fetch_assoc()['count'];

            if ($row_count > 0) {
                // Redirect if the same product (value2) with the same customization (value3) is already in the cart
                redirectWithMessage($params, 'already_in_cart');
            } else {
                // Insert into cart if not already present
                $insert = "INSERT INTO cart (customer_email, sname, image, description, price, product, value1, value2, value3) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($insert);
                $stmt->bind_param("sssssssss", $customer_email, $params['value4'], $row['image'], $row['description'], $row['price'], $row['brand'], $params['value1'], $params['value2'], $params['value3']);

                if (!$stmt->execute()) {
                    error_log("Cart insert error: " . $stmt->error);
                    redirectWithMessage($params, 'cart_fail');
                }

                redirectWithMessage($params, 'cart_success');
            }
        }

    if (isset($_POST['submit'])) {
        $address = trim($_POST['address']);
        $phone = $rows['phone'];
        $totalPrice = $quantity * $row['price'];

        if (empty($address)) redirectWithMessage($params, 'empty_address');

        // Check if already ordered
        $check_existing = "SELECT * FROM product_details WHERE brand = ? AND phone = ?";
        $stmt = $conn->prepare($check_existing);
        $stmt->bind_param("ss", $row['brand'], $phone);
        $stmt->execute();

        if ($stmt->get_result()->num_rows > 0) redirectWithMessage($params, 'already_ordered');

        // Ensure `value3` is correctly formatted
        $shop_email = strpos($params['value3'], '@') === false ? $params['value3'] . "@gmail.com" : $params['value3'];

        $insert = "INSERT INTO product_details (shop_email, brand, description, quantity, phone, addresss) 
                   VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert);
        $stmt->bind_param("ssssss", $shop_email, $row['brand'], $row['description'], $quantity, $phone, $address);

        if (!$stmt->execute()) {
            error_log("Order insert error: " . $stmt->error);
            redirectWithMessage($params, 'order_fail');
        }

        $cart_id = $conn->insert_id; 
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'innovativeclothier@gmail.com';
            $mail->Password = 'evxnbsxhekatolaa';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('innovativeclothier@gmail.com', 'OnlineClothier');
            $mail->addAddress($customer_email);

            $mail->isHTML(true);
            $mail->Subject = "Your Order Details";

            $mail->Body = "
    <div style='text-align: center;'>
        <img src='https://onlineclothier.infinityfreeapp.com/img/logo.png' 
            alt='OnlineClothier' 
            style='width: 100%; max-width: 250px; height: auto; display: block; margin: 0 auto;'>
    </div>
    <br>

    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background-color: #f9f9f9;'>
        <p style='text-align: center; font-size: 16px; color: #4CAF50;'>We have received your order! Here are the details:</p>

        <div style='text-align: center; margin-bottom: 15px;'>
            <img src='https://onlineclothier.infinityfreeapp.com/img/merchent_product/{$row['image']}' 
                alt='Product Image' 
                style='max-width: 80%; height: 300px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); display: block; margin: 0 auto;'>
        </div>

        <div style='background-color: #fff; padding: 15px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);'>
            <ul style='list-style-type: disc; padding-left: 20px; font-size: 14px; color: #333;'>
                <li><strong>Brand:</strong> {$row['brand']}</li>
                <li><strong>Description:</strong> {$row['description']}</li>
                <li><strong>Quantity:</strong> $quantity</li>
                <li><strong>Total Price:</strong> <span style='color: #4CAF50; font-weight: bold;'>₹$totalPrice</span></li>
                <li><strong>Delivery Address:</strong> $address</li>
                <li><strong>Order ID:</strong> <span style='color: #ff5722; font-weight: bold;'>$cart_id</span> (Use this to track your order)</li>
            </ul>
        </div>

        <div style='text-align: center; margin-top: 20px;'>
            <a href='https://onlineclothier.infinityfreeapp.com/track_order.php' 
                style='display: inline-block; padding: 12px 25px; font-size: 16px; color: #fff; background-color: #4CAF50; text-decoration: none; border-radius: 5px;'>
                Track Your Order
            </a>
        </div>

        <p style='text-align: center; font-size: 16px; margin-top: 20px;'>We are preparing your order and will notify you once it is ready for delivery.</p>

        <p style='text-align: center; font-size: 14px; color: #777;'>For any inquiries, contact us at <a href='mailto:innovativeclothier@gmail.com' style='color: #007BFF; text-decoration: none;'>innovativeclothier@gmail.com</a></p>
    </div>";

            $mail->AltBody = "Your order has been received. Order ID: $cart_id. For details, contact innovativeclothier@gmail.com.";

            $mail->send();

        } catch (Exception $e) {
            error_log("Email error: " . $mail->ErrorInfo);
        }

        redirectWithMessage($params, 'order_success');
    }
}

if (isset($_GET['message'])) {
    $messages = [
        'cart_success' => 'Product added to cart successfully!',
        'cart_fail' => 'Failed to add to cart. Please try again.',
        'order_success' => 'Order placed successfully! Check your email for details.',
        'already_ordered' => 'You have already placed an order for this product.',
        'empty_address' => 'Delivery address cannot be empty.',
        'already_in_cart' => 'Yoy have already added the product to cart'
    ];
    echo "<script>alert('{$messages[$_GET['message']]}');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>Customer Dashboard</title>
</head>
<body style="background-color: rgb(134, 134, 134);">

<section id="header">
    <a href="#"><img src="img/logo.png" id="logo" class="logo" alt="Logo"></a>
    <div>
        <ul id="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="track_order.php">Track Order</a></li>
            <li><a href="customer_logout.php">Logout</a></li>
            <li><a href="cart.php"><i class="far fa-shopping-bag"></i></a></li>
        </ul>
    </div>
</section>

<section id="prodetails" class="section-p1">
    <div class="single-pro-image">
        <img src="img/merchent_product/<?php echo $row['image']; ?>" width="90%" height="590px" id="MainImg" alt="">
    </div>

    <div class="single-pro-details">
        <form action="" method="post">
            <h6>Home / Fabric / <?php echo $row['brand']; ?></h6>
            <h4 id="id"><?php echo $row['description']; ?></h4>
            <h2 id="totalPrice">&#8377; <?php echo $row['price']; ?></h2>
            <select name="quantity" id="quantity" required onchange="updatePrice()">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <input type="hidden" id="basePrice" value="<?php echo $row['price']; ?>">

            <h4>Size Details</h4>
            <p name="size_des"><?php echo $row['size']; ?></p>
            <input type="text" name="address" id="address" placeholder="Enter delivery address here">
            <input id="payment_method" type="radio" checked> Cash on delivery<br>
            <button type="submit" name="cart" class="normal">Add to cart</button>
            <button type="submit" name="submit" class="normal">Order Now</button>
        </form>
    </div>
</section>

<script>
function updatePrice() {
    let quantity = document.getElementById("quantity").value;
    let basePrice = document.getElementById("basePrice").value;
    let totalPrice = quantity * basePrice;
    document.getElementById("totalPrice").innerHTML = "&#8377; " + totalPrice;
}
</script>


<style>
    #prodetails .single-pro-image {
        width: 40%;
        margin-right: 50px;
    }

    #prodetails .single-pro-image img {
        border-radius: 25px;
        border: 5px solid #ffffff;

    }

    #prodetails .single-pro-details p {
        color: #ffffff;
        display: block;
        width: 100%;
        height: auto;
        font-size: 18px;
        margin-bottom: 20px;
    }

    #prodetails {
        display: flex;
    }

    #prodetails .single-pro-details {
        width: 50%;
        padding-top: 0px;

    }

    #prodetails .single-pro-details h4 {
        padding: 15px 0 20px 0;
    }

    #prodetails .single-pro-details #id {
        color: #ffffff;
    }

    #prodetails .single-pro-details h2 {
        font-size: 26px;
    }

    #prodetails .single-pro-details select {
        display: block;
        width: 300px;
        height: 47px;
        border-radius: 5px;
        padding: 5px 10px;
    }

    #prodetails .single-pro-details button {
        margin-top: 20px;
        background-color: #1769a0;
        color: #ffffff;
    }

    #prodetails .single-pro-details button:hover {
    background-color: #6ba2c7;
    }

    #prodetails .single-pro-details #address {
        display: block;
        border-radius: 5px;
        border: 1px solid #ffffff;
        width: 100%;
        height: 40px;
        padding: 20px 20px;
        font-size: 18px;
        margin-bottom: 20px;
    }

    #prodetails .single-pro-details #payment_method {
    transform: scale(1.80);
    margin: 10px;
    accent-color:rgb(20, 20, 20);
    }
</style>

</body>
</html>