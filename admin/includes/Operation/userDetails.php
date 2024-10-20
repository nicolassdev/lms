<?php
session_start(); // Make sure to start the session if using session variables

$servername = "localhost"; // Adjust this as per your setup
$username = "root";
$password = "Nicolas051002";
$dbname = "lms_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if connection was successful
if ($conn->connect_error) {
    die("Connection failed: Database connection is not established.");
}

if (isset($_GET['id'])) {
    $userID = $_GET['id'];

    // Query to get the user details by ID
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);

    // If prepare fails, show error
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the userID as an integer
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any user was found
    if ($result->num_rows > 0) {
        // Fetch user details
        $user = $result->fetch_assoc();

        // Determine user type based on role
        switch ($user['role']) {
            case 'student':
                // Redirect to student page
                header("location:../../index.php?page=student");
                exit();

            case 'teacher':
                // Redirect to teacher page
                header("location:../../index.php?page=teacher");
                exit();

            case 'admin':
                // Redirect to admin page
                header("location:../../index.php?page=admin");
                exit();

            default:
                echo '<p>Unknown user role.</p>';
                exit();
        }
    } else {
        echo '<p>User not found.</p>';
    }
} else {
    echo '<p>No user ID provided.</p>';
}

// Close connection
$conn->close();
