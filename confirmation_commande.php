<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Commande</title>
    <!-- Ajoutez ici vos liens vers les fichiers CSS, Bootstrap, etc. -->
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        .btn-primary {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1>Confirmation de Commande</h1>
        <p>Merci pour votre commande ! Votre commande a été enregistrée avec succès.</p>
        <p>Un e-mail de confirmation a été envoyé à votre adresse e-mail.</p>
       
        <!-- Ajoutez ici d'autres détails de la commande si nécessaire -->
        <a href="index.php" class="btn btn-primary">Retourner à l'accueil</a>
    </div>
</body>

</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure le fichier de connexion à la base de données
$servername = "localhost";
$username = "jessus";
$password = "1234";
$dbname = "jessus";

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("La connexion à la base de données a échoué : " . $e->getMessage());
}

require_once 'panier.php';

// Inclure la bibliothèque PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Récupérer les données du formulaire
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$adresse = $_POST['adresse'];
$articles = json_encode($_SESSION['panier']); // Convertir le panier en JSON
$montant_total = isset($_SESSION['total']) ? $_SESSION['total'] : 0;

// Créer une instance de PHPMailer
$mail = new PHPMailer(true);

try {
    // Paramètres SMTP pour Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';

    // Votre adresse Gmail et mot de passe
    $mail->Username = 'districtdistrict@gmail.com';
    $mail->Password = 'ggkp nkjm plmo kpwd';

    // Destinataire de l'e-mail
    $mail->setFrom('districtdistrict@gmail.com', 'natha');
    $mail->addAddress($email); // Ajouter l'adresse du destinataire
    $mail->isHTML(true); // Activer le support HTML

    // Sujet et corps de l'e-mail
    $mail->Subject = 'Confirmation de commande';
    $mail->Body = 'Cher ' . $email . ',<br><br>';
    $mail->Body .= 'Votre commande a été enregistrée avec succès. Merci de votre achat !<br><br>';
    foreach ($_SESSION['panier'] as $plat_id => $quantite) {
        $plat = getPlatDetailsById($db, $plat_id);

        if ($plat) {
            $mail->Body .= 'Nom de l\'article : ' . $plat['libelle'] . '<br>';
            $mail->Body .= 'Quantité : ' . $quantite . '<br>';
            $mail->Body .= 'Prix unitaire : $' . $plat['prix'] . '<br>';
            $mail->Body .= 'Sous-total : $' . ($quantite * $plat['prix']) . '<br><br>';
        }
    }
    $mail->Body .= 'Montant total de la commande : $' . $montant_total . '<br><br>';
    $mail->Body .= 'Cordialement,<br>natha';

    // Envoyer l'e-mail
    $mail->send();
    unset($_SESSION['panier']); // Effacer le panier après l'envoi
} catch (Exception $e) {
    echo 'Erreur lors de l\'envoi de l\'e-mail : ' . $e->getMessage();
}
?>
