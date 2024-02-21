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

// Fetch user information
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    $error = "Error: User not found.";
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form input
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Update user information in the database
    $update_query = "UPDATE users SET name = '$name', email = '$email', phone = '$phone' WHERE user_id = $user_id";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        // Redirect to profile page after successful update
        header("Location: profile.php");
        exit();
    } else {
        $error = "Error updating profile: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
</head>

<body>
    <h1>Update Profile</h1>
    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php else : ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>"><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"><br>

            <label for="phone">Phone:</label><br>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>"><br>

            <input type="submit" value="Update">
        </form>
    <?php endif; ?>
</body>

</html>
