<?php
session_start();

// Include database connection
require_once "includes/config.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Fetch tasks for the current user
$user_id = $_SESSION['user_id'];

// Set default filter and sorting options
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'none';

// Construct SQL query based on filter and sorting options
$query = "SELECT * FROM tasks WHERE user_id = $user_id";

if ($filter === 'completed') {
    $query .= " AND completed = 1";
} elseif ($filter === 'incomplete') {
    $query .= " AND completed = 0";
}

if ($sort === 'date') {
    $query .= " ORDER BY due_date";
} elseif ($sort === 'priority') {
    $query .= " ORDER BY FIELD(priority, 'High', 'Medium', 'Low')";
}

$result = mysqli_query($conn, $query);

if ($result) {
    $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $error = "Error: " . mysqli_error($conn);
}

$count =
    // Close connection
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/new_task.css">

    <title>Document</title>
</head>

<body>
    <div class="scroll-container">
        <div class="scroll-wrapper">
            <div class="nav">
                <?php include 'includes/header.php'; ?>
            </div>
            <main class="custom-main">

                <section class="new-task">
                    <h2>Add New Task</h2>
                    <form action="create_task.php" method="post">
                        <div class="field">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" required>
                        </div>
                        <div class="field">
                            <label for="description">Description (optional):</label>
                            <textarea name="description" id="description"></textarea>
                        </div>
                        <div class="field field-single">
                            <label for="due_date">Due Date:</label>
                            <input type="date" name="due_date" id="due_date" required>
                        </div>
                        <!-- Add priority input if needed -->
                        <div class="field field-single">
                            <label for="priority">Priority:</label>
                            <select name="priority" id="priority" required>
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>
                        <button type="submit">Add Task</button>
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
</body>

</html>