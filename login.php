<?php

session_start();

if (isset($_SESSION["username"])) {
    header("Location: dashboard.php");
    exit();
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    require_once "includes/config.php";

    // Retrieve username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // SQL injection prevention
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to fetch user from the database
    $query = "SELECT user_id, username, image, password FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            // Verify password
            if (password_verify($password, $row['password'])) {
                // Password is correct, start a new session
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['image'] = $row['image'];

                // Redirect to a secure page
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Incorrect password";
            }
        } else {
            $error = "User not found";
        }
    } else {
        $error = "Error: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/login-signup.css">

    <title>Login</title>
</head>

<body>
    <div class="scroll-container">
        <div class="scroll-wrapper">
            <?php
            include 'includes/header.php';
            ?>
            <main class="custom-main">
                <section>
                    <h2>Login</h2>
                    <?php if (isset($error)) { ?>
                    <p><?php echo $error; ?></p>
                    <?php } ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="field">
                            <label for="username">Username:</label><br>
                            <input type="text" id="username" name="username" required><br>
                        </div>

                        <div class="field">
                            <label for="password">Password:</label><br>
                            <input type="password" id="password" name="password" required><br>
                        </div>
                        <button type="submit">Login</button>
                    </form>
                    <p>Don't have an account? <a href="register.php">Register now.</a></p>
                </section>
            </main>
            <div class="footer">
                <?php
                include 'includes/footer.php';
                ?>
            </div>
        </div>
    </div>
</body>

</html>