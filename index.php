<?php
    include("connect_db.php");
    include('header.php');
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
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

        a,
        a:link,
        a:visited {
            text-decoration: none; 
            color: inherit; 
        }

        a:hover,
        a:active {
            color: inherit; 
        }

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
        .product-card-link:hover {
            display: block;
            text-decoration: none;
            color: inherit;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body>

    <header>
        <div class="container">
            <h1 class="display-3">SHAZON FASHION</h1>
            <p class="lead">Discover Amazing Products - Shop with Confidence</p>
        </div>
    </header>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Shoes</h2>

        <?php
        $query = "SELECT * FROM product WHERE product_category = 'Shoes' LIMIT 4";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo '<div class="row">';
            while ($row = $result->fetch_assoc()) {
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
            echo '<div class="text-center"><a href="shoes.php" class="btn btn-primary">See All Shoes</a></div>';
        } else {
            echo '<p>No products available.</p>';
        }
        ?>
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Jewelry</h2>

        <?php
        $query = "SELECT * FROM product WHERE LOWER(product_category) = 'rings' OR LOWER(product_category) = 'necklace' LIMIT 4";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo '<div class="row">';
            while ($row = $result->fetch_assoc()) {
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
            echo '<div class="mb-5 text-center"><a href="jewelry.php" class="btn btn-primary">See All Jewelry</a></div>';
        } else {
            echo '<p>No products available.</p>';
        }

        $conn->close();
        ?>
    </div>

    <?php include('footer.php'); ?>

</body>

<!-- Bootstrap JS, jQuery, and Popper.js Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>

</html>
