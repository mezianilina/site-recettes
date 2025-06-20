<?php
$host = "localhost";
$dbname = "recette_bd"; // Ton nom de base de données
$username = "root";     // Par défaut sur XAMPP
$password = "";         // Par défaut vide sur XAMPP

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
?>