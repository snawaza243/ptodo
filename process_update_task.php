<?php
// Include database connection
require_once "includes/config.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $task_id = $_POST['task_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $priority = $_POST['priority'];
    $completion_status = $_POST['completion_status'];

    // Perform SQL injection prevention
    $task_id = mysqli_real_escape_string($conn, $task_id);
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $due_date = mysqli_real_escape_string($conn, $due_date);
    $priority = mysqli_real_escape_string($conn, $priority);
    $completion_status = mysqli_real_escape_string($conn, $completion_status);

    // Query to update the task
    $query = "UPDATE tasks SET title = '$title', description = '$description', due_date = '$due_date', priority = '$priority', completed = '$completion_status' WHERE task_id = '$task_id'";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Task updated successfully
        header("Location: dashboard.php");
        exit();
    } else {
        // Error updating task
        $error = "Error updating task: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
