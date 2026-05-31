<?php
// Here is for the back end // 
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
