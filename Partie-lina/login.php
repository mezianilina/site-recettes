<?php
session_start();
require_once("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Prépare la requête pour éviter injection SQL
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $hashed_password, $role);
        $stmt->fetch();

        // Vérifier le mot de passe
        if (password_verify($password, $hashed_password)) {
            // Auth OK : on sauvegarde id et role dans la session
            $_SESSION['user_id'] = $user_id;
            $_SESSION['role'] = $role;
            header("Location: index.php");
            exit;
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Utilisateur non trouvé.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <style>
        /* Ton CSS connexion ici */
    </style>
</head>
<body>
    <h1>Connexion</h1>
    <?php if (!empty($error)) echo '<p style="color:red;">' . htmlspecialchars($error) . '</p>'; ?>
    <form method="POST" action="">
        <label>Email : <input type="email" name="email" required></label><br><br>
        <label>Mot de passe : <input type="password" name="password" required></label><br><br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>

