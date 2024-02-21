<?php
// include 'includes/config.php'; // Securely store DB credentials
// Check if the admin is already logged in
if (isset($_SESSION["username"])) {
    header("Location: dashboard.php");
    exit();
}


session_start();


include 'send_email.php'; // Securely store DB credentials
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" type="text/css" href="styles/login-signup.css">

</head>

<body>
    <div class="scroll-container">
        <div class="scroll-wrapper">
            <?php
            include 'includes/header.php';
            ?>
            <main class="custom-main">
                <section>
                    <h2>Contact Us</h2>
                    <?php if (isset($error)) { ?>
                        <p><?php echo $error; ?></p>
                    <?php } ?>
                    <form id="contact-form" method="POST" action="send_email.php">
                        <div class="field">

                            <label for="name">Username:</label>
                            <input type="text" name="name" placeholder="Your Name" required>
                            <span class="error"><?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
                        </div>
                        <div class="field">

                            <label for="email">Email ID:</label>
                            <input type="email" name="email" placeholder="Your Email" required>
                            <span class="error"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></span>
                        </div>
                        <div class="field">

                            <label for="message">Message:</label>
                            <textarea class="custom-textarea" name="message" placeholder="Your Message" required></textarea>
                            <span class="error"><?php echo isset($errors['message']) ? $errors['message'] : ''; ?></span>
                        </div>
                        <button type="submit">Send Message</button>
                    </form>

                    <?php if (!http_response_code(403)) : ?>
                        <div id="form-status">
                            <?php echo json_encode(array("message" => "Unauthorized access.")); ?>
                        </div>
                    <?php endif; ?>
                </section>
            </main>
            < <div class="footer">
                <?php
                include 'includes/footer.php'; // Securely store DB credentials
                ?>
        </div>
    </div>
    <script src="js/contact.js"></script>
</body>

</html>