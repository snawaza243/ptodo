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

// Retrieve user ID from session or wherever you store it
$user_id = $_SESSION['user_id']; // Assuming user is logged in and user ID is stored in session

// Retrieve completed tasks data
$query_completed_tasks = "SELECT priority, COUNT(*) as count FROM tasks WHERE user_id = $user_id AND completed = 1 GROUP BY priority";
$result_completed_tasks = mysqli_query($conn, $query_completed_tasks);

// Retrieve missed tasks data
$query_missed_tasks = "SELECT priority, COUNT(*) as count FROM tasks WHERE user_id = $user_id AND completed = 0 AND due_date < CURDATE() GROUP BY priority";
$result_missed_tasks = mysqli_query($conn, $query_missed_tasks);

// Retrieve overall completion data
$query_overall_completion = "SELECT COUNT(*) as total_tasks, SUM(completed) as completed_tasks FROM tasks WHERE user_id = $user_id";
$result_overall_completion = mysqli_query($conn, $query_overall_completion);
$row = mysqli_fetch_assoc($result_overall_completion);
$total_tasks = $row['total_tasks'];
$completed_tasks = $row['completed_tasks'];
$incomplete_tasks = $total_tasks - $completed_tasks;

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Completion Analysis</title>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <h1>Task Completion Analysis</h1>

    <!-- Priority-Based Completion Statistics -->
    <h2>Priority-Based Completion Statistics</h2>
    <canvas id="priorityCompletionChart" width="400" height="200"></canvas>

    <!-- Missed Tasks Statistics -->
    <h2>Missed Tasks Statistics</h2>
    <canvas id="missedTasksChart" width="400" height="200"></canvas>

    <!-- Overall Completion Status -->
    <h2>Overall Completion Status</h2>
    <canvas id="overallCompletionChart" width="400" height="200"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Priority-Based Completion Statistics
        var ctx = document.getElementById('priorityCompletionChart').getContext('2d');
        var priorityCompletionChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($priority_labels); ?>,
                datasets: [{
                    label: 'Completed Tasks',
                    data: <?php echo json_encode($completed_task_counts); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Missed Tasks Statistics
        var ctx2 = document.getElementById('missedTasksChart').getContext('2d');
        var missedTasksChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($priority_labels); ?>,
                datasets: [{
                    label: 'Missed Tasks',
                    data: <?php echo json_encode($missed_task_counts); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            }
        });

        // Overall Completion Status
        var ctx3 = document.getElementById('overallCompletionChart').getContext('2d');
        var overallCompletionChart = new Chart(ctx3, {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'Incomplete'],
                datasets: [{
                    label: 'Overall Completion Status',
                    data: [<?php echo $completed_tasks; ?>, <?php echo $incomplete_tasks; ?>],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            }
        });
    </script>
</body>

</html>