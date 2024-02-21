<?php
// Define the password
$password = "xyz";

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
// Output the hashed password
echo "Hashed Password: " . $hashedPassword;

// Define the hashed password retrieved from the database
$hashedPasswordFromDatabase = 'generatedhashedpass';

echo "\n";
// User input password to verify
$userInputPassword = "sam";

// Verify if the user input password matches the hashed password
if (password_verify($userInputPassword, $hashedPasswordFromDatabase)) {
    echo "Password Matched!";
} else {
    echo "Invalid Password!";
}