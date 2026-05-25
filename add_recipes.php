<?php

include "db_connect.php";

$title = $_POST['title'];
$category = $_POST['category'];
$ingredients = $_POST['ingredients'];
$instructions = $_POST['instructions'];

$imageName = $_FILES['image']['name'];
$tempName = $_FILES['image']['tmp_name'];

$uploadFolder = "uploads/";

move_uploaded_file($tempName, $uploadFolder . $imageName);

$sql = "INSERT INTO recipes 
(title, category, ingredients, instructions, image_path)
VALUES
('$title', '$category', '$ingredients', '$instructions', '$imageName')";

if ($conn->query($sql) === TRUE) {
    echo "Recipe added successfully!";
} else {
    echo "Error: " . $conn->error;
}

?>
