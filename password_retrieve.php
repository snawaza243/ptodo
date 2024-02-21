<?php
// Include database connection and functions
require_once "includes/config.php";
require_once "includes/reset_check.php";


// Define constants for maximum attempts and lockout duration
define('MAX_ATTEMPTS', 5);
define('LOCKOUT_DURATION', 24 * 60 * 60); // 24 hours in seconds

// Initialize variables
$error = '';
$success = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];

    // Check if the token key is set in the $_POST array
    if (isset($_POST['token'])) {
        $token = $_POST['token'];
    } else {
        // Handle the case where the token key is not set
        $token = ''; // Set a default value or handle the error accordingly
    }

    // Check if the new_password key is set in the $_POST array
    if (isset($_POST['new_password'])) {
        $newPassword = $_POST['new_password'];
    } else {
        // Handle the case where the new_password key is not set
        $newPassword = ''; // Set a default value or handle the error accordingly
    }


    // Validate user input (you may want to add more validation)
    if (empty($email) || empty($phone) || empty($token) || empty($new_password)) {
        $error = "All fields are required.";
    } else {
        // Check if the user exists in the database
        $query = "SELECT * FROM users WHERE email = '$email' AND phone = '$phone'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $user_id = $user['user_id'];

            // Check if the user is locked out
            if (!isUserLockedOut($conn, $user_id)) {
                // Validate the token
                if (validateToken($conn, $user_id, $token)) {
                    // Token is valid, update the password
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $update_query = "UPDATE users SET password = '$hashed_password' WHERE user_id = $user_id";
                    $update_result = mysqli_query($conn, $update_query);

                    if ($update_result) {
                        $success = "Password updated successfully.";
                        // Reset failed attempts count
                        resetFailedAttempts($conn, $user_id);
                        // Redirect to login page or any other page
                    } else {
                        $error = "Error updating password.";
                    }
                } else {
                    // Token is invalid, update failed attempts count
                    updateFailedAttempts($conn, $user_id);
                    $error = "Invalid token.";
                }
            } else {
                $error = "You have exceeded the maximum number of attempts. Please try again later.";
            }
        } else {
            $error = "User not found.";
        }
    }
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/login-signup.css">

    <title>Password Reset</title>
</head>

<body>
    <div class="scroll-container">
        <div class="scroll-wrapper">
            <?php
            include 'includes/header.php';
            ?>
            <main class="custom-main">
                <section>
                    <h2>Password Reset</h2>
                    <?php if (!empty($error)) : ?>
                        <p style="color: red;"><?php echo $error; ?></p>
                    <?php endif; ?>
                    <?php if (!empty($success)) : ?>
                        <p style="color: green;"><?php echo $success; ?></p>
                    <?php endif; ?>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                        <div class="field">
                            <label for="text">Username:</label>
                            <input type="text" id="username" name="username" required>
                        </div>
                        <div class="field">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="field">
                            <label for="phone">Phone:</label>
                            <input type="text" id="phone" name="phone" required>
                        </div>
                        <div class="field">
                            <label for="token">Token:</label>
                            <input type="text" id="token" name="token" required>
                        </div>
                        <div class="field">
                            <label for="new_password">New Password:</label>
                            <input type="password" id="new_password" name="new_password" required>
                        </div>
                        <div class="field">
                            <button type="submit">Reset Password</button>
                        </div>
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
</body>

</html>