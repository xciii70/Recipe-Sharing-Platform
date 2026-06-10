<?php

include "db_connect.php";

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM recipes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$recipe = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="English">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitchenary - Recipe Details</title>
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
        
        <h1 class="recipe-form-title">Recipe Details</h1>
        
        <div class="form-group">
            <div class="detail-image-wrapper">
                <?php if(!empty($recipe['image'])): ?>
                    <img src="uploads/<?php echo $recipe['image']; ?>" alt="Recipe Image" class="detail-real-image" onerror="this.style.display='none'; document.getElementById('image-placeholder').style.display='flex';">
                <?php endif; ?>
                
                <div id="image-placeholder" class="detail-image-placeholder" style="<?php echo !empty($recipe['image']) ? 'display: none;' : ''; ?>">
                    <span class="placeholder-icon">🍳</span>
                    <span class="placeholder-text">No Image Available</span>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label>Recipe Title</label>
            <input type="text" readonly 
                   value="<?php echo isset($recipe['title']) ? htmlspecialchars($recipe['title']) : 'Untitled Recipe'; ?>">
        </div>
        
        <div class="form-group">
            <label>Category</label>
            <input type="text" readonly 
                   value="<?php echo isset($recipe['category']) ? htmlspecialchars($recipe['category']) : ''; ?>">
        </div>
        
        <div class="form-group">
            <label>Ingredients</label>
            <div class="recipe-detail-text-box"><?php echo isset($recipe['ingredients']) ? htmlspecialchars($recipe['ingredients']) : ''; ?></div>
        </div>
        
        <div class="form-group">
            <label>Instructions</label>
            <div class="recipe-detail-text-box"><?php echo isset($recipe['instructions']) ? htmlspecialchars($recipe['instructions']) : ''; ?></div>
        </div>
        
        <div class="recipe-btn-group">
            <a href="real_edit_page.php?id=<?php echo $recipe['id']; ?>" class="btn-edit">Edit Recipe</a>
            <a href="delete_recipe_action.php?id=<?php echo $recipe['id']; ?>" class="btn-delete" 
               onclick="return confirm('Are you sure you want to delete this recipe? 🥺');">Delete</a>
        </div>
    </div>

</body>
</html>
