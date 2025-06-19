<?php
include 'includes/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    $stmt->execute();

    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: url('https://img.freepik.com/vecteurs-premium/logo-gateau-sucre-aux-cerises-pour-vecteur-conception-modele-patisserie-boulangerie-illustration_732466-208.jpg?w=2000') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .register-form {
            background: rgba(255, 255, 255, 0.85);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 400px;
            backdrop-filter: blur(8px);
            animation: popin 0.8s ease forwards;
        }

        @keyframes popin {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            text-shadow: 1px 1px 0 #fff;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border: none;
            border-radius: 10px;
            background: #f1f1f1;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            background: #e0e0e0;
            box-shadow: 0 0 5px rgba(0, 150, 200, 0.5);
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        input[type="submit"]:hover {
            transform: scale(1.05);
            background: linear-gradient(to right, #ff4b2b, #ff416c);
        }

        .note {
            text-align: center;
            margin-top: 15px;
            font-size: 0.9em;
            color: #555;
        }

        .note a {
            color: #e91e63;
            text-decoration: none;
        }

        .note a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form class="register-form" method="POST">
        <h2>Créer un compte</h2>
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="email" name="email" placeholder="Adresse email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <input type="submit" value="S'inscrire">
        <p class="note">Déjà inscrit ? <a href="login.php">Se connecter</a></p>
    </form>
</body>
</html>
