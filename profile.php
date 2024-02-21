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

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/view.css">

    <title>User Profile</title>
</head>

<body>
    <div class="scroll-container">
        <div class="scroll-wrapper">
            <?php
            include 'includes/header.php';
            ?>
            <main class="custom-margin-3">
                <section>
                    <div class="view-details">

                        <h1>User Profile</h1>
                        <?php if (isset($error)) : ?>
                            <p><?php echo $error; ?></p>
                        <?php else : ?>
                        <?php endif; ?>

                        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                        <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
                        <p style="display: flex; justify-content: left;align-items: center;"><strong>Profile Pic:</strong>

                            <?php if (!empty($user['image'])) : ?>

                                <img style="object-fit: cover;" src="<?php echo htmlspecialchars($user['image']); ?>" alt="<?php echo htmlspecialchars($user['name']); ?>">
                            <?php else : ?>
                                <span>No image </span>
                            <?php endif; ?>

                        </p>

                        <a class="btn" href="profile_update.php">Update Profile</a>
                        <a class="btn" href="profile_delete.php?user_id=<?= $user['user_id']; ?>" onclick="return confirm('Are you sure you want to delete your account?');">Delete Profile</a>

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

</body>

</html>
</body>

</html>