<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <!-- Add Bootstrap CDN links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>


    form {
        max-width: 600px;
        margin: auto;
    }
    </style>
</head>

<body>
<?php 
include('header-seller.php');
?>
    <div class="container">
        <h2 class="mt-4 mb-4">Edit Product</h2>

        <?php
        // Include your database connection file
        include("connect_db.php");

        // Check if the form is submitted (edit button clicked)
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['product_id'])) {
            $productId = $_GET['product_id'];

            // Fetch product data for the selected product
            $selectQuery = "SELECT * FROM products WHERE product_id = $productId";
            $result = $conn->query($selectQuery);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Display the edit form with pre-filled values
                echo '<form method="POST" action="update-product.php">';
                echo '<input type="hidden" name="product_id" value="' . $row['product_id'] . '">';
                echo '<div class="mb-3">
                        <label for="product_title" class="form-label">Product Title</label>
                        <input type="text" class="form-control" id="product_title" name="product_title" value="' . $row['product_title'] . '" required>
                      </div>';
                echo '<div class="mb-3">
                        <label for="product_description" class="form-label">Product Description</label>
                        <textarea class="form-control" id="product_description" name="product_description">' . $row['product_description'] . '</textarea>
                      </div>';
                echo '<div class="mb-3">
                        <label for="product_category" class="form-label">Product Category</label>
                        <input type="text" class="form-control" id="product_category" name="product_category" value="' . $row['product_category'] . '">
                      </div>';
                echo '<div class="mb-3">
                      <label for="stock_availabality" class="form-label">Stock Availability</label>
                      <input type="text" class="form-control" id="stock_availability" name="stock_availability" value="' . $row['stock_availability'] . '">
                    </div>';

                echo '<div class="mb-3">
                    <label for="regular_price" class="form-label">Regular Price</label>
                    <input type="text" class="form-control" id="regular_price" name="regular_price" value="' . $row['regular_price'] . '">
                  </div>';
                echo '<div class="mb-3">
                  <label for="product_condition" class="form-label">Product Condition</label>
                  <input type="text" class="form-control" id="product_condition" name="product_condition" value="' . $row['product_condition'] . '">
                </div>';
                echo '<div class="mb-3">
                <label for="product_category" class="form-label">Product Category</label>
                <input type="text" class="form-control" id="product_category" name="product_category" value="' . $row['product_category'] . '">
                </div>';
                echo '<div class="mb-3">
                <label for="manufacturer" class="form-label">Manufacturer</label>
                <input type="text" class="form-control" id="manufacturer" name="manufacturer" value="' . $row['manufacturer'] . '">
                </div>';
                echo '<div class="mb-3">
                <label for="mpn" class="form-label">MPN</label>
                <input type="text" class="form-control" id="mpn" name="mpn" value="' . $row['mpn'] . '">
                </div>';
                echo '<div class="mb-3">
                <label for="shipping" class="form-label">Manufacturer</label>
                <input type="text" class="form-control" id="shipping" name="shipping" value="' . $row['shipping'] . '">
                </div>';
                echo '<div class="mb-3">
                <label for="manufacturer" class="form-label">Adult</label>
                <input type="text" class="form-control" id="adult" name="adult" value="' . $row['adult'] . '">
                </div>';
                echo '<div class="mb-3">
                <label for="manufacturer" class="form-label">Age Group</label>
                <input type="text" class="form-control" id="age_group" name="age_group" value="' . $row['age_group'] . '">
                </div>';
                echo '<div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <input type="text" class="form-control" id="color" name="color" value="' . $row['color'] . '">
                </div>';
                echo '<div class="mb-3">
                <label for="size" class="form-label">Size</label>
                <input type="text" class="form-control" id="size" name="size" value="' . $row['size'] . '">
                </div>';
                echo '<div class="mb-3">
                <label for="material" class="form-label">Material</label>
                <input type="text" class="form-control" id="material" name="material" value="' . $row['material'] . '">
                </div>';
                echo '<div class="mb-3">
                <label for="pattern" class="form-label">Pattern</label>
                <input type="text" class="form-control" id="pattern" name="pattern" value="' . $row['pattern'] . '">
                </div>';

                echo '<button type="submit" class="btn btn-primary">Update Product</button>';
                echo '</form>';
            } else {
                echo '<p>No product found for editing.</p>';
            }
        } else {
            echo '<p>No product selected for editing.</p>';
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