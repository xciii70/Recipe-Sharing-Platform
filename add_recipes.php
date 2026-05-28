<?php

$conn = new mysqli("localhost", "root", "", "recipe_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
$sql = "INSERT INTO recipes 
(title, category, ingredients, instructions, image)
VALUES
('$title', '$category', '$ingredients', '$instructions', '$imageName')";

if ($conn->query($sql) === TRUE) {
    echo "Recipe added successfully!";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();

?>
