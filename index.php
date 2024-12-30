<?php
include 'config.php';
// Récupérer les produits de la base de données
$stmt = $pdo->query("SELECT * FROM products");
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
$produits = [];

// Vérifier si le formulaire a été soumis
if (isset($_POST['search'])) {
    $keyword = "%" . $_POST['search'] . "%"; // Préparer le mot-clé pour la recherche
    $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE ?"); // Utiliser LIKE pour la recherche partielle
    $stmt->execute([$keyword]); // Exécuter la requête avec le mot-clé
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupérer les résultats
} else {
    // Si aucune recherche, récupérer tous les produits
    $stmt = $pdo->query("SELECT * FROM products");
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
}



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Une description de la page pour les moteurs de recherche">
    <meta name="author" content="Votre Nom">
    <title>Titre de la Page</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers un fichier CSS externe -->
    <script src="script.js" defer></script> <!-- Lien vers un fichier JavaScript externe -->
    <!-- Inclure Font Awesome via un CDN -->
    <!-- Ajouter Boxicons via CDN -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <!-- Inclure une police Google Fonts -->
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">



</head>
<body>
    <!-- Contenu de la page ici -->
     <header > 
        <a href="#" class="logo" ><h3> Gigashop</h3></a>

        <ul class="navmenu">
            <li><a href="#home" >home</a></li>
            <li><a href="#trending" >produit</a> </li>
            <li><a href="#a propos" > a propos</a></li>
            <li><a href="#contact" >contact</a> </li>
        </ul>

        <div class="nav-icon">
            <a href ="#formeadmin" ><i class='bx bxs-user-circle'><p>Admin</p></i></a>
            <a href ="#formuser" id="userIcon"><i class='bx bxs-user-circle'><p>User</p></i></a>
            <a href="#cart.php"><i class='bx bxs-cart' ></i></a>
            <div class="bx bx-menu" id="menu-icon"></div>

        </div>
     </header>
     <div class="loginAdmin" id="formeadmin">
       <div class="form-box login">
        <h2>Login</h2>
        <form action="loginAdmin.php" method="POST">
            <div class="input-box">
                <span class="icon">
                    <i class='bx bxl-gmail'></i>
                </span>
                <input type="text" id="email" name="email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-box">
                <span class="icon">
                    <i class='bx bxs-lock-alt'></i>
                </span>
                <input type="password" id="password" name="password" required>
                <label for="password">Password</label>
            </div>
            <div class="input-box">
                <span class="icon">
                    <i class='bx bx-user-circle'></i>
                </span>
                <input type="text" id="username" name="username" required>
                <label for="username">Username</label>
            </div>
            <div class="remember-forgot">
                <label>
                    <input type="checkbox"> Remember me
                </label>
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</div>

    <div class="loginUser" id="formuser">
        <div class="form-box login">
          <span class="close-btn">&times;</span> <!-- Bouton de fermeture -->
            <h2>Connexion</h2>
            <form action="loginUser.php" method="POST">
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxl-gmail'></i>
                    </span>
                    <input type="text" id="email" name="email" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-lock-alt'></i>
                    </span>
                    <input type="password" id="password" name="password" required>
                    <label for="password">Mot de passe</label>
                </div>
                <div class="remember-forgot">  Remember me
                    <label>
                        <input type="checkbox"> 
                    </label>
                    <a href="#">Forgot password?</a>
                </div>
                <button type="submit" class="btn">Login</button>
                <div class="register-link">
                    <p>Pas de compte ? <a href="#registerForm" id="showRegisterForm">S'enregistrer</a></p>
                </div>
            </form>
        </div>
    </div>

    <div class="registerUser" id="registerForm" >
        <div class="form-box register">
           <span class="close-btn">&times;</span> <!-- Bouton de fermeture -->
            <h2>Enregistrement</h2>
            <form action="registerUser.php" method="POST">
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxl-gmail'></i>
                    </span>
                    <input type="text" id="reg-email" name="email" required>
                    <label for="reg-email">Email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-lock-alt'></i>
                    </span>
                    <input type="password" id="reg-password" name="password" required>
                    <label for="reg-password">Mot de passe</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bx-user-circle'></i>
                    </span>
                    <input type="text" id="reg-username" name="username" required>
                    <label for="reg-username">Nom d'utilisateur</label>
                </div>
                <button type="submit" class="btn">S'enregistrer</button>
                <div class="login-link">
                    <p>Déjà un compte ? <a href="#formuser" id="showLoginForm">Connexion</a></p>
                </div>
            </form>
        </div>
    </div>


     <section class="main-home">
        <div class="main-text">
            <h5>L'Innovation à portée de main:<br>    Découvrez nos<br>solutions technologiques!!</h5>
            <a href="#trending"  class="cta-button"> Decouvrez nos produits</a>

        </div>
     </section>
     <!--trendimg product-->
     <section class="trending-product" id="trending">
        <div class="center-text">
            <h2>Nos produit Tendances</h2>
        </div>
        <!-- Barre de Recherche --> 
         <div class="search-container">
             <form method="POST" action=""> 
                <input type="text" placeholder="Rechercher..." name="search"> 
                <button type="submit"><i class='bx bx-search'></i></button> 
             </form> 
         </div>
         <?php if (empty($produits)): ?>
            <p>Aucun produit trouvé.</p>
        <?php else: ?>
            <?php foreach ($produits as $produit): ?>
            <div class="produit">
                <div class="row">
                    <img src="<?php echo $produit['image']; ?>" alt="<?php echo $produit['name']; ?>">
                    <div class="produit-text">
                        <h5><?php echo $produit['name']; ?></h5>
                    </div>
                    <div class="heart-icon">
                        <i class='bx bx-heart'></i>
                    </div>
                    <div class="description">
                        <p><?php echo $produit['description']; ?></p>
                    </div>
                    <div class="prix">
                    <h5>Prix: <?php echo $produit['price']; ?> Da</h5>
                    </div>
                    <div class="ratting">
                        <?php for ($i = 0; $i < floor($produit['rating']); $i++): ?>
                            <i class='bx bx-star'></i>
                        <?php endfor; ?>
                        <?php if ($produit['rating'] - floor($produit['rating']) >= 0.5): ?>
                            <i class='bx bxs-star-half'></i>
                        <?php endif; ?>
                        <?php for ($i = 0; $i < 5 - ceil($produit['rating']); $i++): ?>
                            <i class='bx bx-star'></i>
                        <?php endfor; ?>
                    </div>
                    <div class="boutton">
                        <button  class="add-cart">
                            Add Cart
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
     </section>
    
    <script src="java.js"></script>
    
</body>
</html>
