<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: add_recipes.php");
    exit();
}

$title = $_POST['title'];
$category = $_POST['category'];
$ingredients = $_POST['ingredients'];
$instructions = $_POST['instructions'];

$imageName = "";

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $targetDir = "uploads/";

    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $imageName = time() . "_" . basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . $imageName;

    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
}
$sql = "INSERT INTO recipes (title, category, ingredients, instructions, image)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Database error: " . $conn->error);
}

$stmt->bind_param("sssss", $title, $category, $ingredients, $instructions, $imageName);

if ($stmt->execute()) {
    header("Location: index.php");
    exit();
} else {
    echo "Error adding recipe: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
