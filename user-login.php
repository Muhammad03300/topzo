<?php
include "header.php";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    include('connect_db.php');

    // Get user input
    $contactNumber = $_POST['contactNumber'];
    $password = $_POST['password'];

    // Check if the user exists
    $query = "SELECT * FROM user WHERE phone_no = '$contactNumber'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the hashed password
        if (password_verify($password, $row['password'])) {
            // Start a session and store user's name
            $_SESSION['user_name'] = $row['name'];

            // Redirect to home.php
            header("Location: home.php");
            exit();
        } else {
            $errorMessage = '<div class="alert alert-danger" role="alert">Invalid password. Please try again.</div>';
        }
    } else {
        $errorMessage = '<div class="alert alert-danger" role="alert">User not found. Please sign up.</div>';
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            margin: auto;
            margin-top: 100px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-container form {
            margin-top: 20px;
        }

        .login-container button {
            width: 100%;
        }

        .signup-link {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <div class="container login-container">
        <h2>Login</h2>
        <?php if(isset($errorMessage)) echo $errorMessage; ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="contactNumber">Contact Number</label>
                <input type="tel" class="form-control" id="contactNumber" name="contactNumber"
                    placeholder="Enter contact number" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <div class="signup-link">
            <p>If not registered, <a href="user-signup.php">Sign Up</a></p>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
