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

<section id="page-header">
    <h1>#stayhome</h1>
    <p>Save efforts and enjoy shopping</p>
</section>

<?php
require 'connection.php';

try 
{
    // Fetch matching shops
    $query = "
        SELECT shops.*, tables_list.table_name 
        FROM shops 
        JOIN (
            SELECT TABLE_NAME AS table_name 
            FROM INFORMATION_SCHEMA.TABLES 
            WHERE TABLE_SCHEMA = DATABASE()
        ) tables_list 
        ON tables_list.table_name = SUBSTRING_INDEX(shops.email, '@', 1)
        ORDER BY shops.id ASC
    ";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) 
    {
        echo '<section id="product1" class="section-p1">';
        echo '<div class="pro-container">';
        while ($row = $result->fetch_assoc()) 
        {
            ?>
            <div class="pro">
                <div class="des" style="height: 135px;">
                    <h5><?php echo $row['sname']; ?></h5>
                    <span>address: <?php echo $row['addresss']; ?></span><br>
                    <span>email: <?php echo $row['email']; ?></span><br>
                    <span>phone: <?php echo $row['phone']; ?></span>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <a class="btn" href="product_details.php?value1=<?php echo $row['email']; ?>&value2=<?php echo $row['sname']; ?>">Explore Us</a>
            </div>
            <?php
        }
        echo '</div>';
        echo '</section>';
    } 
    else 
    {
        echo '<section id="product1" class="section-p1">';
        echo '<div class="pro-container">';
        echo '<p>No shops found.</p>';
        echo '</div>';
        echo '</section>';
    }
} 
catch (Exception $e) 
{
    echo "Error: " . $e->getMessage();
}

// Close connection
$conn->close();
?>

<style>
    .btn {
    display: flex;
    margin-bottom: 10px;
    flex-direction: column;
    text-align: center;
    text-decoration: none;
    height: 35px;
    background: #1769a0;
    border: 0;
    border-radius: 25px;
    color: #fff;
    font-size: 15px;
    cursor: pointer;
    transition: all .3s;
    margin-top: 5px;
    padding: 10px 10px;
}

.btn:hover {
    background-color: #6ba2c7;
}

#page-header {
    background-color: #000000;
    width: 100%;
    height: 42.5vh;
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

</style>

</body>
</html>