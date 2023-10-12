<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


// require_once 'panier.php';
// include('connexion_script.php');
// $host = "localhost"; // Remplacez par le nom d'hôte de votre base de données
// $username = "jessus"; // Remplacez par votre nom d'utilisateur
// $password = "1234"; // Remplacez par votre mot de passe
// $dbname = "jessus"; // Remplacez par le nom de votre base de données

// try {
//     $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
//     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("La connexion à la base de données a échoué : " . $e->getMessage());
// }


// // Inclure la bibliothèque PHPMailer
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php';

// function insertDataCommande($db, $id_plat, $quantite, $nom_client, $telephone_client, $email_client, $adresse_client)
// {
//     try {
//         $stmt = $db->prepare("INSERT INTO commande (id_plat, quantite, total, date_commande, etat, nom_client, telephone_client, email_client, adresse_client) 
// VALUES (:id_plat, :quantite, 10, NOW(), 'En attente', :nom_client, :telephone_client, :email_client, :adresse_client)");
        
//         $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
//         $stmt->bindParam(':quantite', $quantite, PDO::PARAM_INT);
//         $stmt->bindParam(':nom_client', $nom_client, PDO::PARAM_STR);
//         $stmt->bindParam(':telephone_client', $telephone_client, PDO::PARAM_STR);
//         $stmt->bindParam(':email_client', $email_client, PDO::PARAM_STR);
//         $stmt->bindParam(':adresse_client', $adresse_client, PDO::PARAM_STR);

//         $stmt->execute();
      
//         exit();
//     } catch (PDOException $e) {
//         // Enregistrez l'erreur dans un fichier de journal ou faites tout autre traitement nécessaire
//         $_SESSION['error_message'] = "Erreur lors de l'enregistrement de la commande. Veuillez réessayer." . $e->getMessage();
//         header("Location: panier.php");
//         exit();
//     }
// }

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     echo "<pre>";
//     var_dump($_SESSION);
//     // Validez et nettoyez les données du formulaire avant de les utiliser
//     $id_plat = intval($_SESSION['panier'][0]['id']);
//     $id_plat = intval($_POST['id_plat']);
//     $quantite = intval($_POST['quantite']);
//     $nom_client = htmlspecialchars($_POST['nom_client']);
//     $telephone_client = htmlspecialchars($_POST['telephone_client']);
//     $email_client = htmlspecialchars($_POST['email_client']);
//     $adresse_client = htmlspecialchars($_POST['adresse_client']);

//     // Appelez la fonction insertDataCommande avec les données validées et la connexion à la base de données
//     insertDataCommande($db, $id_plat, $quantite, $nom_client, $telephoe_client, $email_client, $adresse_client);
// }



// // Créer une instance de PHPMailer
// $mail = new PHPMailer(true);

// try {
//     // Paramètres SMTP pour Gmail
//     $mail->isSMTP();
//     $mail->Host = 'smtp.gmail.com';
//     $mail->Port = 587;
//     $mail->SMTPAuth = true;
//     $mail->SMTPSecure = 'tls';

//     // Votre adresse Gmail et mot de passe
//     $mail->Username = 'distrcitdistrict@gmail.com';
//     $mail->Password = 'ggkp nkjm plmo kpwd';

//     // Destinataire de l'e-mail
//     $mail->setFrom('distrcitdistrict@gmail.com', 'Enzo');
//     $mail->addAddress($email, $nom); // Ajouter l'adresse du destinataire
//     $mail->isHTML(true); // Activer le support HTML

//     // Sujet et corps de l'e-mail
//     $mail->Subject = 'Confirmation de commande';
//     $mail->Body = 'Cher ' . $nom . ',<br><br>';
//     $mail->Body .= 'Votre commande a été enregistrée avec succès. Merci de votre achat !<br><br>';
//     foreach ($_SESSION['panier'] as $plat_id => $quantite) {
//         $plat = getPlatDetailsById($db, $plat_id);

//         if ($plat) {
//             $mail->Body .= 'Nom de l\'article : ' . $plat['libelle'] . '<br>';
//             $mail->Body .= 'Quantité : ' . $quantite . '<br>';
//             $mail->Body .= 'Prix unitaire : $' . $plat['prix'] . '<br>';
//             $mail->Body .= 'Sous-total : $' . ($quantite * $plat['prix']) . '<br><br>';
//         }
//     }
//     $mail->Body .= 'Montant total de la commande : $' . $total . '<br><br>';
//     $mail->Body .= 'Cordialement,<br>Enzo';

//     // Envoyer l'e-mail
//     $mail->send();
//     unset($_SESSION['panier']); // Effacer le panier après l'envoi
//     echo 'E-mail envoyé avec succès !';
//     header("Location: index.php");
//     exit();
// } catch (Exception $e) {
//     echo 'Erreur lors de l\'envoi de l\'e-mail : ' . $e->getMessage();
// }


// Configuration pour afficher les erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure les fichiers nécessaires
require_once 'panier.php';
include('connexion_script.php');

// Informations de la base de données
$host = "localhost";
$username = "jessus";
$password = "1234";
$dbname = "jessus";

// Connexion à la base de données avec PDO
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("La connexion à la base de données a échoué : " . $e->getMessage());
}

// Inclure la bibliothèque PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valider et nettoyer les données du formulaire
    $id_plat = intval($_POST['id_plat']);
    $quantite = intval($_POST['quantite']);
    $nom_client = htmlspecialchars($_POST['nom_client']);
    $telephone_client = htmlspecialchars($_POST['telephone_client']);
    $email_client = htmlspecialchars($_POST['email_client']);
    $adresse_client = htmlspecialchars($_POST['adresse_client']);

    // Appeler la fonction insertDataCommande avec les données validées et la connexion à la base de données
    insertDataCommande($db, $id_plat, $quantite, $nom_client, $telephone_client, $email_client, $adresse_client);
}

// Fonction pour insérer les données de la commande dans la base de données
function insertDataCommande($db, $id_plat, $quantite, $nom_client, $telephone_client, $email_client, $adresse_client)
{
    try {
        // Préparer la requête d'insertion avec des paramètres pour éviter les injections SQL
        $stmt = $db->prepare("INSERT INTO commande (id_plat, quantite, total, date_commande, etat, nom_client, telephone_client, email_client, adresse_client) 
VALUES (:id_plat, :quantite, 10, NOW(), 'En attente', :nom_client, :telephone_client, :email_client, :adresse_client)");

        // Assigner les valeurs aux paramètres de la requête
        $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
        $stmt->bindParam(':quantite', $quantite, PDO::PARAM_INT);
        $stmt->bindParam(':nom_client', $nom_client, PDO::PARAM_STR);
        $stmt->bindParam(':telephone_client', $telephone_client, PDO::PARAM_STR);
        $stmt->bindParam(':email_client', $email_client, PDO::PARAM_STR);
        $stmt->bindParam(':adresse_client', $adresse_client, PDO::PARAM_STR);
     
     
     
        echo "Avant l'insertion dans la base de données"; // ou
        var_dump($_POST); // Vérifiez les valeurs de $_POST
        
        // Exécuter la requête d'insertion
        $stmt->execute();

        // Rediriger vers une page de succès ou effectuer d'autres traitements au besoin
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        // Enregistrer l'erreur dans une variable de session ou la gérer de manière appropriée
        $_SESSION['error_message'] = "Erreur lors de l'enregistrement de la commande. Veuillez réessayer." . $e->getMessage();
        header("Location: panier.php");
        exit();
    }
}



?>


    