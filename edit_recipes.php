<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("Recipe ID not found.");
}

$recipe_id = intval($_GET['id']);

$sql = "SELECT * FROM recipes WHERE id = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $recipe_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Recipe not found.");
}

$recipe = $result->fetch_assoc();

$stmt->close();

?>

<!DOCTYPE html>
<html lang="English">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitchenary - Edit Recipe</title>
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
        <h1 class="recipe-form-title">Edit Recipe</h1>
        
        <form action="edit_recipe_action.php?id=<?php echo $recipe['id']; ?>" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>Update Recipe Image</label>
                <input type="file" name="image" accept="image/*">
                <p style="font-size: 12px; color: #666; margin-top: 4px;">* Leave blank if you want to keep the current image.</p>
            </div>
            
            <div class="form-group">
                <label>Recipe Title</label>
                <input type="text" name="title" required 
                       value="<?php echo isset($recipe['title']) ? htmlspecialchars($recipe['title']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" required 
                       value="<?php echo isset($recipe['category']) ? htmlspecialchars($recipe['category']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label>Ingredients</label>
                <textarea name="ingredients" required><?php echo isset($recipe['ingredients']) ? htmlspecialchars($recipe['ingredients']) : ''; ?></textarea>
            </div>
            
            <div class="form-group">
                <label>Instructions</label>
                <textarea name="instructions" required><?php echo isset($recipe['instructions']) ? htmlspecialchars($recipe['instructions']) : ''; ?></textarea>
            </div>
            
            <button type="submit" class="btn-recipe-submit">Save Changes</button>
        </form>
    </div>

</body>
</html>
