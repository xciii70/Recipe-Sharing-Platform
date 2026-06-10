<?php

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: signup.php");
    exit();
}

$username = trim($_POST['username']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if ($password !== $confirm_password) {
    die("Passwords do not match.");
}

$sql = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die("Username already exists.");
}

$stmt->close();

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password)
        VALUES (?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "ss",
    $username,
    $hashed_password
);

if ($stmt->execute()) {
    header("Location: login.php?registered=1");
    exit();
}

echo "Registration failed.";

$stmt->close();
$conn->close();

?>
