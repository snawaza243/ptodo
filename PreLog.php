<?php

// Check if the admin is already logged in
if (isset($_SESSION["username"])) {
    header("Location: dashboard.php");
    exit();
}

// Error and success handling variables
$errors = [];
$success = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate inputs (you may want to add more validation)
    if (empty($username) || empty($password)) {
        $error = "Please enter both Admin ID and Password.";
    } else {
        // Hash the password (you should use a stronger hashing algorithm in a production environment)

        // $hashedPassword = md5($password);
        $hashedPassword = mysqli_query($connection, "SELECT password FROM users WHERE username = '$username'");

        $userPassVerify = password_verify($userInputPassword, $hashedPasswordFromDatabase);

        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $query);

        if ($userPassVerify) {
            if (mysqli_num_rows($result) == 1) {
                $admin_data = mysqli_fetch_assoc($result);

                // Set admin session
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];

                // Redirect to admin dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                $errors = "Invalid ID or Password.";
            }
        } else {
            $errors = "Database query error: " . mysqli_error($connection);
        }
    }
}
?>