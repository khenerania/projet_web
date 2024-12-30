<?php
$host = 'localhost'; // ou l'adresse de votre serveur
$db = 'gigashop'; // nom de votre base de données
$user = 'root'; // votre nom d'utilisateur MySQL
$pass = ''; // votre mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>