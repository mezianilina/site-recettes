<?php include("header.php"); ?>

<h2>Ajouter une nouvelle recette</h2>
<a href="../logout.php" class="button logout">🚪 Se déconnecter</a>


<form method="POST" style="max-width: 500px;">
  <input type="text" name="titre" placeholder="Titre" required><br><br>
  <textarea name="description" placeholder="Description" required></textarea><br><br>
  <textarea name="ingredients" placeholder="Ingrédients" required></textarea><br><br>
  <textarea name="instructions" placeholder="Instructions" required></textarea><br><br>
  <input type="text" name="image_url" placeholder="Lien de l'image (facultatif)"><br><br>
  <button type="submit">Ajouter</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $image_url = $_POST['image_url'];

    $stmt = $conn->prepare("INSERT INTO recettes (titre, description, ingredients, instructions, image_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $titre, $description, $ingredients, $instructions, $image_url);
    $stmt->execute();

    echo "<p style='color:green;'>Recette ajoutée avec succès.</p>";
}
?>
