<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    // Redirect to the login page if not logged in
    header("Location: user-login.php");
    exit();
}

// Get user name from the session
$user_name = $_SESSION['user_name'];

// Get product ID and quantity from the request (adjust this according to your actual implementation)
if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);

    // Validate the product ID (check if it exists in the products table)
    if (isValidProduct($product_id)) {
        // Add the product to the cart
        addToCart($user_name, $product_id, isset($_GET['quantity']) ? intval($_GET['quantity']) : 1);

        // Redirect to the cart page
        header("Location: cart.php");
        exit();
    } else {
        // Redirect to an error page or home page if the product is not valid
        header("Location: error.php");
        exit();
    }
} else {
    // Redirect to an error page or home page if product ID is not provided
    header("Location: error.php");
    exit();
}

// Function to check if the product ID is valid (replace this with your actual implementation)
function isValidProduct($product_id)
{
    // Sample query using MySQLi (you need to adjust it based on your database structure)
    include('connect_db.php');
    $stmt = $conn->prepare("SELECT product_id FROM product WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->store_result();
    $isValid = $stmt->num_rows > 0;
    $stmt->close();
    $conn->close();

    return $isValid;
}

// Function to add the product to the cart with quantity (replace this with your actual implementation)
function addToCart($user_name, $product_id, $quantity)
{
    // Fetch user ID based on user name
    $user_id = getUserIdFromUserName($user_name);

    // Check if the user ID is valid
    if ($user_id !== false) {

        // Sample query using MySQLi (you need to adjust it based on your database structure)
        include("connect_db.php");
        $stmt = $conn->prepare("INSERT INTO carts (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $user_id, $product_id, $quantity);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    } else {
        // Handle the case where the user ID is not valid
        header("Location: error.php");
        exit();
    }
}

// Function to get user ID based on user name (replace this with your actual implementation)
function getUserIdFromUserName($user_name)
{
    // Sample query using MySQLi (you need to adjust it based on your database structure)
    include("connect_db.php");
    $stmt = $conn->prepare("SELECT user_id FROM user WHERE name = ?");
    $stmt->bind_param("s", $user_name);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    return $user_id;
}
?>
