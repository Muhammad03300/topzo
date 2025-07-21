<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    // Redirect to the login page if not logged in
    header("Location: user-login.php");
    exit();
}

// Include database connection
include("connect_db.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['product_id'])) {
    // Get the product ID from the query string
    $product_id = intval($_GET['product_id']);

    // Get user ID from the session
    $user_name = $_SESSION['user_name'];
    $user_id = getUserId($user_name, $conn);

    // Check if the user has the specified product in the cart
    if (isProductInCart($user_id, $product_id, $conn)) {
        // Delete the product from the cart
        $query = "DELETE FROM carts WHERE product_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $stmt->close();

        // Check if the deletion was successful
        if ($stmt->affected_rows > 0) {
            // Return a success response
            echo "success";
        } else {
            // Return an error response
            echo "error";
        }
    } else {
        // Return an error response if the product is not in the user's cart
        echo "error";
    }
} else {
    // Return an error response if the request is not valid
    echo "error";
}

// Function to get user ID based on user name
function getUserId($user_name, $conn)
{
    $stmt = $conn->prepare("SELECT user_id FROM user WHERE name = ?");
    $stmt->bind_param("s", $user_name);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    return $user_id;
}

// Function to check if the product is in the user's cart
function isProductInCart($user_id, $product_id, $conn)
{
    $query = "SELECT * FROM carts WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $stmt->store_result();
    $num_rows = $stmt->num_rows;
    $stmt->close();

    return $num_rows > 0;
}

mysqli_close($conn);
?>
