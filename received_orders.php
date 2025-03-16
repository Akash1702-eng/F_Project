<?php 
require 'connection.php'; 
$shop_email = $_GET['value'];
?>

<html>
<head>
    <title>Order Details</title>
</head>
<body>
    <h1>Received Orders</h1>
    <a href="guide.html" style="font-size: 20px ">Measures Guide</a><br><br>
    <table>
        <tr>
            <th class="id">Id</th>
            <th>Brand</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Gender</th>
            <th>Clothing Type</th>
            <th>Customization Details</th>
            <th>Sample Image</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Status</th>
            <th>Update Status</th>
        </tr>

        <?php 
        $query = "SELECT * FROM product_details WHERE shop_email = '$shop_email' ORDER BY id ASC";
        $result = mysqli_query($conn, $query);

        if (!$result) 
        {
            die("Query failed: " . mysqli_error($conn));
        }

        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if (!empty($rows)) :
            foreach ($rows as $row) : 
        ?>
        
        <tr>
            <td class="id"><?php echo $row['id']; ?></td>
            <td><?php echo $row['brand']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo $row['gender']; ?></td>
            <td><?php echo $row['clothing_type']; ?></td>
            <td><?php echo "Measurement1 = ".$row['measurement1']."<br>"."Measurement2 = ".$row['measurement2']."<br>"."Measurement3 = ".$row['measurement3']."<br>"."Measurement4 = ".$row['measurement4']; ?></td>
            <td>
                <a href="<?php echo $row['image']; ?>" target="_blank">
                <img id="myImage" src="<?php echo $row['image']; ?>" alt="Product Image" onerror="this.style.display='none';" width="80px" style="margin-left: 15px">
                </a>
            </td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['addresss']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="text" name="status" style="width: 140px" placeholder="Enter status">
                    <input type="submit" name="update" id="update" value="UPDATE">
                </form>
            </td>
        </tr>
        <?php 
            endforeach; 
        else : 
        ?>
        <tr>
            <td colspan="9">No data found.</td>
        </tr>
        <?php endif; ?>
    </table>

    <?php

    if (isset($_POST['update']) && isset($_POST['id']) && isset($_POST['status'])) 
    {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $updateQuery = "UPDATE product_details SET status = '$status' WHERE id = '$id'";

        if (mysqli_query($conn, $updateQuery)) 
        {
            echo "<script>alert('Status updated successfully for ID: $id')</script>";
        } else 
        {
            echo "<script>alert('Error updating status')</script>";
        }
    }
    ?>

    <style>
    h1 {
        text-align: center;
    }

    th {
        background-color: #b0b0b0;
    }

    table {
        width: 100%;
        text-align: left;
    }

    .id {
        width: 4%;
    }

    td, th {
        width: 10%;
        word-wrap: break-word;
        word-break: break-word;
        white-space: normal;
    }

    table, th, tr, td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 0.5rem 1rem;
    }

    #update {
        margin-top: 5px;
    }
</style>
</body>
</html>