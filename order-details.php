<?php
include("header.php"); // Include your header if needed
include("connect_db.php");

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    // Redirect to the login page if not logged in
    header("Location: user-login.php");
    exit();
}

// Get user name from the session
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
    $user_id = $row['user_id'];

    return $user_id;
}

// Get user ID from the username
$user_id = getUserId($user_name, $conn);

// Fetch product details from the cart based on user ID
$query = "SELECT p.product_title, c.quantity, regular_price
          FROM carts c
          JOIN product p ON c.product_id = p.product_id
          WHERE c.user_id = '$user_id'";

$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die("Error in query: " . mysqli_error($conn));
}

// Fetch the product details from the result
$row = mysqli_fetch_assoc($result);
$productName = $row['product_title'];
$quantity = $row['quantity'];
$price = $row['regular_price'];

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <!-- Bootstrap CSS Link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding-top: 60px; /* Adjusted for fixed navbar */
        }

        .container {
            margin: auto;
            overflow: hidden;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-4 mb-5">
    <h2>Order Details</h2>

    <!-- Order Form -->
    <form action="place-order.php" method="post">
        <input type="hidden" name="product_name" value="<?php echo $productName; ?>">
        <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
        <input type="hidden" name="price" value="<?php echo $price; ?>">
        
        <div class="form-group">
            <label for="productName">Product Name:</label>
            <input type="text" class="form-control" id="productName" value="<?php echo $productName; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" id="price" value="<?php echo $price; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" id="quantity" value="<?php echo $quantity; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="shippingAddress">Shipping Address:</label>
            <textarea class="form-control" id="shippingAddress" name="shipping_address" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</div>

<?php
include("footer.php"); // Include your footer if needed
?>

<!-- Bootstrap JS and Popper.js Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
