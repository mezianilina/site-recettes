<?php 
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$username = isset($_SESSION['user_id']) ? "Utilisateur #" . $_SESSION['user_id'] : "Invité";
$role = $_SESSION['role'] ?? 'user'; // récupère le rôle, par défaut 'user'

require_once("db.php");

// On récupère les 6 dernières recettes
$sql = "SELECT * FROM recettes ORDER BY date_publication DESC LIMIT 6";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <style>
        /* (Ton CSS inchangé) */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: url('https://static.vecteezy.com/system/resources/previews/008/709/519/large_2x/sweet-shop-logo-design-template-of-cake-with-cherries-free-vector.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            color: #fff;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.7);
        }
        h1 {
            font-size: 2em;
            margin-bottom: 15px;
            text-shadow: 2px 2px 6px rgba(0,0,0,0.4);
        }
        p {
            font-size: 1.1em;
            margin-bottom: 25px;
        }
        a.button {
            display: inline-block;
            padding: 12px 25px;
            background: linear-gradient(145deg, #ff4e50, #f9d423);
            color: #fff;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
            transition: transform 0.3s ease, background 0.3s ease;
            margin-bottom: 30px;
        }
        a.button:hover {
            transform: scale(1.05);
            background: linear-gradient(145deg, #f12711, #f5af19);
        }
        .recette {
            background: rgba(255,255,255,0.15);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            max-width: 600px;
            width: 100%;
            backdrop-filter: blur(10px);
        }
        .recette img {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        .recette h3 {
            margin-bottom: 10px;
        }
        .recette p {
            white-space: pre-line; /* pour garder les retours à la ligne */
        }
    </style>
</head>
<body>

    <h1>Bienvenue sur le site de recettes</h1>
    <p>Connecté en tant que : <strong><?= htmlspecialchars($username) ?></strong></p>

    <a href="logout.php" class="button">Se déconnecter</a>
    <a href="logout.php" class="button logout">🚪 Se déconnecter</a>

    <?php if ($role === 'admin'): ?>
        <a href="admin/ajouter.php" class="button">➕ Ajouter une recette</a>
    <?php endif; ?>

    <div>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="recette">';
                if (!empty($row['image_url'])) {
                    echo '<img src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['titre']) . '">';
                }
                echo '<h3>' . htmlspecialchars($row['titre']) . '</h3>';
                echo '<p><strong>Description :</strong><br>' . nl2br(htmlspecialchars($row['description'])) . '</p>';
                echo '<p><strong>Ingrédients :</strong><br>' . nl2br(htmlspecialchars($row['ingredients'])) . '</p>';
                echo '<p><strong>Instructions :</strong><br>' . nl2br(htmlspecialchars($row['instructions'])) . '</p>';
                echo '</div>';
            }
        } else {
            echo "<p>Aucune recette disponible.</p>";
        }
        ?>
    </div>

</body>
</html>

