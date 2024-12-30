<?php
// Démarrer la session
session_start();

// Inclure le fichier de configuration de la base de données
include 'config.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Valider les données
    if (empty($username) || empty($email) || empty($password)) {
        echo "Tous les champs sont requis.";
        exit;
    }

    // Vérifier si l'email ou le nom d'utilisateur existe déjà
    $checkQuery = $pdo->prepare("SELECT * FROM users WHERE email = :email OR username = :username");
    $checkQuery->bindParam(':email', $email);
    $checkQuery->bindParam(':username', $username);
    $checkQuery->execute();

    if ($checkQuery->rowCount() > 0) {
        echo "L'email ou le nom d'utilisateur existe déjà.";
        exit;
    }

    // Hacher le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Préparer la déclaration
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");

    // Lier les paramètres
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
    } else {
        // Récupérer les informations d'erreur
        $errorInfo = $stmt->errorInfo();
        echo "Erreur lors de l'inscription : " . $errorInfo[2]; // Affiche le message d'erreur
    }
}
?>