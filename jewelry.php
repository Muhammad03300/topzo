<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your E-commerce Site</title>
    <!-- Bootstrap CSS Link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1em;
        }

        .container {
            margin: auto;
            overflow: hidden;
        }

        .product {
            margin-bottom: 20px;
        }

        /* CSS for image zoom effect */
        .product-card img {
            transition: transform 0.3s ease-in-out;
        }

        .product-card:hover img {
            transform: scale(1.1);
        }

        /* Style for the product card link */
        .product-card-link {
            text-decoration: none; /* Remove underline */
            color: inherit; /* Inherit text color */
        }
    </style>
</head>

<body>

    <?php
    include('header.php');
    include('connect_db.php');

    // Check if a category filter is set
    $categoryFilter = isset($_GET['product_category']) ? $_GET['product_category'] : 'All';

    // Fetch products from the database based on the category filter
    if ($categoryFilter == 'All') {
        $query = "SELECT * FROM product WHERE LOWER(product_category) IN ('Necklace', 'Rings')";
    } else {
        $query = "SELECT * FROM product WHERE LOWER(product_category) = LOWER('$categoryFilter')";
    }

    $result = $conn->query($query);

    if (!$result) {
        die("Error in query: " . $conn->error);
    }
    ?>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Jewelry</h2>

        <!-- Dropdown Button for Category Filter -->
        <form action="jewelry.php" method="get" class="mb-3">
            <div class="form-group">
                <label for="categoryFilter">Select Category:</label>
                <select class="form-control" id="categoryFilter" name="product_category">
                    <option value="All" <?php echo ($categoryFilter == 'All') ? 'selected' : ''; ?>>All</option>
                    <option value="Necklace" <?php echo ($categoryFilter == 'Necklace') ? 'selected' : ''; ?>>Necklaces</option>
                    <option value="Rings" <?php echo ($categoryFilter == 'Rings') ? 'selected' : ''; ?>>Rings</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <?php
        if ($result->num_rows > 0) {
            echo '<div class="row">';
            while ($row = $result->fetch_assoc()) {
                // Assuming your database column for file path is named 'file_path'
                $fileUrl = $row['file_path'];

                echo '<div class="col-lg-3 col-md-6 mb-5">';
                echo '<div class="card product-card">';
                // Add anchor tag around the product card with href to product-details.php
                echo '<a href="product-details.php?product_id=' . $row['product_id'] . '" class="product-card-link">';
                echo '<img class="card-img-top" src="' . $fileUrl . '" alt="Uploaded Image" style="height: 200px;">'; // Specify the fixed height
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['product_title'] . '</h5>';
                echo '<h6 class="card-text">PKR : ' . $row['regular_price'] . '</h6>';
                echo '</div>';
                echo '</a>'; // Close the anchor tag
                echo '</div></div>';
            }
            echo '</div>';
        } else {
            echo '<p>No products available.</p>';
        }

        // Close the database connection here after all queries
        $conn->close();
        ?>
    </div>

    <?php
    include('footer.php');
    ?>

    <!-- Bootstrap JS and Popper.js Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
