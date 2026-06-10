<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "db_connect.php";

$result = $conn->query("SELECT * FROM recipes ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="English">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Home Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

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

<main class="container">
    <h1 class="page-title">Recipes</h1>

    <div class="recipe-grid">

        <?php while ($recipe = $result->fetch_assoc()): ?>
            <div class="recipe-card">
                <a href="recipes_detail.php?id=<?php echo $recipe['id']; ?>">
                    <?php if (!empty($recipe['image'])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($recipe['image']); ?>" class="recipe-image-placeholder">
                    <?php else: ?>
                        <div class="recipe-image-placeholder">🍳</div>
                    <?php endif; ?>
                </a>

                <div class="recipe-content">
                    <h3>
                        <a href="recipes_detail.php?id=<?php echo $recipe['id']; ?>" class="recipe-title">
                            <?php echo htmlspecialchars($recipe['title']); ?>
                        </a>
                    </h3>
                    <p class="recipe-author">
                        Creator: <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </p>
                </div>
            </div>
        <?php endwhile; ?>

    </div>
</main>

<a href="add_recipes.php" class="floating-btn" title="Add New Recipes">+</a>

</body>
</html>
