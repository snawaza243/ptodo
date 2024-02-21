<?php
include 'includes/config.php';
include 'includes/functions.php';

if (isset($_SESSION["username"])) {
    header("Location: dashboard.php");
    exit();
}


session_start();
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate user input
    $username = sanitize_input($_POST['username']);
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);
    $confirm_password = sanitize_input($_POST['confirm_password']);

    // Perform validations
    if (empty($username)) {
        $errors[] = "Username cannot be empty.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // Check if username or email already exists
    $existing_user = check_existing_user($username, $email, $conn);
    if ($existing_user) {
        if ($existing_user['username'] === $username) {
            $errors[] = "Username already exists.";
        } else {
            $errors[] = "Email already exists.";
        }
    }

    // If no errors, proceed with registration
    if (empty($errors)) {
        // Hash password securely
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute SQL statement using parameterized queries
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $username, $email, $hashed_password);

        if ($stmt->execute()) {
            $success = true;
            header('Location: login.php'); // Redirect to login page
            exit();
        } else {
            $errors[] = "Registration failed. Please try again.";
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/login-signup.css">
    <title>Register - My Todo App</title>
</head>

<body>
    <div class="scroll-container">
        <div class="scroll-wrapper">
            <?php
            include 'includes/header.php';
            ?>
            <main class="custom-main">
                <section>
                    <h2>Register</h2>
                    <?php if ($success) : ?>
                        <p>Registration successful! Please login to continue.</p>
                    <?php else : ?>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <?php if (!empty($errors)) : ?>
                                <ul class="errors">
                                    <?php foreach ($errors as $error) : ?>
                                        <li><?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <div class="field">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                            </div>
                            <div class="field">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                            </div>
                            <div class="field">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password">
                            </div>
                            <div class="field">
                                <label for="confirm_password">Confirm Password:</label>
                                <input type="password" name="confirm_password" id="confirm_password">
                            </div>
                            <button type="submit">Register</button>
                        </form>
                        <p>Already have an account? <a href="login.php">Login now.</a></p>
                    <?php endif; ?>
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