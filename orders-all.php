<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.php");
    exit();
}
include "connect_db.php";
include "header-seller.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Orders Details</h1>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Quantity</th>
                    <th>Regular Price</th>
                    <th>Shipping Address</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include your database connection file

                // Fetch orders details from the database
                $query = "SELECT product_title, quantity, total_price, shipping_address, email, phone_no, username FROM orderss";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["product_title"] . '</td>';
                        echo '<td>' . $row["quantity"] . '</td>';
                        echo '<td>PKR ' . $row["total_price"] . '</td>';
                        echo '<td>' . $row["shipping_address"] . '</td>';
                        echo '<td>' . $row["email"] . '</td>';
                        echo '<td>' . $row["phone_no"] . '</td>';
                        echo '<td>' . $row["username"] . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="7">No orders found.</td></tr>';
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
