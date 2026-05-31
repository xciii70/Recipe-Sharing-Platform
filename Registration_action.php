<?php

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: signup.php");
    exit();
}

$username = trim($_POST['username']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

/* Check empty fields */
if (empty($username) || empty($password) || empty($confirm_password)) {
    die("Please fill in all fields.");
}

/* Check password match */
if ($password !== $confirm_password) {
    die("Passwords do not match.");
}

/* Check if username already exists */
$sql = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Database error.");
}

$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die("Username already exists.");
}

$stmt->close();

/* Hash password */
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

/* Insert new user */
$sql = "INSERT INTO users (username, password)
        VALUES (?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Database error.");
}

$stmt->bind_param(
    "ss",
    $username,
    $hashed_password
);

if ($stmt->execute()) {

    header("Location: login.php?registered=1");
    exit();

} else {

    die("Registration failed.");

}

$stmt->close();
$conn->close();

?>
