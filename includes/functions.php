<?php
// Define database connection credentials
// define('DB_HOST', 'localhost');
// define('DB_USERNAME', 'username');
// define('DB_PASSWORD', 'password');
// define('DB_DATABASE', 'database');

// Function to sanitize user input to prevent SQL injection and XSS attacks
function sanitize_input($data)
{
    // Trim whitespace from the beginning and end of the data
    $data = trim($data);

    // Remove backslashes from the data
    $data = stripslashes($data);

    // Convert special characters to HTML entities
    $data = htmlspecialchars($data);
    
    return $data;
}

// Function to establish a MySQLi database connection
function connect_db()
{
    // Create a new MySQLi connection
    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    // Check if the connection was successful
    if ($conn->connect_error) {
        // If connection fails, display an error message and exit
        die("Connection failed: " . $conn->connect_error);
    }
    // Return the database connection object
    return $conn;
}

// Function to get user data by username
function get_user_by_username($username, $conn)
{
    // Prepare a SQL statement to retrieve user data based on username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    // Bind the username parameter to the statement
    $stmt->bind_param("s", $username);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result set from the executed statement
    $result = $stmt->get_result();

    // Fetch the user data as an associative array
    $user = $result->fetch_assoc();
    // Return the user data
    return $user;
}

// Function to check if a user with the given username or email already exists
function check_existing_user($username, $email, $conn)
{
    // Prepare a SQL statement to check for an existing user by username or email
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    // Bind the username and email parameters to the statement
    $stmt->bind_param("ss", $username, $email);
    // Execute the prepared statement
    $stmt->execute();
    // Get the result set from the executed statement
    $result = $stmt->get_result();
    // Fetch the user data as an associative array
    $existing_user = $result->fetch_assoc();
    // Return the existing user data
    return $existing_user;
}

// Function to create a new task
function create_task($user_id, $title, $description, $due_date, $conn)
{
    // Prepare a SQL statement to insert a new task
    $stmt = $conn->prepare("INSERT INTO tasks (user_id, title, description, due_date) VALUES (?, ?, ?, ?)");
    // Bind parameters to the statement
    $stmt->bind_param("isss", $user_id, $title, $description, $due_date);
    // Execute the prepared statement and return the result
    return $stmt->execute();
}

// Function to read tasks for a given user
function read_tasks($user_id, $conn)
{
    // Prepare a SQL statement to select tasks for the user
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id = ?");

    // Bind the user_id parameter to the statement
    $stmt->bind_param("i", $user_id);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result set from the executed statement
    $result = $stmt->get_result();

    // Fetch all rows from the result set as an associative array
    $tasks = $result->fetch_all(MYSQLI_ASSOC);
    
    // Return the tasks
    return $tasks;
}

// Function to update an existing task
function update_task($task_id, $title, $description, $due_date, $user_id, $conn)
{
    // Prepare a SQL statement to update the task
    $stmt = $conn->prepare("UPDATE tasks SET title = ?, description = ?, due_date = ? WHERE task_id = ? AND user_id = ?");
    // Bind parameters to the statement
    $stmt->bind_param("sssii", $title, $description, $due_date, $task_id, $user_id);
    // Execute the prepared statement and return the result
    return $stmt->execute();
}

// Function to delete a task
function delete_task($task_id, $user_id, $conn)
{
    // Prepare a SQL statement to delete the task
    $stmt = $conn->prepare("DELETE FROM tasks WHERE task_id = ? AND user_id = ?");
    // Bind parameters to the statement
    $stmt->bind_param("ii", $task_id, $user_id);
    // Execute the prepared statement and return the result
    return $stmt->execute();
}
