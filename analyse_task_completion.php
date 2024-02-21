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

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// Retrieve completed tasks data by priority
$query_completed_tasks = "SELECT priority, COUNT(*) as count FROM tasks WHERE user_id = $user_id AND completed = 1 GROUP BY priority";
$result_completed_tasks = mysqli_query($conn, $query_completed_tasks);

// Retrieve missed tasks data by priority
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
    <link rel="stylesheet" type="text/css" href="styles/analysis.css">

    <title>Task Completion Analysis</title>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <div class="scroll-container">
        <div class="scroll-wrapper">
            <?php
            include 'includes/header.php';
            ?>
            <main class="custom-margin-3">
                <section class="task-analysis-content">
                    <h1>Task Completion Analysis</h1>
                    <!-- Priority-Based Completion Statistics -->
                    <h3>Priority-Based Completion Statistics</h3>
                    <div id="priorityCompletionChart" style="width: 600px; height: 300px;"></div>
                    <div id="priorityCompletionChart" style="width: 600px; height: 300px;"></div>
                    <div id="priorityCompletionChart" style="width: 600px; height: 300px;"></div>
                    <script>
                        // Load the Google Charts library
                        google.charts.load('current', {
                            'packages': ['corechart']
                        });
                        // Set a callback function to execute when the Google Charts library is loaded
                        google.charts.setOnLoadCallback(drawPriorityCompletionChart);
                        // Function to draw the priority-based completion chart
                        function drawPriorityCompletionChart() {
                            // Create a data table with your PHP data
                            var data = google.visualization.arrayToDataTable([
                                ['Priority', 'Completed Tasks'],
                                <?php
                                while ($row = mysqli_fetch_assoc($result_missed_tasks)) {
                                    echo "['" . $row['priority'] . "', " . $row['count'] . "],";
                                }
                                ?>
                            ]);

                            // Set chart options
                            var options = {
                                title: 'Priority-Based Completion Statistics',
                                legend: {
                                    position: 'top'
                                }
                            };

                            // Instantiate and draw the chart
                            var chart = new google.visualization.ColumnChart(document.getElementById('priorityCompletionChart'));
                            chart.draw(data, options);
                        }
                    </script>
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