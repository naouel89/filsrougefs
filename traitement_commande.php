<?php

ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
include('connexion_script.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire à l'aide de $_POST
    $adresseClient = $_POST["adresse_client"];
    $total = $_POST["total"];
    $dateCommande = date("Y-m-d H:i:s"); // Date et heure actuelles
    $nomClient = $_POST["nom_client"];
    $telephoneClient = $_POST["telephone_client"];

    // Récupérer l'ID du plat à partir du panier (dans cet exemple, on suppose qu'il y a un seul plat dans le panier)
    if(isset($_SESSION['panier'][0]['id_plat'])){
        $idPlat = $_SESSION['panier'][0]['id_plat'];

        // Préparer la requête SQL pour l'insertion des données dans la table commande
        $sql = "INSERT INTO commande (email_client, id_plat, quantite, adresse_client, total, date_commande, etat, nom_client, telephone_client) VALUES (:email_client, :id_plat, 1, :adresse_client, :total, :date_commande, 'En attente', :nom_client, :telephone_client)";

        // Préparer la requête et l'exécuter
        $requete = $conn->prepare($sql);
        $requete->bindParam(':email_client', $_SESSION["email"]);
        $requete->bindParam(':id_plat', $idPlat);
        $requete->bindParam(':adresse_client', $adresseClient);
        $requete->bindParam(':total', $total);
        $requete->bindParam(':date_commande', $dateCommande);
        $requete->bindParam(':nom_client', $nomClient);
        $requete->bindParam(':telephone_client', $telephoneClient);

        // Exécuter la requête
        if ($requete->execute()) {
            // La commande a été enregistrée avec succès, réinitialisez le panier
            unset($_SESSION['panier']);
            header("Location: confirmation_commande.php"); // Rediriger vers la page de confirmation de commande
            exit();
        } else {
            // Erreur lors de l'insertion des données, rediriger avec un message d'erreur
            $_SESSION['error_message'] = "Erreur lors de l'enregistrement de la commande. Veuillez réessayer.";
            header("Location: panier.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Le panier est vide ou le plat est introuvable.";
        header("Location: panier.php");
        exit();
    }
} else {
    // Si le formulaire n'a pas été soumis correctement, rediriger vers la page de commande avec un message d'erreur
    $_SESSION['error_message'] = "Le formulaire de commande n'a pas été soumis correctement.";
    header("Location: panier.php");
    exit();
}
?>
