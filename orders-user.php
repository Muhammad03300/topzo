<?php
// Include your header if needed
include("header.php");
include("connect_db.php"); // Include your database connection script

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    // Redirect to the login page if not logged in
    header("Location: user-login.php");
    exit();
}

// Get user ID from the session
$user_name = $_SESSION['user_name'];

// Function to get user ID based on user name
function getUserId($user_name, $conn)
{
    // Prepare and execute the query to fetch user ID for the given user_name
    $query = "SELECT user_id FROM user WHERE name = '$user_name'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if (!$result) {
        die("Error in query: " . mysqli_error($conn));
    }

    // Fetch the user ID from the result
    $row = mysqli_fetch_assoc($result);

    return $row['id']; // Fixed: returning user_id instead of undefined variable
}

// If delete all button is pressed
if(isset($_POST['delete_all'])){
    // Proceed with deleting all orders for the user from the database
    $delete_query = "DELETE FROM orderss WHERE username = '$user_name'";
    $delete_result = mysqli_query($conn, $delete_query);

    if($delete_result) {
        echo "All orders deleted successfully.";

    } else {
        // Failed to delete orders
        echo "Error deleting orders: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <!-- Bootstrap CSS Link -->
    <style>
        .container {
            margin-top: 20px;
        }
        .order-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .order-details {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Your Orders</h2>

    <?php
    $sno=1;
    // Fetch orders data from the database
    $query = "SELECT * FROM orderss WHERE username = '$user_name'";
    $result = mysqli_query($conn, $query);

    // Iterate through the fetched orders and display them
    while ($order = mysqli_fetch_assoc($result)) {
        ?>
        <div class="order-card">
            <h4>Order #<?php echo $sno; ?></h4>
            <div class="order-details">
                <span>Product:</span>
                <span><?php echo $order['product_title']; ?></span>
            </div>
            <div class="order-details">
                <span>Quantity:</span>
                <span><?php echo $order['quantity']; ?></span>
            </div>
            <div class="order-details">
                <span>Total Price:</span>
                <span>PKR <?php echo number_format($order['total_price'], 2); ?></span>
            </div>
        </div>
        <?php
        $sno++;
    }
    ?>

    <!-- Form for delete all button -->
    <form id="delete-all-form" method="post">
        <button type="submit" name="delete_all" class="btn btn-danger">Delete All Orders</button>
    </form>

</div>

<script>
// JavaScript to display an alert after successfully deleting all orders
$(document).ready(function(){
    $('#delete-all-form').submit(function(){
        var confirmDelete = confirm("Are you sure you want to delete all orders?");
        if(confirmDelete){
            alert("All orders deleted successfully!");
        }
        return confirmDelete;
    });
});
</script>

</body>
</html>
