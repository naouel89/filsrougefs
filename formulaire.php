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
include('connexion_script.php');
include('panier.php');
?>

<h1>Formulaire de Commande</h1>

<form action="traitement_commande.php" method="post">
    

    <label for="adresse_client">Adresse du Client:</label>
    <input type="text" id="adresse_client" name="adresse_client" required><br><br>

   <?php
      $_SESSION['total'] = $total_commande;
?>
    <label for="date_commande">Date de la Commande:</label>
    <input type="date" id="date_commande" name="date_commande" required><br><br>

    

    <label for="nom_client">Nom du Client:</label>
    <input type="text" id="nom_client" name="nom_client" required><br><br>

    <label for="telephone_client">Téléphone du Client:</label>
    <input type="text" id="telephone_client" name="telephone_client" required><br><br>

    <input type="submit" value="Valider la Commande">
</form>
<?php


?>

