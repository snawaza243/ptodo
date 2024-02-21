<?php
session_start();

require_once "includes/config.php";

if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Fetch tasks for the current user
$user_id = $_SESSION['user_id'];

// Set default filter and sorting options
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'date';

// Construct SQL query based on filter and sorting options
$query = "SELECT * FROM tasks WHERE user_id = $user_id";

if ($filter === 'completed') {
    $query .= " AND completed = 1";
} elseif ($filter === 'incomplete') {
    $query .= " AND completed = 0";
} elseif ($filter === 'missed') {
    // Filter for missed tasks (due date passed and completion status not completed)
    $query .= " AND due_date < CURDATE() AND completed = 0";
}


if ($sort === 'date') {
    $query .= " ORDER BY due_date";
} elseif ($sort == 'upcoming') {
    $query  .= " AND completed = 0 AND due_date >= CURDATE() ORDER BY due_date ASC";
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
    <title>Dashboard - My Todo App</title>
    <link rel="stylesheet" href="styles/dashboard.css">

    <style>
        .missed {
            background-color: pink;
        }

        .completed {
            background-color: lightgreen;
        }
    </style>
</head>

<body>
    <div class="scroll-container">
        <div class="scroll-wrapper">
            <div class="nav">
                <?php include 'includes/header.php'; ?>
            </div>
            <main class="custom-main-2">
                <center>
                    <h1>Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</h1>
                </center>

                <div class="task-head-func">
                    <a href="new_task.php">Add Task</a>
                    <a href="analyse_task_completion.php">Analysis Status</a>
                    <a href="profile.php">Goto Profile</a>

                </div>
                <hr>

                <section class="task-list">
                    <div class="sort-task-div">
                        <p>Sort Tasks</p>
                        <nav>
                            <select onchange="location = this.value;">
                                <option value="dashboard.php" <?php if (!isset($_GET['filter']) && !isset($_GET['sort'])) echo 'selected'; ?>>All</option>
                                <option value="dashboard.php?filter=completed" <?php if (isset($_GET['filter']) && $_GET['filter'] === 'completed') echo 'selected'; ?>>Completed</option>
                                <option value="dashboard.php?filter=incomplete" <?php if (isset($_GET['filter']) && $_GET['filter'] === 'incomplete') echo 'selected'; ?>>Incomplete</option>
                                <option value="dashboard.php?sort=date" <?php if (isset($_GET['sort']) && $_GET['sort'] === 'date') echo 'selected'; ?>>Sort by Date</option>
                                <option value="dashboard.php?sort=upcoming" <?php if (isset($_GET['sort']) && $_GET['sort'] === 'upcoming') echo 'selected'; ?>>Sort by Upcoming</option>
                                <option value="dashboard.php?sort=priority" <?php if (isset($_GET['sort']) && $_GET['sort'] === 'priority') echo 'selected'; ?>>Sort by Priority</option>
                                <option value="dashboard.php?filter=missed" <?php if (isset($_GET['filter']) && $_GET['filter'] === 'missed') echo 'selected'; ?>>Missed</option>
                            </select>
                        </nav>
                    </div>


                    <h2>Your Tasks</h2>

                    <div style="width: 100%; overflow-x: auto; white-space: nowrap;">
                        <table style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th style="width: fit-content">Task</th>
                                    <th>Due Date</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tasks as $index => $task) : ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td class="table-task-title-desc" onclick="window.location='task_view.php?task_id=<?= $task['task_id']; ?>'">
                                            <h4><?= htmlspecialchars($task['title']); ?></h4>
                                            <p><?= htmlspecialchars($task['description']); ?></p>
                                        </td>

                                        <?php
                                        // Calculate the CSS class based on completion status and due date
                                        $cssClass = '';
                                        $currentDate = date('Y-m-d'); // Current date in YYYY-MM-DD format
                                        $dueDate = $task['due_date']; // Due date fetched from the database

                                        // Extract year, month, and date from the current date
                                        $currentYear = date('Y', strtotime($currentDate));
                                        $currentMonth = date('m', strtotime($currentDate));
                                        $currentDay = date('d', strtotime($currentDate));
                                        // Extract year, month, and date from the due date
                                        $dueYear = date('Y', strtotime($dueDate));
                                        $dueMonth = date('m', strtotime($dueDate));
                                        $dueDay = date('d', strtotime($dueDate));

                                        // Compare due date with current date
                                        if ($task['completed'] == 1) {
                                            $cssClass = 'completed';
                                        } elseif ($dueYear < $currentYear || ($dueYear == $currentYear && $dueMonth < $currentMonth) || ($dueYear == $currentYear && $dueMonth == $currentMonth && $dueDay < $currentDay)) {
                                            // Due date is in the past
                                            $cssClass = 'missed';
                                        } else {
                                            // Due date is in the future
                                            $cssClass = ''; // No CSS class
                                        }
                                        ?>

                                        <td class="<?= $cssClass ?>">

                                            <!-- <td class="<?= ($task['completed'] == 0 && $task['due_date'] < date('Y-m-d')) ? 'missed' : 'completed'; ?>"> -->

                                            <div class="task-due">
                                                <p><?= date('Y-m-d', strtotime($task['due_date'])); ?></p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="task-priority">
                                                <form action="update_task_priority.php" method="post">
                                                    <input type="hidden" name="task_id" value="<?= $task['task_id']; ?>">
                                                    <!-- <label for="priority">Priority:</label> -->
                                                    <select name="priority" id="priority" onchange="this.form.submit()">
                                                        <option value="High" <?php if ($task['priority'] == 'High') echo 'selected'; ?>>High</option>
                                                        <option value="Medium" <?php if ($task['priority'] == 'Medium') echo 'selected'; ?>>Medium</option>
                                                        <option value="Low" <?php if ($task['priority'] == 'Low') echo 'selected'; ?>>Low</option>
                                                    </select>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="task-status">
                                                <form action="update_task_completion.php" method="post">
                                                    <input type="hidden" name="task_id" value="<?= $task['task_id']; ?>">
                                                    <!-- <label for="completion_status">Completion Status:</label> -->
                                                    <select name="completion_status" id="completion_status" onchange="this.form.submit()">
                                                        <option value="1" <?php if ($task['completed'] == 1) echo 'selected'; ?>>Completed</option>
                                                        <option value="0" <?php if ($task['completed'] == 0) echo 'selected'; ?>>Not Completed</option>
                                                    </select>
                                                </form>
                                            </div>
                                        </td>
                                        <td colspan="2">
                                            <div class="task-action">
                                                <a href="update_task.php?task_id=<?= $task['task_id']; ?>">Edit</a>
                                                <a href="delete_task.php?task_id=<?= $task['task_id']; ?>" onclick="return confirm('Are you sure you want to delete this task?');">Delete</a>
                                            </div>
                                        </td>
                                        </td>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
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
    <script src="task_completion.js">

    </script>
</body>

</html>