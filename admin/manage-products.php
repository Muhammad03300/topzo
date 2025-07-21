
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <!-- Add Bootstrap CDN links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<?php
include('header-seller.php');
?>
    <div class="container">
        <h2 class="mt-4 mb-4">Product Management</h2>

        <?php
        // Include your database connection file
        include("connect_db.php");

        // Check if the form is submitted (delete button clicked)
        if (isset($_POST['delete'])) {
            $productId = $_POST['delete'];

            // Prompt user for confirmation using JavaScript
            echo "<script>
                    var deleteConfirmation = confirm('Are you sure you want to delete this product?');
                    if (deleteConfirmation) {
                        window.location.href = 'delete-product.php?product_id=$productId';
                    }
                </script>";
        }

        // Fetch products data from the database
        $query = "SELECT * FROM products";
        $result = $conn->query($query);
        $sno = 1;
        if ($result->num_rows > 0) {
            echo '<table class="table table-bordered">';
            echo '<thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Title</th>
                        <th>Regular Price</th>
                        <th>Action</th>
                    </tr>
                  </thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td> $sno</td>
                        <td>{$row['product_title']}</td>
                        <td>{$row['regular_price']}</td>
                        <td>
                            <a href='edit-product.php?product_id={$row['product_id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <form method='POST' style='display:inline;'>
                                <button type='submit' class='btn btn-danger btn-sm' name='delete' value='{$row['product_id']}'>Delete</button>
                            </form>
                        </td>
                    </tr>";
                    $sno++;
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No products available.</p>';
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>

    <!-- Add Bootstrap JS and Popper.js CDN links -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
