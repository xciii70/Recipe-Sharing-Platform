<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "db_connect.php";

if (!isset($_GET['id'])) {
    die("Recipe ID missing.");
}

$recipe_id = intval($_GET['id']);

/* Get image filename first */
$stmt = $conn->prepare("SELECT image FROM recipes WHERE id = ?");
$stmt->bind_param("i", $recipe_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Recipe not found.");
}
$recipe = $result->fetch_assoc();
$stmt->close();

/* Delete image file if it exists */
if (!empty($recipe['image'])) {
    $imagePath = "uploads/" . $recipe['image'];

    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}

/* Delete recipe */
$stmt = $conn->prepare("DELETE FROM recipes WHERE id = ?");
$stmt->bind_param("i", $recipe_id);

if ($stmt->execute()) {

    header("Location: index.php");
    exit();

} else {

    echo "Error deleting recipe.";

}
$stmt->close();
$conn->close();

?>
