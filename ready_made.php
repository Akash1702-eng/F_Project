<?php
require 'connection.php';
$email = $_GET['value'];

if (isset($_POST["submit"])) 
{
    $brand = $_POST["brand"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $size = $_POST["size"];
    $sname = $_POST["sname"];

    if ($_FILES["image"]["error"] == 4) 
    {
        echo "<script> alert('Image Does Not Exist'); </script>";
    } 
    else 
    {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"]; 
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));

        if (!in_array($imageExtension, $validImageExtension)) 
        {
            echo "<script> alert('Invalid Image Extension'); </script>";
        } 
        elseif ($fileSize > 1000000) 
        {
            echo "<script> alert('Image Size Is Too Large'); </script>";
        } 
        else 
        {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension; 

            move_uploaded_file($tmpName, 'img/merchent_product/' . $newImageName);
            $query = "INSERT INTO ready_made_product(image, brand, description, price, email, size, sname) VALUES ('$newImageName', '$brand', '$description', '$price', '$email', '$size', '$sname')";  
            mysqli_query($conn, $query);
            echo "<script> alert('Successfully added'); </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="payment.css">
    <title>Upload Image</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Add Ready Made Product</header>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="field input">
                    <label for="sname">Shop Name</label>
                    <input type="text" name="sname" id="sname" required>
                </div>

                <label>Choose Image</label>
                <div class="custom-file">
                    <label for="image"></label>
                    <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" required>
                </div>

                <div class="field input">
                    <label for="brand">Brand</label>
                    <input type="text" name="brand" id="brand" required>
                </div>

                <div class="field input">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" required>
                </div>

                <div class="field input">
                    <label for="price">Price</label>
                    <input type="text" name="price" id="price" required>
                </div>

                <div class="field input">
                    <label for="size">Size</label>
                    <input type="text" name="size" id="size" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Submit">
                </div>

            </form>
        </div>
    </div>

    <style>
        .custom-file {
            margin-bottom: 5px;
        }

        .custom-file input[type="file"] {
            opacity: 0;
            position: absolute;
            z-index: -1;
        }

        .custom-file label {
            width: 400px;
            height: 40px;
            display: inline-block;
            padding: 10px 5px;
            background-color:rgb(199, 199, 199);
            border-radius: 4px;
            cursor: pointer;
            font-size: 15px;
        }

        .custom-file label:hover {
            background-color:rgb(184, 184, 184);
        }

    </style>

</body>
</html>
