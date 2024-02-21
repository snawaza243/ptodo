<?php

// include 'includes/config.php'; // Securely store DB credentials
// Check if the admin is already logged in
if (isset($_SESSION["username"])) {
    header("Location: dashboard.php");
    exit();
}


session_start();
// Include your database connection file
require_once 'includes/config.php';

// Retrieve the task ID from the URL query parameter
$task_id = isset($_GET['task_id']) ? $_GET['task_id'] : null;

// Check if task_id is provided
if (!$task_id) {
    echo "Task ID is missing.";
    exit;
}

// Prepare a SQL statement to retrieve task details based on the task ID
$sql = "SELECT * FROM tasks WHERE task_id = ?";
$stmt = $conn->prepare($sql);

// Bind the task ID parameter to the prepared statement
$stmt->bind_param("i", $task_id);

// Execute the prepared statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch the task details as an associative array
$task = $result->fetch_assoc();

// Close the statement
$stmt->close();

// Check if the task exists
if (!$task) {
    echo "Task not found.";
    exit; // or redirect the user to a proper error page
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/view.css">

    <title>Task Details</title>
   
</head>

<body>
    <div class="scroll-container">
        <div class="scroll-wrapper">
            <?php
            include 'includes/header.php';
            ?>
            <main class="custom-margin-3">
                <section>
                    <div class="view-details">
                        <h1>Task Details</h1>
                        <p><strong>Title:</strong> <?= htmlspecialchars($task['title']); ?></p>
                        <p><strong>Description:</strong> <?= htmlspecialchars($task['description']); ?></p>
                        <p><strong>Due Date:</strong> <?= date('Y-m-d', strtotime($task['due_date'])); ?></p>
                        <p><strong>Priority:</strong> <?= $task['priority']; ?></p>
                        <p><strong>Status:</strong> <?= $task['completed'] ? 'Completed' : 'Not Completed'; ?></p>
                        <p><strong>Created At:</strong> <?= date('Y-m-d H:i:s', strtotime($task['created_at'])); ?></p>
                        <a class="btn" href="update_task.php?task_id=<?= $task['task_id']; ?>">Edit Task</a>
                        <a class="btn" href="delete_task.php?task_id=<?= $task['task_id']; ?>" onclick="return confirm('Are you sure you want to delete this task?');">Delete</a>
                    </div>
                </section>
            </main>
            <div class="footer">
                <?php
                include 'includes/footer.php'; // Securely store DB credentials
                ?>
            </div>
        </div>
    </div>
</body>

</html>