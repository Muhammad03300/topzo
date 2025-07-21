<?php
// Include your database connection file
include("connect_db.php");

// Check if the form is submitted (update button clicked)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $productTitle = $_POST['product_title'];
    $productDescription = $_POST['product_description'];
    $productCategory = $_POST['product_category'];
    $stockAvailability = $_POST['stock_availability'];
    $regularPrice = $_POST['regular_price'];
    $productCondition = $_POST['product_condition'];
    $manufacturer = $_POST['manufacturer'];
    $mpn = $_POST['mpn'];
    $shipping = $_POST['shipping'];
    $adult = $_POST['adult'];
    $ageGroup = $_POST['age_group'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $material = $_POST['material'];
    $pattern = $_POST['pattern'];

    // Update query with prepared statement
    $updateQuery = "UPDATE product SET 
                    product_title = ?, 
                    product_description = ?, 
                    product_category = ?, 
                    stock_availability = ?, 
                    regular_price = ?, 
                    product_condition = ?, 
                    manufacturer = ?, 
                    mpn = ?, 
                    shipping = ?, 
                    adult = ?, 
                    age_group = ?, 
                    color = ?, 
                    size = ?, 
                    material = ?, 
                    pattern = ?
                    WHERE product_id = ?";

    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssssssssssssssi", $productTitle, $productDescription, $productCategory, $stockAvailability, $regularPrice, $productCondition, $manufacturer, $mpn, $shipping, $adult, $ageGroup, $color, $size, $material, $pattern, $productId);

    if ($stmt->execute()) {
        header('Location: manage-products.php');
        exit(); // Ensure no other output is sent
    } else {
        echo '<div class="alert alert-danger" role="alert">Error updating product: ' . $conn->error . '</div>';
    }

    $stmt->close(); // Close prepared statement
}

// Close the database connection
$conn->close();
?>
