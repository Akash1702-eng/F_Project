<?php 
require 'connection.php'; 
$email = $_COOKIE['user_email'];

$stmt = $conn->prepare("SELECT * FROM cart WHERE customer_email = ? ORDER BY id ASC");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$rows = $result->fetch_all(MYSQLI_ASSOC);
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
<body style="background-color:rgb(247, 247, 247)">

<section id="header">
    <a href="#"><img src="img/logo.png" id="logo" class="logo" alt="Logo"></a>
    <div>
        <ul id="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="track_order.php">Track Order</a></li>
            <li><a href="signup.php">Sign Up</a></li>
            <li><a class="active" href="cart.php"><i class="far fa-shopping-bag"></i></a></li>
        </ul>
    </div>
</section>

<section id="page-header">
    <h1>#cart</h1>
    <p>Review the items in your cart and proceed to checkout</p>
</section>

<section id="cart" class="section-p1">
    <table width="100%">
        <thead>
            <tr>
                <td>Remove</td>
                <td>Shop Name</td>
                <td>Image</td>
                <td>Product</td>
                <td>Product Details</td>
                <td>Price</td>
                <td>Order Now</td> <!-- New Column -->
            </tr>
        </thead>
        <tbody>
        <?php 
        $total = 0;

        if (!empty($rows)) :
            foreach ($rows as $row) : 
                $total += $row['price']; // Add to total price
                
                // URL encoding to handle special characters in names and descriptions
                $value1 = urlencode($row['value1']);
                $value2 = urlencode($row['value2']);
                $value3 = urlencode($row['value3']);
                $sname = urlencode($row['sname']);

                // Conditional redirection based on price
                if ($row['price'] > 400) {
                    $order_url = "spage_ready_made.php?value1=$value1&value2=$value2&value3=$value3&sname=$sname";
                } else {
                    $order_url = "spage.php?value1=$value1&value2=$value2&value3=$value3&sname=$sname";
                }
        ?>
            <tr>
                <td><a href="remove_from_cart.php?id=<?php echo $row['id']; ?>"><i class="far fa-times-circle"></i></a></td>
                <td><?php echo $row['sname']; ?></td>
                <td><img src="img/merchent_product/<?php echo $row['image']; ?>" alt="Product Image"></td>
                <td><?php echo $row['product']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo "&#8377;" . number_format($row['price'], 2); ?></td>
                <td>
                    <a href="<?php echo $order_url; ?>" class="order-btn">Order Now</a>
                </td>
            </tr>
        <?php 
            endforeach; 
        else : 
        ?>
            <tr>
                <td colspan="7" style="text-align:center;">Your cart is empty. Add items to the cart to view them here!</td>
            </tr>
        <?php endif; ?>
        </tbody>
        <?php if (!empty($rows)) : ?>
        <tfoot>
            <tr>
                <td colspan="5" style="text-align:right; font-weight:bold;">Total:</td>
                <td><?php echo "&#8377;" . number_format($total, 2); ?></td>
                <td></td>
            </tr>
        </tfoot>
        <?php endif; ?>
    </table>
</section>
<style>
#page-header {
    background-color: #000000;
    width: 100%;
    height: 30vh;
    background-size: cover;
    display: flex;
    justify-content: center;
    text-align: center;
    flex-direction: column;
    padding: 14px;
}

#page-header h1, p {
    color: #ffffff;
}

#cart table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
    white-space: nowrap;
}

#cart table img {
    width: 70px;
}

#cart table td:nth-child(1),
#cart table td:nth-child(2),
#cart table td:nth-child(3),
#cart table td:nth-child(4),
#cart table td:nth-child(5),
#cart table td:nth-child(6) {
    text-align: center;
}

#cart table td:nth-child(5) {
    width: 250px;
    text-align: center;
    word-wrap: break-word; 
    overflow-wrap: break-word;
    white-space: normal; 
}

#cart table thead td {
    font-weight: 700;
    text-transform: uppercase;
    font-size: 13px;
    padding: 18px 0;
    border-bottom: 1px solid #e2e9e1;
}

#cart table tbody td {
    padding: 15px 0;
    font-size: 14px;
}

#cart table tbody tr:hover {
    background-color: #f5f5f5;
}

#cart table tfoot td {
    padding: 10px 0;
    font-size: 16px;
    font-weight: bold;
    border-top: 1px solid #e2e9e1;
}

/* Order Now Button Styling */
.order-btn {
    display: inline-block;
    padding: 8px 12px;
    background-color: #1769a0;
    color: #ffffff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 14px;
}

.order-btn:hover {
    background-color: #6ba2c7;
}
</style>
</body>
</html>