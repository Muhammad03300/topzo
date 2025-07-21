<?php
// functions.php

function getCartItems($user_id) {
    // Replace these with your actual database connection details
    include('connect_db.php');

    // Prepare and execute the query to fetch cart items for the given user_id
    $query = "SELECT p.product_title
              FROM Cart c
              JOIN Products p ON c.product_id = p.product_id
              WHERE c.user_id = '$user_id'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if (!$result) {
        die("Error in query: " . mysqli_error($conn));
    }

    // Fetch the results into an associative array
    $cartItems = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $cartItems[] = $row;
    }

    // Close the database connection
    mysqli_close($conn);

    return $cartItems;
}

?>