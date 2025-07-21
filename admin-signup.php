<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Signup Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .signup-container {
            max-width: 400px;
            margin: auto;
            margin-top: 50px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
        }

        .signup-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .signup-container form {
            margin-top: 20px;
        }

        .signup-container button {
            width: 100%;
        }
    </style>
</head>

<body>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include your database connection file
        include('connect_db.php');

        // Get admin input
        $username = $_POST['username'];
        $password = $_POST['password']; // Note: We'll hash this for security
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert admin data into the 'admin' table
        $query = "INSERT INTO admin (name, password, number, email) VALUES ('$username', '$hashedPassword', '$phoneNumber', '$email')";

        if ($conn->query($query)) {
            echo '<div class="alert alert-success" role="alert">Registration successful! Please <a href="admin-login.php">sign in</a>.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
        }

        // Close the database connection
        $conn->close();
    }
    ?>

    <div class="container signup-container">
        <h2>Admin Sign Up</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm password" required>
            </div>
            <div class="form-group">
                <label for="phoneNumber">Phone Number</label>
                <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter phone number" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>

        <div class="signin-link" style="text-align: center">
            <p>Already Registered? <a href="admin-login.php">Sign in</a></p>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
