<?php
include("header.php");
include('connect_db.php');

// Check if product_id is set in the query string
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Fetch product details from the database
    $query = "SELECT * FROM product WHERE product_id = $product_id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Display product details
        echo '<div class="container mt-4">';
        echo '<div class="row">';
        echo '<div class="col-md-6">';
        echo '<img src="' . $row['file_path'] . '" alt="Product Image" class="product-img img-fluid">';
        echo '</div>';
        echo '<div class="col-md-6 product-details">';
        echo '<h2>' . $row['product_title'] . '</h2>';
        echo '<p>' . $row['product_description'] . '</p>';
        echo '<p>Price: PKR: ' . $row['regular_price'] . '</p>';

        // Add quantity input field
        echo '<label for="quantity">Quantity:</label>';
        echo '<input type="number" id="quantity" name="quantity" value="1" min="1"><br><br>';

        // Update "Add to Cart" link to include quantity
        echo '<a href="add-to-cart.php?product_id=' . $product_id . '&quantity=" class="btn btn-primary" id="addToCartBtn">Add to Cart</a>';
        echo '</div>';
        echo '</div>';

        // Display Specifications
        echo '<div class="row mt-3 mb-5">';
        echo '<div class="col-md-12">';
        echo '<h3>Specifications</h3>';
        echo '<ul>';
        echo '<li><b> Product Condition: </b>' . $row['product_condition'] . '</li>';
        echo '<li><b> Manufacturer: </b>'.$row['manufacturer'] . '</li>';
        echo '<li><b> Shipping </b>' . $row['shipping'] . '</li>';
        echo '<li><b> Adult: </b>' . $row['adult'] . '</li>';
        echo '<li><b> Age Group: </b>' . $row['age_group'] . '</li>';
        echo '<li><b> Color: </b>' . $row['color'] . '</li>';
        echo '<li><b> Gender: </b>' . $row['gender'] . '</li>';
        echo '<li><b> Size: </b>' . $row['size'] . '</li>';
        echo '<li><b> Material: </b>' . $row['material'] . '</li>';
        echo '<li><b> Pattern: </b>' . $row['pattern'] . '</li>';

        echo '</ul>';
        echo '</div>';
        echo '</div>';

        // Display Reviews Section (you can customize this part based on your requirements)

        echo '</div>';
    } else {
        echo '<div class="container mt-4">';
        echo '<p>Product not found.</p>';
        echo '</div>';
    }

    // Close the database connection
    $conn->close();
} else {
    echo '<div class="container mt-4">';
    echo '<p>Product ID not provided.</p>';
    echo '</div>';
}

echo '<script>';
echo 'document.getElementById("addToCartBtn").addEventListener("click", function() {';
echo '    var quantity = document.getElementById("quantity").value;';
echo '    this.href = "add-to-cart.php?product_id=' . $product_id . '&quantity=" + quantity;';
echo '});';
echo '</script>';

// Close the database connection

include("footer.php");
?>