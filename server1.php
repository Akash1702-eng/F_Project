<?php require 'connection.php'; ?>

<html>
    <head>
        <title>Customer Details</title>
    </head>
<body>
    <h1>Registered Shops Details</h1>
    <table>
        <tr>
            <th class="id">Id</th>
            <th>Shop Name</th>
            <th>Country</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Transaction Id</th>
            <th>Paid Amount</th>
            <th>Add or Delete Shop</th>
            <th>Remove Row</th>
        </tr>
    </table>

<?php 
$query = "SELECT * FROM shops ORDER BY id ASC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (!empty($rows)) :
    foreach ($rows as $row) : 
?>

    <table>
        <tr>
            <td class="id"><?php echo $row['id']; ?></td>
            <td><?php echo $row['sname']; ?></td>
            <td><?php echo $row['country']; ?></td>
            <td><?php echo $row['addresss']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['transaction']; ?></td>
            <td><?php echo $row['amount']; ?></td>

            <!-- Add/Delete Shop Form -->
            <td>
                <form action="" method="post">
                    <input type="hidden" name="shop_id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="add" value="ADD" id="add">
                    <input type="submit" name="delete" value="DELETE" id="delete">
                </form>
            </td>

            <!-- Remove Row Form -->
            <td>
                <form action="" method="post">
                    <input type="hidden" name="remove_id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="remove" value="REMOVE" id="remove">
                </form>
            </td>
        </tr>
    </table>

<?php  
    /* Create Table */
    if (isset($_POST['add']) && isset($_POST['shop_id'])) {
        $shopId = $_POST['shop_id'];
        $result = mysqli_query($conn, "SELECT email FROM shops WHERE id = '$shopId'");

        if ($row = mysqli_fetch_assoc($result)) {  
            $email = $row['email'];
            
            $emailPrefix = explode('@', $email)[0];

            if (!mysqli_num_rows(mysqli_query($conn, "SHOW TABLES LIKE '$emailPrefix'"))) {
                $sql = "CREATE TABLE `$emailPrefix` (
                    id INT(50) AUTO_INCREMENT PRIMARY KEY,
                    image VARCHAR(50),
                    brand VARCHAR(50),
                    description VARCHAR(255),
                    price INT(50),
                    email VARCHAR(50)
                )";
                mysqli_query($conn, $sql);
            }
        }
    }
    
    /* Drop Table */
    if (isset($_POST['delete']) && isset($_POST['shop_id'])) {
    $shopId = $_POST['shop_id'];
    $result = mysqli_query($conn, "SELECT email FROM shops WHERE id = '$shopId'");

    if ($row = mysqli_fetch_assoc($result)) {  
        $email = $row['email'];
        
        $emailPrefix = explode('@', $email)[0];

        // Drop the shop-specific table
        $sql = "DROP TABLE IF EXISTS `$emailPrefix`";
        mysqli_query($conn, $sql);

        // Delete rows from the ready_made_product table associated with this email
        $sql = "DELETE FROM ready_made_product WHERE email = '$emailPrefix'";
        mysqli_query($conn, $sql);
    }
    }

    /* Remove Row */
    if (isset($_POST['remove']) && isset($_POST['remove_id'])) {
        $removeId = mysqli_real_escape_string($conn, $_POST['remove_id']);
        $sql = "DELETE FROM shops WHERE id = '$removeId'";
        $conn->query($sql);
    }
?>
    
<?php 
    endforeach; 
else : 
?>
    <p>No data found.</p>
<?php endif; ?>

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
        width: 10.67%;
        word-wrap: break-word;
        word-break: break-word;
        white-space: normal;
    }

    table, th, tr, td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 0.5rem 1rem;
    }

    #delete {
        margin-left: 1px;
    }

    #remove {
        margin-left: 20px;
    }
</style>
</body>
</html>