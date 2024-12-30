<?php
session_start();
include 'config.php'; // Inclure le fichier contenant la connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Vérification dans la base de données
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ? AND password = ?");
    $stmt->execute([$email, $password]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        $_SESSION['admin'] = $admin['id']; // Stocker l'ID de l'admin dans la session
        header("Location: gestion_produits.php");

        exit();
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>