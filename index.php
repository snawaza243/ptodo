<?php
if (isset($_SESSION["username"])) {
    header("Location: dashboard.php");
    exit();
}


session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/index.css">
    <title>My Todo App</title>
</head>

<body>
    <div class="scroll-container">
        <div class="scroll-wrapper">
            <main>
                <div class="nav">
                    <?php
                    include 'includes/header.php';
                    ?>
                </div>
                <section class="hero">
                    <h1>Make your life easier with My Todo App</h1>
                    <p>Get organized, manage your tasks efficiently, and achieve your goals!</p>
                </section>
                <section class="features">
                    <h2>Key Features</h2>
                    <ul>
                        <li>Create and manage your to-do lists.</li>
                        <li>Set due dates and priorities for tasks.</li>
                        <li>Mark tasks as completed and track your progress.</li>
                        <li>Securely access and manage your data (when logged in).</li>
                    </ul>
                </section>
                <section class="demo">
                    <h2>See it in action!</h2>
                </section>
                <section class="cta">
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>
                    <p>Learn more about the app...</p>
                    <p><a href="contact.php">Contact</a> us for support...</p>
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