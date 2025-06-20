<?php
session_start();
include _DIR_ . '/../includes/db.php';

// Vérification connexion utilisateur
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM formations ORDER BY heure DESC");
$formations = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Formations proposées</title>
    <style>
        /* Variables CSS */
        :root {
            --color-pink-light: #ffe6f0;
            --color-pink-dark: #d63384;
            --color-pink-lighter: #ffb3cc;
            --color-bg-opacity: rgba(255, 230, 240, 0.7);
            --border-radius: 12px;
            --font-family: Arial, sans-serif;
        }

        /* Reset box sizing */
        *, *::before, *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: var(--font-family);
            background:
                linear-gradient(var(--color-bg-opacity), var(--color-bg-opacity)),
                url('https://www.grainesdepapilles.com/wp-content/uploads/2020/10/AH20_MAC_ROSE_SABLES_AMB_HD-1.jpeg') no-repeat center center fixed;
            background-size: cover;
            color: var(--color-pink-dark);
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        h1 {
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            text-align: center;
            text-shadow: 2px 2px 6px var(--color-pink-lighter);
            margin-bottom: 30px;
            user-select: none;
        }

        table {
            width: 100%;
            max-width: 1000px;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: 0 8px 25px rgba(255, 179, 204, 0.7);
            overflow: hidden;
        }

        thead tr {
            background-color: var(--color-pink-lighter);
            color: var(--color-pink-dark);
            font-weight: 700;
            user-select: none;
        }

        th, td {
            padding: 14px 18px;
            text-align: left;
            border-bottom: 1px solid #ffd1dc;
        }

        tbody tr:hover {
            background-color: #ffe0f2;
            transition: background-color 0.3s ease;
        }

        a {
            display: inline-block;
            margin: 40px auto 20px auto;
            text-align: center;
            color: var(--color-pink-dark);
            font-weight: 700;
            max-width: 320px;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(255, 179, 204, 0.6);
            background: linear-gradient(135deg, #ff7eb9, #ff65a3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            user-select: none;
        }

        a:hover, a:focus-visible {
            text-decoration: underline;
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(255, 105, 180, 0.8);
            outline-offset: 3px;
        }

        @media (max-width: 720px) {
            body {
                padding: 15px 10px;
            }

            table {
                font-size: 0.9rem;
            }

            th, td {
                padding: 10px 12px;
            }

            a {
                max-width: 100%;
                padding: 10px 20px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

<h1>Formations proposées</h1>

<table role="grid" aria-label="Liste des formations">
    <thead>
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Lieu</th>
            <th scope="col">Date &amp; Heure</th>
            <th scope="col">Prix (€)</th>
            <th scope="col">Durée</th>
            <th scope="col">Professeur</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($formations as $f): ?>
            <tr>
                <td><?= htmlspecialchars($f['titre']) ?></td>
                <td><?= htmlspecialchars($f['lieu']) ?></td>
                <td><?= htmlspecialchars($f['heure']) ?></td>
                <td><?= htmlspecialchars($f['prix']) ?></td>
                <td><?= htmlspecialchars($f['duree']) ?></td>
                <td><?= htmlspecialchars($f['prof']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>



</body>
</html>