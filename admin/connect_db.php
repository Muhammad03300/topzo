<?php

// Database connection parameters
$host = 'localhost';  // e.g., 'localhost' or '127.0.0.1'
$username = 'root';
$password = '';
$database = 'topzo';

// Attempt to connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, you can set character set if needed
$conn->set_charset("utf8");

// If you reach this point, the database connection is successful
// You can include this file in other PHP files where database connectivity is required.

?>
