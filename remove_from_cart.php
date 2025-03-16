<?php
require 'connection.php';

if (isset($_GET['id'])) 
{
    $cart_id = $_GET['id'];

    // Delete the item from the cart table based on cart_id
    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ?");
    $stmt->bind_param("i", $cart_id);
    
    if ($stmt->execute()) 
    {
        // Redirect back to the cart page after removal
        header("Location: cart.php");
    } 
    else 
    {
        // Handle error if deletion fails
        header("Location: cart.php?message");
    }
    exit();
}
?>