<?php 
session_start();

// Redirection si non connecté ou mauvais rôle
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil Utilisateur</title>
    <style>
        body {
            /* Image pâtisserie en arrière-plan */
            background: url('https://cache.magazine-avantages.fr/data/photo/w1000_ci/68/astuces-pa-tisserie-pour-de-butants-de-corer-ses-desserts.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: white;
            text-shadow: 0 0 8px rgba(0,0,0,0.7);
        }

        .container {
            background: rgba(255, 255, 255, 0.15);
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(255, 105, 180, 0.6);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        h1 {
            color: #ffd1e8;
            margin-bottom: 30px;
            text-shadow: 0 0 12px #d63384;
        }

        a.button {
            display: inline-block;
            margin: 15px;
            padding: 15px 30px;
            background-color: rgba(255, 105, 180, 0.85);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(255, 105, 180, 0.8);
        }

        a.button:hover {
            background-color: rgba(224, 85, 158, 0.9);
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(224, 85, 158, 0.9);
        }

        .logout {
            margin-top: 25px;
        }

        .logout a {
            font-size: 0.9em;
            color: #ffd1e8;
            text-decoration: none;
            text-shadow: 0 0 8px rgba(0,0,0,0.7);
        }

        .logout a:hover {
            color: #ff69b4;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenue 👋 Utilisateur</h1>
        <a class="button" href="dashboard.php">🍰 Voir les Recettes</a>
        <a class="button" href="formation.php">📚 Voir les Formations</a>

        <div class="logout">
            <a href="../logout.php">🔓 Se déconnecter</a>
        </div>
    </div>
</body>
</html>
