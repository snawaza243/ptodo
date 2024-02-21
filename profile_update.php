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
    $image = $_FILES['image'];

    if (empty($image['name'])) {
        // No new image selected, retain the existing image
        $new_image = $user['image'];
    } else {

        // Handle image upload
        $target_dir = "uploads/profile/";
        $old_image = $target_dir . $user_id . "_" . $user['username'] . ".*"; // Pattern to match any file type
        $new_image = $target_dir . $user_id . "_" . $user['username'] . "." . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);


        // Delete the existing image file, if it exists
        array_map('unlink', glob($old_image));


        // Move uploaded file to target directory and rename it
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $new_image)) {
            // Update user information in the database
            $update_query = "UPDATE users SET name = '$name', email = '$email', phone = '$phone', image = '$new_image' WHERE user_id = $user_id";
            $update_result = mysqli_query($conn, $update_query);

            if ($update_result) {
                // // Redirect to profile page after successful update
                header("Location: login.php");

                session_destroy();
                exit();
            } else {
                $error = "Error updating profile: " . mysqli_error($conn);
            }
        } else {
            $error = "Sorry, there was an error uploading your file.";
        }
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
    <!-- <link rel="stylesheet" href="styles/profile.css"> -->
    <link rel="stylesheet" type="text/css" href="styles/update.css">


    <title>Update Profile</title>
</head>

<body>
    <div class="scroll-container">
        <div class="scroll-wrapper">
            <?php
            include 'includes/header.php';
            ?>
            <main class="custom-main">
                <section>
                    <h1>Update Profile</h1>
                    <?php if (isset($error)) { ?>
                        <p><?php echo $error; ?></p>
                    <?php } ?>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" onsubmit="return validateImageFile();">
                        <div class="field">
                            <label for="name">Name:</label><br>
                            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>"><br>
                        </div>

                        <div class="field">
                            <label for="email">Email:</label><br>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"><br>
                        </div>

                        <div class="field">
                            <label for="phone">Phone:</label><br>
                            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>"><br>
                        </div>

                        <div class="field">
                            <div class="profile-update-img">
                                <?php if (!empty($user['image'])) : ?>
                                    <label for="image">Profile Image:</label><br>
                                    <img src="<?php echo htmlspecialchars($user['image']); ?>" alt="Profile Image" style="width: 150px; height: 150px;object-fit: cover; border-radius: 50%;" onchange="updateImagePreview()"><br>
                                <?php endif; ?>

                            </div>
                            <div class="profile-update-img">
                                <label for="image">New Image:</label><br>
                                <input type="file" id="image" name="image"><br>

                            </div>

                        </div>
                        <div class="field">
                            <button type="submit">Update</button>
                            <button type="button" id="cancelButton">Cancel</button>
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
    <script>
        function updateImagePreview() {
            var input = document.getElementById('imageInput');
            var preview = document.getElementById('imagePreview');
            preview.src = URL.createObjectURL(input.files[0]);
        }


        // Function to validate the image file
        function validateImageFile() {
            // Get the file input element
            var fileInput = document.getElementById('image');

            // Get the selected file
            var file = fileInput.files[0];

            // Check if a file is selected
            if (!file) {
                confirm("You have not selected any image .")
            }
            if (file) {
                // Check the file size (in bytes)
                if (file.size > 500000) {
                    alert('Sorry, your file is too large.');
                    return false;
                }

                // Get the file extension
                var fileName = file.name;
                var fileExtension = fileName.split('.').pop().toLowerCase();

                // Check if the file extension is valid
                if (!(fileExtension === 'jpg' || fileExtension === 'jpeg' || fileExtension === 'png' || fileExtension === 'gif')) {
                    alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
                    return false;
                }
            }

            return true;
        }


        document.getElementById('cancelButton').addEventListener('click', function() {
            var confirmCancel = confirm('Do you want to save the changes? Click on Update');
            if (confirmCancel) {
                // Save changes and submit form
                document.getElementById('updateTaskForm').submit();
            } else {
                // Go back to the previous page
                window.history.back();
                window.location = 'profile.php';
            }
        });
    </script>
</body>

</html>
</body>

</html>