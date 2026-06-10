<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("Recipe ID not found.");
}

$recipe_id = intval($_GET['id']);

$title = $_POST['title'];
$category = $_POST['category'];
$ingredients = $_POST['ingredients'];
$instructions = $_POST['instructions'];

$stmt = $conn->prepare("SELECT image FROM recipes WHERE id = ?");
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Recipe not found.");
}
$currentRecipe = $result->fetch_assoc();
$imageName = $currentRecipe['image'];
$stmt->close();

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $targetDir = "uploads/";

    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $imageName = time() . "_" . basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . $imageName;

    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
}

$sql = "UPDATE recipes
        SET title = ?, category = ?, ingredients = ?, instructions = ?, image = ?
        WHERE id = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sssssi", $title, $category, $ingredients, $instructions, $imageName, $recipe_id);

if ($stmt->execute()) {
    header("Location: recipes_detail.php?id=" . $recipe_id);
    exit();
} else {
    echo "Update failed: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
