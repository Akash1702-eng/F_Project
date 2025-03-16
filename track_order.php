<?php
require 'connection.php';

$order_id = '';  // Initialize variable to retain input value

if (isset($_POST['submit'])) {
    $order_id = $_POST['order_id'];

    // Query to fetch the order details from the product_details table
    $stmt = $conn->prepare("SELECT * FROM product_details WHERE id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if order is found
    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        $status = $order['status']; // Assuming 'status' column exists in product_details table
    } else {
        $status = "Order not found. Please check the order ID.";
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
<title>Track Order</title>
</head>
<body>
<section id="header">
    <a href="#"><img src="img/logo.png" id="logo" class="logo" alt=""></a>
    <div>
        <ul id="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a class="active" href="track_order.php">Track Order</a></li>
            <li><a href="signup.php">Sign up</a></li>
            <li><a href="cart.php"><i class="far fa-shopping-bag"></i></a></li>
        </ul>
    </div>
</section>

<div class="container">
    <div class="box form-box">
        <header>Track Order</header>
        <form action="" method="post">
            <div class="field input">
                <label for="order_id">Order Id</label>
                <input type="text" name="order_id" id="order_id" value="<?php echo htmlspecialchars($order_id); ?>" required>
            </div>

            <div class="field">
                <input type="submit" class="btn" name="submit" value="Track Order">
            </div>
        </form>

        <?php if (isset($status)): ?>
            <div class="order-status">
            <br><p style="text-align: center;"><b>Order Status: </b><?php echo $status; ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
