<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: login.php");
    exit();
}

// Inclure la connexion à la base de données
include 'config.php';

// Récupérer les articles du panier
$user_id = $_SESSION['user_id'];
$cart_items = []; // Initialiser le tableau des articles du panier
$total = 0;

// Exemple de requête pour récupérer les articles du panier
$stmt = $pdo->prepare("SELECT ci.*, p.name, p.price FROM cart_items ci JOIN products p ON ci.product_id = p.id WHERE ci.user_id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculer le total
foreach ($cart_items as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .cart-container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
        .cart-item:last-child {
            border-bottom: none;
        }
        .cart-total {
            font-weight: bold;
            margin-top: 20px;
        }
        .empty-cart {
            text-align: center;
            padding: 20px;
            color: #888;
        }
        .continue-shopping {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .continue-shopping:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="cart-container">
        <h1>Mon Panier</h1>
        <?php if (!empty($cart_items)): ?>
            <?php foreach ($cart_items as $item): ?>
                <div class="cart-item">
                    <span><?= htmlspecialchars($item['name']) ?></span>
                    <span><?= number_format($item['price'], 2) ?> €</span>
                    <span><?= $item['quantity'] ?></span>
                    <span><?= number_format($item['price'] * $item['quantity'], 2) ?> €</span>
                </div>
            <?php endforeach; ?>
            <div class="cart-total">
                Total : <?= number_format($total, 2) ?> €
            </div>
        <?php else: ?>
            <div class="empty-cart">Votre panier est vide.</div>
        <?php endif; ?>
        <a href="products.php" class="continue-shopping">Continuer vos achats</a>
    </div>
</body>
</html>