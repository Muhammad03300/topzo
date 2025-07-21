<?php
include("connect_db.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION["user_name"];
    $product_name = $_POST["product_name"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $shipping_address = $_POST["shipping_address"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    // Insert the order details into the 'orders' table
    $query = "INSERT INTO orderss (product_title, quantity, total_price, shipping_address, email, phone_no, username)
              VALUES ('$product_name', '$quantity', '$price' * '$quantity', '$shipping_address', '$email', '$phone','$username')";

    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if (!$result) {
        die("Error in query: " . mysqli_error($conn));
    }

    // Delete the entry from the cart table
    $deleteQuery = "DELETE FROM carts WHERE user_id = (SELECT user_id FROM user WHERE name = '$username') AND product_id = (SELECT product_id FROM product WHERE product_title = '$product_name')";
    
    $deleteResult = mysqli_query($conn, $deleteQuery);

    // Check if the delete query was successful
    if (!$deleteResult) {
        die("Error in delete query: " . mysqli_error($conn));
    }

    // Close the database connection
    mysqli_close($conn);

    // Construct the URL parameters
    $urlParams = http_build_query([
        'product_name' => $product_name,
        'quantity' => $quantity,
        'price' => $price,
        'shipping_address' => $shipping_address,
        'email' => $email,
        'phone' => $phone,
    ]);

    // Redirect to a confirmation page or any other desired page
    header("Location: order-receipt.php?" . $urlParams);
    exit();
}
?>
