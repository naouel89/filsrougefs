<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();


include('connexion_script.php');

function insertDataCommande($db, $id_plat, $quantite, $nom_client, $tel_client, $email_client, $adresse_client)
{
    try {
        $stmt = $db->prepare("INSERT INTO commande (id_plat, quantite, total, date_commande, etat, nom_client, telephone_client, email_client, adresse_client) 
VALUES (:id_plat, :quantite, 10, NOW(), 'En attente', :nom_client, :telephone_client, :email_client, :adresse_client)");
        
        $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
        $stmt->bindParam(':quantite', $quantite, PDO::PARAM_INT);
        $stmt->bindParam(':nom_client', $nom_client, PDO::PARAM_STR);
        $stmt->bindParam(':telephone_client', $tel_client, PDO::PARAM_STR);
        $stmt->bindParam(':email_client', $email_client, PDO::PARAM_STR);
        $stmt->bindParam(':adresse_client', $adresse_client, PDO::PARAM_STR);

        $stmt->execute();
        $_SESSION['panier'] = []; // Réinitialisez le panier après la commande réussie
        header("Location: confirmation_commande.php"); // Redirigez l'utilisateur vers la page de confirmation de commande
        exit();
    } catch (PDOException $e) {
        // Enregistrez l'erreur dans un fichier de journal ou faites tout autre traitement nécessaire
        $_SESSION['error_message'] = "Erreur lors de l'enregistrement de la commande. Veuillez réessayer." . $e->getMessage();
        header("Location: panier.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>";
    var_dump($_SESSION);
    // Validez et nettoyez les données du formulaire avant de les utiliser
    $id_plat = intval($_SESSION['panier'][0]['id']);
    // $id_plat = intval($_POST['id_plat']);
    $quantite = intval($_POST['quantite']);
    $nom_client = htmlspecialchars($_POST['nom_client']);
    $tel_client = htmlspecialchars($_POST['telephone_client']);
    $email_client = htmlspecialchars($_POST['email_client']);
    $adresse_client = htmlspecialchars($_POST['adresse_client']);

    // Appelez la fonction insertDataCommande avec les données validées et la connexion à la base de données
    insertDataCommande($db, $id_plat, $quantite, $nom_client, $tel_client, $email_client, $adresse_client);
}






    ?>