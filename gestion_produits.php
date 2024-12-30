<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php'; // Inclure le fichier de configuration pour la connexion à la base de données

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin'])) {
    header("Location: index.php"); // Rediriger vers la page de connexion si non authentifié
    exit();
}

// Ajouter un produit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $image = trim($_POST['image']); // Assurez-vous d'avoir un champ pour l'image

    // Insertion dans la base de données
    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price, $image]);
    header("Location: gestion_produits.php"); // Rediriger vers la même page
    exit();
}

// Supprimer un produit
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    if (!$stmt->execute([$id])) {
        echo "Erreur SQL : " . implode(", ", $stmt->errorInfo());
    }
    header("Location: gestion_produits.php"); // Rediriger vers la même page
    exit();
}

// Modifier un produit
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Mettre à jour un produit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_product'])) {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $image = trim($_POST['image']);

    $stmt = $pdo->prepare("UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $description, $price, $image, $id]);
    header("Location: gestion_produits.php"); // Rediriger vers la même page
    exit();
}

// Récupérer tous les produits
$stmt = $pdo->query("SELECT * FROM products");
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Produits</title>
    <link rel="stylesheet" href="style1.css">
    
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="java.js" ></script> 
    
</head>
<body>
    <h1 id="main-title">Gestion des Produits</h1>


    <!-- Liste des produits -->
    <h2 id="product-list-title">Liste des Produits</h2>
    <table id="product-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Image</th>
                <th>Actions</th>
                <th>Actions</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit): ?>
            <tr>
                <td><?php echo $produit['id']; ?></td>
                <td><?php echo htmlspecialchars($produit['name']); ?></td>
                <td><?php echo htmlspecialchars($produit['description']); ?></td>
                <td><?php echo htmlspecialchars($produit['price']); ?> </td>
                <td>
                    <img src="<?php echo htmlspecialchars($produit['image']); ?>" alt="<?php echo htmlspecialchars($produit['name']); ?>" style="width: 100px;">
                </td>
                <td>
                      <form action="" method="GET" style="display:inline;">
                              <input type="hidden" name="edit" value="<?php echo $produit['id']; ?>">
                               <button type="submit" class="action-button"><i class="fas fa-edit"></i> Modifier</button>
                         </form>
                </td>
                <td>
                      <form action="" method="GET" style="display:inline;">
                           <input type="hidden" name="delete" value="<?php echo $produit['id']; ?>">
                             <button type="submit" class="action-button" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                              <i class="fas fa-trash"></i> Supprimer
                             </button>
                      </form>
              </td>
              <td>
                   <button class="action-button" onclick="document.getElementById('add-product-form').style.display='block'; document.getElementById('add-product-title').style.display='block';">
                   <i class="fas fa-plus"></i> Ajouter
                  </button> 
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
     <!-- Formulaire pour ajouter un produit -->

<h2 id="add-product-title" style="display:none;">Ajouter un Produit</h2>
    <form id="add-product-form" method="POST" action="" style="display:none;">
        <input type="text" name="name" placeholder="Nom" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="number" name="price" placeholder="Prix" required>
        <input type="text" name="image" placeholder="URL de l'image" required>
        <button type="submit" name="add_product">Ajouter</button>
    </form>



<!--formulaire de modifier-->
    <?php if (isset($product)): ?>
        <h2 id="edit-product-title">Modifier le Produit</h2>
        <form id="edit-product-form" method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            <input type="number" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
            <input type="text" name="image" value="<?php echo htmlspecialchars($product['image']); ?>" required>
            <button type="submit" name="update_product">Mettre à jour</button>
        </form>
    <?php endif; ?>

 </body>
</html>
