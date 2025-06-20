<?php include("header.php"); ?>

<h2>Liste des recettes</h2>
<a href="../logout.php" class="button logout">🚪 Se déconnecter</a>


<?php
$result = mysqli_query($conn, "SELECT * FROM recettes ORDER BY id DESC");
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div style='margin-bottom:15px;'>";
    echo "<h3>" . htmlspecialchars($row['titre']) . "</h3>";
    echo "<a href='modifier.php?id=" . $row['id'] . "'>Modifier</a> | ";
    echo "<a href='supprimer.php?id=" . $row['id'] . "' onclick=\"return confirm('Supprimer ?');\">Supprimer</a>";
    echo "</div><hr>";
}
?>
