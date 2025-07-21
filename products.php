<?php include "connect_db.php"; 
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your E-commerce Site</title>
    <!-- Bootstrap CSS -->
    <style>
        .card.product-card {
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color:black;
        }
        .card.product-card-link:hover {
            text-decoration: none;
        }
        .card.product-card-link:hover .card.product-card {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div style="text-align: center; mb-5">
            <h1>All Products</h1>
            <h2 style="font-weight: 300;">Discover Amazing Products - Shop with Confidence</h2><br><br><br>
        </div>


        <div class="row">
            <?php
            $query = "SELECT * FROM product";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
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
            } else {
                echo '<div class="col-12"><p class="text-muted">No products available.</p></div>';
            }
            $conn->close();
            ?>
        </div>
    </div>

    <?php include('footer.php'); ?>

</body>
<!-- Bootstrap JS, jQuery, and Popper.js Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>