<!DOCTYPE html>
<html lang="en">
<?php include "header.php"; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Your E-commerce Site</title>
    <!-- Bootstrap CSS Link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .contact-info {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .contact-info p {
            margin-bottom: 15px;
        }

        .contact-info h2 {
            color: #333;
        }

        .contact-info a {
            color: #007bff;
            text-decoration: none;
        }

        @media (max-width: 576px) {
            .contact-info {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="contact-info text-center">
                <h2 class="mb-4"><i class="fas fa-headset"></i> Your Profile</h2>
                <?php
                // Include the database connection file
                include "connect_db.php";
                
                // Fetch data from the 'user' table
                $query = "SELECT * FROM users";
                $result = mysqli_query($conn, $query);
                
                // Display each user's information
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<p><strong>Name:</strong> " . $row['name'] . "</p>";
                    echo "<p><strong>Phone:</strong> " . $row['phone_no'] . "</p>";
                    echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
                }
                
                // Close the database connection
                mysqli_close($conn);
                ?>
                <p><strong><i class="fab fa-whatsapp"></i> WhatsApp:</strong> +1234567890</p>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and jQuery Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Font Awesome Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

</body>
</html>
