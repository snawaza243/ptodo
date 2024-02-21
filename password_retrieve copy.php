<?php
session_start();

// Include database connection
require_once "includes/config.php";


$receivedPass = [];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['retrieve'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];

    // Query to retrieve user data based on provided information
    $query = "SELECT * FROM users WHERE (email = '$email' AND username = '$username') 
                OR (email = '$email' AND phone = '$phone') 
                OR (username = '$username' AND phone = '$phone')";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $password = $user['password']; // Assuming password is stored in plain text (not recommended)
        echo "Your password is: $password";
    } else {
        echo "Invalid information provided.";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/login-signup.css">
    <title>Password Retrieval</title>

</head>

<body>
    <div class="scroll-container">
        <div class="scroll-wrapper">
            <?php
            include 'includes/header.php';
            ?>
            <main class="custom-main">
                <section>

                    <h2>Password Retrieval</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <label for="email">Email:</label><br>
                        <input type="email" id="email" name="email" required><br><br>

                        <label for="username">Username:</label><br>
                        <input type="text" id="username" name="username" required><br><br>

                        <label for="phone">Phone Number:</label><br>
                        <input type="text" id="phone" name="phone" required><br><br>

                        <button type="submit" name="retrieve">Retrieve Password</button>
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