<?php
session_start();
include 'config.php'; // Inclure le fichier contenant la connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Vérification dans la base de données
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->execute([$email, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user'] = $user['id']; // Stocker l'ID de l'admin dans la session
        header("Location: cart.php");

        exit();
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>