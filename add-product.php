<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.php");
    exit();
}
include("connect_db.php");
include('header-seller.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to validate and upload image
function uploadImage($file, $targetDir) {
    $allowedExtensions = ['jpg', 'png', 'svg'];
    $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedExtensions)) {
        $targetFile = $targetDir . uniqid() . '.' . $fileExtension;

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return $targetFile;
        } else {
            return false; // Error in uploading file
        }
    } else {
        return false; // Invalid file type
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productTitle = $_POST["product_title"];
    $productDescription = $_POST["product_description"];
    $productCategory = $_POST["product_category"];
    $googleProductCategory = $_POST["google_product_category"];
    $stockAvailability = $_POST["stock_availability"];
    $regularPrice = $_POST["regular_price"];
    $productCondition = $_POST["product_condition"];
    $manufacturer = $_POST["manufacturer"];
    $mpn = $_POST["mpn"];
    $shipping = $_POST["shipping"];
    $adult = $_POST["adult"];
    $ageGroup = $_POST["age_group"];
    $color = $_POST["color"];
    $gender = $_POST["gender"];
    $size = $_POST["size"];
    $material = $_POST["material"];
    $pattern = $_POST["pattern"];
    $itemGroupId = $_POST["item_group_id"];

    // File upload directory
    $targetDir = "uploads/";

    // Validate and upload image
    if (isset($_FILES["file_path"]) && $_FILES["file_path"]["error"] == 0) {
        $fileUrl = uploadImage($_FILES["file_path"], $targetDir);

        if ($fileUrl) {
            // Use prepared statement to insert product data into the database
            $stmt = $conn->prepare("INSERT INTO product (product_title, product_description, product_category, google_product_category, stock_availability, regular_price, product_condition, manufacturer, mpn, shipping, adult, age_group, color, gender, size, material, pattern, item_group_id, file_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Bind parameters
            $stmt->bind_param("sssisdsssisssssssis", $productTitle, $productDescription, $productCategory, $googleProductCategory, $stockAvailability, $regularPrice, $productCondition, $manufacturer, $mpn, $shipping, $adult, $ageGroup, $color, $gender, $size, $material, $pattern, $itemGroupId, $fileUrl);

            // Execute the statement
            $result = $stmt->execute();

            if ($result) {
                echo '<div class="alert alert-success" role="alert">
                This is a success alert—check it out!
              </div>';
                header("Location: manage-products.php"); // Redirect to manage-products.php after successful insertion
                exit(); // Terminate script execution after redirection
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "Please select a valid image file.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Insert Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }



    h2 {
        text-align: center;
        margin-bottom: 30px;
    }

    label {
        font-weight: bold;
    }

    button {
        background-color: #007bff;
        color: white;
    }
    </style>
</head>
<body>

    <div class="container">
        <h2>Insert Product</h2>

        <form action="add-product.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_title">Product Title:</label>
                <input type="text" class="form-control" id="product_title" name="product_title" required>
            </div>

            <div class="form-group">
                <label for="product_description">Product Description:</label>
                <input type="text" class="form-control" id="product_description" name="product_description" required>
            </div>

            <div class="form-group">
                <label for="product_category">Product Category:</label>
                <input type="text" class="form-control" id="product_category" name="product_category" required>
            </div>

            <div class="form-group">
                <label for="google_product_category">Google Product Category:</label>
                <input type="text" class="form-control" id="google_product_category" name="google_product_category"
                    required>
            </div>

            <div class="form-group">
                <label for="stock_availability">Stock Availability:</label>
                <input type="number" class="form-control" id="stock_availability" name="stock_availability" required>
            </div>

            <div class="form-group">
                <label for="regular_price">Regular Price:</label>
                <input type="number" class="form-control" id="regular_price" name="regular_price" required>
            </div>

            <div class="form-group">
                <label for="product_condition">Product Condition:</label>
                <input type="text" class="form-control" id="product_condition" name="product_condition" required>
            </div>

            <div class="form-group">
                <label for="manufacturer">Manufacturer:</label>
                <input type="text" class="form-control" id="manufacturer" name="manufacturer" required>
            </div>

            <div class="form-group">
                <label for="mpn">MPN:</label>
                <input type="text" class="form-control" id="mpn" name="mpn" required>
            </div>

            <label for="shipping">Shipping:</label>
            <input type="text" class="form-control" id="shipping" name="shipping" required>


            <div class="form-group">
                <label for="adult">Adult:</label>
                <input type="text" class="form-control" id="adult" name="adult" required>
            </div>

            <div class="form-group">
                <label for="age_group">Age Group:</label>
                <input type="text" class="form-control" id="age_group" name="age_group" required>
            </div>

            <div class="form-group">
                <label for="color">Color:</label>
                <input type="text" class="form-control" id="color" name="color" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <input type="text" class="form-control" id="gender" name="gender" required>
            </div>

            <div class="form-group">
                <label for="size">Size:</label>
                <input type="text" class="form-control" id="size" name="size" required>
            </div>

            <div class="form-group">
                <label for="material">Material:</label>
                <input type="text" class="form-control" id="material" name="material" required>
            </div>

            <div class="form-group">
                <label for="pattern">Pattern:</label>
                <input type="text" class="form-control" id="pattern" name="pattern" required>
            </div>

            <div class="form-group">
                <label for="item_group_id">Item Group ID:</label>
                <input type="number" class="form-control" id="item_group_id" name="item_group_id" required>
            </div>

            <div class="form-group">
                <label for="file_path">File Path:</label>
                <input type="file" class="form-control-file" id="file_path" name="file_path">
            </div>

            <button type="submit" class="btn btn-primary">Insert Product</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>