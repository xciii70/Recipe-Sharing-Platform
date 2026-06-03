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

<!DOCTYPE html>
<html lang="English">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitchenary - Add Recipe</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="recipe-page-body">

    <nav class="navbar">
        <div class="nav-logo">
            <a href="index.php">🍳 Kitchenary</a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php" class="active">Home Page</a></li>
            <li><a href="members.php">Group Members</a></li>
            <li><a href="logout.php" class="btn-logout">Logout</a></li>
        </ul>
    </nav>
    
    <div class="recipe-form-container">
        <h1 class="recipe-form-title">Add New Recipe</h1>
        
        <form action="add_recipe_action.php" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>Recipe Image</label>
                <input type="file" name="image" accept="image/*" required>
            </div>
            
            <div class="form-group">
                <label>Recipe Title</label>
                <input type="text" name="title" required placeholder="Untitled Recipe">
            </div>
            
            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" required placeholder="e.g. Dessert, Breakfast">
            </div>
            
            <div class="form-group">
                <label>Ingredients</label>
                <textarea name="ingredients" required placeholder="What do you need..."></textarea>
            </div>
            
            <div class="form-group">
                <label>Instructions</label>
                <textarea name="instructions" required placeholder="How is it made..."></textarea>
            </div>
            
            <button type="submit" class="btn-recipe-submit">Add Recipe</button>
        </form>
    </div>

</body>
</html>
