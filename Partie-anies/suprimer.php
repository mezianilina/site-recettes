<?php
include("header.php");

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM recettes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: dashboard.php");
exit();
?>
