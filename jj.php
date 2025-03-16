<?php
require 'connection.php';
if (isset($_POST["submit"])) {
    $brand = $_POST["brand"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    if ($_FILES["image"]["error"] == 4) {
        echo "<script> alert('Image Does Not Exist'); </script>";
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"]; 
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script> alert('Invalid Image Extension'); </script>";
        } elseif ($fileSize > 1000000) {
            echo "<script> alert('Image Size Is Too Large'); </script>";
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension; 

            move_uploaded_file($tmpName, 'img/merchent_product/' . $newImageName);
            $query = "INSERT INTO akashkhurd1702(image, brand, description, price ) VALUES ('$newImageName', '$brand', '$description', '$price')"; 
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
    <title>Upload Image</title>
</head>
<body>
    <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
        <label for="image">Image : </label>
        <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png"><br><br> 
        <label for="name">Brand : </label>
        <input type="text" name="brand" id="brand" required><br>
        <label for="name">Description : </label>
        <input type="text" name="description" id="description" required><br>
        <label for="name">Price : </label>
        <input type="text" name="price" id="price" required><br>
        <button type="submit" name="submit">Submit</button>
    </form>
    <br>
</body>
</html>
