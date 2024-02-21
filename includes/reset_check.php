<?php
// Function to update failed login attempts
function updateFailedAttempts($conn, $user_id) {
    $query = "UPDATE users SET failed_attempts = failed_attempts + 1 WHERE user_id = $user_id";
    mysqli_query($conn, $query);
}

// Function to reset failed login attempts
function resetFailedAttempts($conn, $user_id) {
    $query = "UPDATE users SET failed_attempts = 0 WHERE user_id = $user_id";
    mysqli_query($conn, $query);
}

// Function to validate a token
function validateToken($conn, $user_id, $token) {
    $query = "SELECT * FROM password_reset WHERE user_id = $user_id AND token = '$token' AND expires_at > NOW()";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

// Function to check if a user is locked out
function isUserLockedOut($conn, $user_id) {
    $query = "SELECT failed_attempts, last_failed_attempt FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $failedAttempts = $row['failed_attempts'];
        $lastFailedAttempt = strtotime($row['last_failed_attempt']);
        $lockoutPeriod = 24 * 60 * 60; // 24 hours in seconds

        if ($failedAttempts >= 5 && time() < $lastFailedAttempt + $lockoutPeriod) {
            return true; // User is locked out
        }
    }
    return false; // User is not locked out
}
?>
