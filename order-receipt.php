<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt</title>
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

        .receipt {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .receipt h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .receipt-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .total {
            font-weight: bold;
            font-size: 1.2em;
        }

        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php
include("header.php"); // Include your header if needed
$username = $_SESSION["user_name"];
?>
<div class="container mt-4">

    <div class="receipt">

        <h2>Order Receipt</h2>

        <div class="receipt-details">
            <span>User Name:</span>
            <span><?php echo $username; ?></span>
        </div>

        <div class="receipt-details">
            <span>Shipping Address:</span>
            <span><?php echo $_GET['shipping_address']; ?></span>
        </div>

        <div class="receipt-details">
            <span>Product Name:</span>
            <span><?php echo $_GET['product_name']; ?></span>
        </div>

        <div class="receipt-details">
            <span>Quantity:</span>
            <span><?php echo $_GET['quantity']; ?></span>
        </div>

        <div class="receipt-details">
            <span>Price:</span>
            <span>PKR <?php echo $_GET['price']; ?> each</span>
        </div>

        <div class="receipt-details total">
            <span>Total:</span>
            <span>PKR <?php echo $_GET['price'] * $_GET['quantity']; ?></span>
        </div>

        <div class="btn-container">
            <a href="home.php" class="btn btn-success">Back to Homepage</a>
        </div>

    </div>

</div>


<!-- Bootstrap JS and Popper.js Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
