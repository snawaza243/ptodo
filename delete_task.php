<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Check if the task_id is provided in the URL
if (!isset($_GET['task_id'])) {
    // Redirect to the dashboard if task_id is not provided
    header("Location: dashboard.php");
    exit();
}

// Include database connection
require_once "includes/config.php";

// Retrieve task_id from the URL
$task_id = $_GET['task_id'];
$user_id = $_SESSION['user_id'];

// Perform SQL injection prevention
$task_id = mysqli_real_escape_string($conn, $task_id);

// Delete task from the database
$query = "DELETE FROM tasks WHERE task_id = '$task_id' AND user_id = '$user_id'";
if (mysqli_query($conn, $query)) {
    // Task deleted successfully, redirect to the dashboard
    header("Location: dashboard.php");
    exit();
} else {
    $error = "Error: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
