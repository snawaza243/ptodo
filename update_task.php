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

// Query to fetch the task details
$query = "SELECT * FROM tasks WHERE task_id = '$task_id' AND user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if ($result) {
    $task = mysqli_fetch_assoc($result);
} else {
    $error = "Error: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/new_task.css">


    <title>Update Task</title>
    <!-- Add your CSS stylesheets here -->
</head>

<body>
    <div class="scroll-container">
        <div class="scroll-wrapper">
            <?php
            include 'includes/header.php';
            ?>
            <main class="custom-main">
                <section>
                    <h2>Update Task</h2>
                    <?php if (isset($error)) { ?>
                        <p><?php echo $error; ?></p>
                    <?php } ?>
                    <!-- Update Task Form -->
                    <form action="process_update_task.php" method="post">
                        <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
                        <div class="field">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
                        </div>
                        <div class="field">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description"><?php echo htmlspecialchars($task['description']); ?></textarea>
                        </div>
                        <div class="field field-single">
                            <label for="due_date">Due Date:</label>
                            <input type="date" name="due_date" id="due_date" value="<?php echo $task['due_date']; ?>" required>
                        </div>
                        <div class="field field-single">
                            <label for="priority">Priority:</label>
                            <select name="priority" id="priority">
                                <option value="High" <?php if ($task['priority'] == 'High') echo 'selected'; ?>>High</option>
                                <option value="Medium" <?php if ($task['priority'] == 'Medium') echo 'selected'; ?>>Medium</option>
                                <option value="Low" <?php if ($task['priority'] == 'Low') echo 'selected'; ?>>Low</option>
                            </select>
                        </div>
                        <div class="field field-single">
                            <label for="completion_status">Completion Status:</label>
                            <select name="completion_status" id="completion_status">
                                <option value="1" <?php if ($task['completed'] == 1) echo 'selected'; ?>>Completed</option>
                                <option value="0" <?php if ($task['completed'] == 0) echo 'selected'; ?>>Not Completed</option>
                            </select>
                        </div>
                        <button type="submit">Update Task</button>
                        <button type="button" id="cancelButton">Cancel</button>
                    </form>

                </section>
            </main>
            <div class="footer">
                <?php
                include 'includes/footer.php'; // Securely store DB credentials
                ?>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('cancelButton').addEventListener('click', function() {
            var confirmCancel = confirm('Do you want to save the changes? Click on Update Task');
            if (confirmCancel) {
                // Save changes and submit form
                document.getElementById('updateTaskForm').submit();
            } else {
                // Go back to the previous page
                window.history.back();
            }
        });
    </script>
</body>

</html>