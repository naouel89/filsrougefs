<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifier si le email est stocké dans la variable de session
if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
} else {
    // Rediriger vers la page de connexion si lemail  n'est pas défini
    header("Location: connexion.php");
    exit();
}

// Inclure les fichiers après les vérifications
include('header.php');
include('navbar.php');
include('connexion_script.php');
  // Afficher l'utilisateur connecté
  echo '<p>Bienvenue, ' . $email . '</p>';

// Vérifier si le panier est vide
if (empty($_SESSION['panier'])) {
    echo "Votre panier est vide.";
} else {
    // Afficher le contenu du panier
    echo "<h1>Détail du Panier</h1>";

     
    // Boucle à travers les éléments du panier
    $total = 0;
    foreach ($_SESSION['panier'] as $plat) {
  
        
        echo $plat['libelle'];
        echo "<p>Prix du plat : " . $plat['prix'] . " €</p>";
         
        $total += $plat['prix'];
    }
    

    // Afficher le prix total
    echo "<p><strong>Prix total : " . $total . " €</strong></p>";

    // Ajouter un bouton de paiement (c'est un exemple simple)
    echo '<form action="process_payment.php" method="POST">';
    echo '<input type="hidden" name="total" value="' . $total . '">';
    echo '<input type="submit" value="Payer">';
    echo '</form>';
}
include ('footer.php');
?>
