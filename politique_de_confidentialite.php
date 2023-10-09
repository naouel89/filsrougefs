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
require 'DAO.php';


?>



    <div class="container privacy-policy-container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">Politique de Confidentialité</h1>
                        
<p>
A. Collecte de l’information
</p>
<p>Nous recueillons des informations lorsque vous vous inscrivez sur notre site, lorsque vous vous connectez à votre compte, faites un achat, participez à un concours, et / ou lorsque vous vous déconnectez. Les informations recueillies incluent votre nom, votre adresse e-mail, numéro de téléphone, et / ou carte de crédit.
<p>B. Utilisation des informations
</p>
<p>Toutes les informations que nous recueillons auprès de vous peuvent être utilisées pour :
    </p>
    <p> Personnaliser votre expérience et répondre à vos besoins individuels
    Fournir un contenu publicitaire personnalisé
    Améliorer notre site
    Améliorer le service client et vos besoins de prise en charge
    Vous contacter par e-mail
    Administrer un concours, une promotion, ou une enquête
    </p>
    <p>C. Confidentialité du commerce en ligne
</p>
<p>Nous sommes les seuls propriétaires des informations recueillies sur ce site. Vos informations personnelles ne seront pas vendues, échangées, transférées, ou données à une autre société pour n’importe quelle raison, sans votre consentement, en dehors de ce qui est nécessaire pour répondre à une demande et / ou une transaction, comme par exemple pour expédier une commande.
<p>D. Divulgation à des tiers
</p>
<p>Nous ne vendons, n’échangeons et ne transférons pas vos informations personnelles identifiables à des tiers. Cela ne comprend pas les tierce parties de confiance qui nous aident à exploiter notre site Web ou à mener nos affaires, tant que ces parties conviennent de garder ces informations confidentielles. Nous pensons qu’il est nécessaire de partager des informations afin d’enquêter, de prévenir ou de prendre des mesures concernant des activités illégales, fraudes présumées, situations impliquant des menaces potentielles à la sécurité physique de toute personne, violations de nos conditions d’utilisation, ou quand la loi nous y contraint. Les informations non-privées, cependant, peuvent être fournies à d’autres parties pour le marketing, la publicité, ou d’autres utilisations.
</p>
<p>
E. Protection des informations
</p>
<p>
Nous mettons en œuvre une variété de mesures de sécurité pour préserver la sécurité de vos informations personnelles. Nous utilisons un cryptage à la pointe de la technologie pour protéger les informations sensibles transmises en ligne. Nous protégeons également vos informations hors ligne. Seuls les employés qui ont besoin d’effectuer un travail spécifique (par exemple, la facturation ou le service à la clientèle) ont accès aux informations personnelles identifiables. Les ordinateurs et serveurs utilisés pour stocker des informations personnelles identifiables sont conservés dans un environnement sécurisé.
</p>
<p>
F. Se désabonner</p>
<p>
Nous utilisons l’adresse e-mail que vous fournissez pour vous envoyer des informations et mises à jour relatives à votre commande, des nouvelles de l’entreprise de façon occasionnelle, des informations sur des produits liés, etc. Si à n’importe quel moment vous souhaitez vous désinscrire et ne plus recevoir d’e-mails, des instructions de désabonnement détaillées sont incluses en bas de chaque e-mail.
</p>
<p>
G. Consentement</p>
<p>
En utilisant notre site, vous consentez à notre politique de confidentialité.</p>
<p>H. Quels sont vos droits ?</p>
<p>
Vous disposez de différents droits, que vous pouvez exercer à tout moment. Vous pouvez ainsi :</p>
<p>
    Accéder à vos données personnelles (droit d’accès)</p>
    Demander la correction, la mise à jour ou la modification des données vous concernant qui ne sont plus exactes ou complètes (droit de rectification)
    Demander la limitation ou la suppression de vos données personnelles, notamment si vous croyez que leur traitement n’est pas justifié ou n’est pas légal ou dans les autres cas prévus par la loi (droit de limitation et de suppression)
    Retirer votre consentement au traitement de vos données personnelles, dans le cas où vous avez donné un tel consentement (droit de retrait du consentement)
    <p> Vous opposer à la continuation d’un traitement (droit d’opposition)</p>
    Demandez la portabilité de vos données personnelles à savoir, la restitution de vos données personnelles sous un format électronique aux fins de les utiliser vous-même ou de les transmettre à un autre organisme, dans les cas permis par la loi (droit à la portabilité)
    Définir des directives relatives au sort de vos données personnelles après votre décès (conformément à l’art. 40-1 de la Loi Informatique et Libertés).</p>

    <p>Si vous considérez que le traitement de vos données personnelles ne respecte pas vos droits, vous pouvez adresser une réclamation auprès de la CNIL, autorité de contrôle dont la mission est de veiller en France au respect de la réglementation applicable aux traitements de données à caractère personnel : www.cnil.fr
<p>Si vous considérez que le traitement de vos données personnelles ne respecte pas vos droits, vous pouvez adresser une réclamation auprès de la CNIL, autorité de contrôle dont la mission est de veiller en France au respect de la réglementation applicable aux traitements de données à caractère personnel: <a href="https://www.cnil.fr" target="_blank">www.cnil.fr</a></p>
</p>
</div>
</div>
</div>
</div>
</div>

<!-- Liens vers les fichiers JavaScript de Bootstrap -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
?>