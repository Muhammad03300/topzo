<?php
include("connect_db.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['product_id'])) {
    // Get the product ID from the query string
    $product_id = intval($_GET['product_id']);

    // Check if the user is logged in
    session_start();
    if (!isset($_SESSION['user_name'])) {
        // Redirect to the login page if not logged in
        header("Location: user-login.php");
        exit();
    }

    // Get user ID from the session
    $user_name = $_SESSION['user_name'];
    $user_id = getUserId($user_name, $conn);

    // Check if the user has the specified product in the cart
    if (isProductInCart($user_id, $product_id, $conn)) {
        // Delete the product from the cart
        $query = "DELETE FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $result = mysqli_query($conn, $query);

        // Check if the deletion was successful
        if ($result) {
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
    $query = "SELECT id FROM users WHERE name = '$user_name'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error in query: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    $user_id = $row['id'];

    return $user_id;
}

// Function to check if the product is in the user's cart
function isProductInCart($user_id, $product_id, $conn)
{
    $query = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error in query: " . mysqli_error($conn));
    }

    return mysqli_num_rows($result) > 0;
}

mysqli_close($conn);
?>
