<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/header.css">
    <title>My Todo App - <?= isset($page_title) ? htmlspecialchars($page_title) : ''; ?></title>
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.php">My Todo App</a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <li>
                        <?php if (isset($_SESSION['image'])) : ?>
                            <a href="profile.php">
                                <img class="head-img" src="<?php echo htmlspecialchars($_SESSION['image']); ?>">
                            </a>
                        <?php else : ?>
                            <a href="profile.php">
                                Welcome, <?= htmlspecialchars($_SESSION['username']); ?>
                            </a>
                        <?php endif; ?>

                    </li>
                <?php else : ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>

        </nav>
        <div class="back-button">
            <?php
            include 'includes/back.php';
            ?>
        </div>
    </header>


</body>

</html>