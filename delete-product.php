<?php
// Include your database connection file
include("connect_db.php");

// Check if product_id is provided in the URL
if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    // Prepare and execute the DELETE query
    $stmt = $conn->prepare("DELETE FROM product WHERE product_id = ?");
    $stmt->bind_param("i", $productId);
    $result = $stmt->execute();

    // Check if deletion was successful
    if ($result) {
        // Redirect back to manage-products.php after deletion
        header("Location: manage-products.php");
        exit();
    } else {
        echo "Error deleting product.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
