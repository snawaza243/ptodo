<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Include database connection
require_once "includes/config.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve task details from the form
    $title = $_POST["title"];
    $description = $_POST["description"];
    $due_date = $_POST["due_date"];
    $user_id = $_SESSION['user_id'];

    // SQL injection prevention
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $due_date = mysqli_real_escape_string($conn, $due_date);

    // Insert task into the database
    $query = "INSERT INTO tasks (user_id, title, description, due_date) 
              VALUES ('$user_id', '$title', '$description', '$due_date')";

    if (mysqli_query($conn, $query)) {
        // Task added successfully, redirect to the dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>
