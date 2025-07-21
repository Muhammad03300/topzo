<?php
    include("connect_db.php");
    include('header.php');
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- (Your existing head section) -->
    <style>
        /* Add the following styles for the header */
        header {
            background: url('home-cover.jpg') center center fixed;
            background-size: cover;
            color: white;
            text-align: center;
            padding: 100px 0; /* Adjust padding as needed */
        }

        header h1 {
            font-size: 3em;
        }

        header p {
            font-size: 1.5em;
            margin-top: 20px;
        }

        /* Add styles to remove blue decoration from anchor tags */
        a,
        a:link,
        a:visited {
            text-decoration: none; /* Remove underline */
            color: inherit; /* Inherit text color from parent */
        }

        a:hover,
        a:active {
            color: inherit; /* Inherit text color from parent for hover and active states */
        }

        /* Additional styles for product cards */
        .product-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-card img {
            transition: transform 0.3s;
        }

        .product-card:hover img {
            transform: scale(1.1);
        }

        .product-card .card-body {
            padding: 15px;
        }

        .product-card .card-title {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .product-card .card-text {
            font-size: 1em;
            color: #666;
        }

        .product-card-link {
            display: block;
            color: inherit;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <header>
        <div class="container">
            <h1 class="display-3">TOPZO</h1>
            <p class="lead">Discover Amazing Products - Shop with Confidence</p>
        </div>
    </header>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Shoes</h2>

        <?php
        // Fetch only four records for Shoes category
        $query = "SELECT * FROM products WHERE product_category = 'Shoes' LIMIT 4";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo '<div class="row">';
            while ($row = $result->fetch_assoc()) {
                // Assuming your database column for file path is named 'file_path'
                $fileUrl = $row['file_path'];

                echo '<div class="col-lg-3 col-md-6 mb-4">';
                echo '<a href="product-details.php?product_id=' . $row['product_id'] . '" class="card product-card-link">';
                echo '<div class="card product-card">';
                echo '<img class="card-img-top" src="' . $fileUrl . '" alt="Uploaded Image" style="height: 200px; object-fit: cover;">'; // Specify the fixed height
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['product_title'] . '</h5>';
                echo '<p class="card-text">PKR : ' . $row['regular_price'] . '</p>';
                echo '</div></div></a></div>';
            }
            echo '</div>';
            // Add "See All" button for Shoes category
            echo '<div class="text-center"><a href="shoes.php" class="btn btn-primary">See All Shoes</a></div>';
        } else {
            echo '<p>No products available.</p>';
        }
        ?>
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Jewelry</h2>

        <?php
        // Fetch only four records for Jewelry category
        $query = "SELECT * FROM products WHERE LOWER(product_category) = 'rings' OR LOWER(product_category) = 'necklace' LIMIT 4";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo '<div class="row">';
            while ($row = $result->fetch_assoc()) {
                // Assuming your database column for file path is named 'file_path'
                $fileUrl = $row['file_path'];

                echo '<div class="col-lg-3 col-md-6 mb-4">';
                echo '<a href="product-details.php?product_id=' . $row['product_id'] . '" class="card product-card-link">';
                echo '<div class="card product-card">';
                echo '<img class="card-img-top" src="' . $fileUrl . '" alt="Uploaded Image" style="height: 200px; object-fit: cover;">'; // Specify the fixed height
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['product_title'] . '</h5>';
                echo '<p class="card-text">PKR : ' . $row['regular_price'] . '</p>';
                echo '</div></div></a></div>';
            }
            echo '</div>';
            // Add "See All" button for Jewelry category
            echo '<div class="mb-5 text-center"><a href="jewelry.php" class="btn btn-primary">See All Jewelry</a></div>';
        } else {
            echo '<p>No products available.</p>';
        }

        // Close the database connection here after all queries
        $conn->close();
        ?>
    </div>

    <!-- Footer -->
    <?php include('footer.php'); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
