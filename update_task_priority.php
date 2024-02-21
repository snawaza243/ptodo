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

// Check if the form is submitted via POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve task ID and priority from the POST data
    $task_id = $_POST['task_id'];
    $priority = $_POST['priority'];

    // Sanitize input
    $task_id = mysqli_real_escape_string($conn, $task_id);
    $priority = mysqli_real_escape_string($conn, $priority);

    // Update the task's priority in the database
    $query = "UPDATE tasks SET priority = '$priority' WHERE task_id = '$task_id'";

    if (mysqli_query($conn, $query)) {
        // Task priority updated successfully
        header("Location: dashboard.php");
        exit();
    } else {
        // Error updating task priority
        $error = "Error updating task priority: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
