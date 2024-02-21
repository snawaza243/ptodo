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
    // Retrieve task ID and completion status from the POST data
    $task_id = $_POST['task_id'];
    $completion_status = $_POST['completion_status'];

    // Sanitize input
    $task_id = mysqli_real_escape_string($conn, $task_id);
    $completion_status = mysqli_real_escape_string($conn, $completion_status);

    // Update the task's completion status in the database
    $query = "UPDATE tasks SET completed = '$completion_status' WHERE task_id = '$task_id'";

    if (mysqli_query($conn, $query)) {
        // Task completion status updated successfully
        header("Location: dashboard.php");
        exit();
    } else {
        // Error updating task completion status
        $error = "Error updating task completion status: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
