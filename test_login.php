<?php
require 'function.php';
$username = 'testuser';
$password = 'password123';
$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
$row = mysqli_fetch_assoc($result);
if ($row) {
    echo "User found.<br>";
    echo "DB Hash: " . $row['password'] . "<br>";
    echo "Verify result: " . (password_verify($password, $row['password']) ? 'TRUE' : 'FALSE') . "<br>";
    $newHash = password_hash($password, PASSWORD_DEFAULT);
    echo "New Hash: " . $newHash . "<br>";

    // Fix it automatically if wrong
    if (!password_verify($password, $row['password'])) {
        mysqli_query($conn, "UPDATE user SET password = '$newHash' WHERE username = '$username'");
        echo "Password updated to new hash.<br>";
    }
} else {
    echo "User NOT found.<br>";
    // Create it
    $newHash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO user (username, email, password) VALUES ('$username', 'testuser@example.com', '$newHash')";
    if (mysqli_query($conn, $query)) {
        echo "User created successfully.<br>";
    } else {
        echo "Error creating user: " . mysqli_error($conn) . "<br>";
    }
}
?>