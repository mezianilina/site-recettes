<?php include("header.php");

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM recettes WHERE id = $id");
$row = mysqli_fetch_assoc($result);
?>

<h2>Modifier la recette</h2>
<a href="../logout.php" class="button logout">🚪 Se déconnecter</a>

<form method="POST" style="max-width: 500px;">
  <input type="text" name="titre" value="<?= $row['titre'] ?>" required><br><br>
  <textarea name="description" required><?= $row['description'] ?></textarea><br><br>
  <textarea name="ingredients" required><?= $row['ingredients'] ?></textarea><br><br>
  <textarea name="instructions" required><?= $row['instructions'] ?></textarea><br><br>
  <input type="text" name="image_url" value="<?= $row['image_url'] ?>"><br><br>
  <button type="submit">Enregistrer</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $image_url = $_POST['image_url'];

    $stmt = $conn->prepare("UPDATE recettes SET titre=?, description=?, ingredients=?, instructions=?, image_url=? WHERE id=?");
    $stmt->bind_param("sssssi", $titre, $description, $ingredients, $instructions, $image_url, $id);
    $stmt->execute();

    echo "<p style='color:green;'>Recette mise à jour.</p>";
}
?>
