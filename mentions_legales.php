
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

Mentions Légales
<p> légales de l'entreprise </p>

<p> sociale : TheDistrict</p>

<p>Forme juridique : SARL</p>

<p>Siège social : 30 rue de Poulainville, 80000 AMIENS</p>

<p>Numéro SIRET : 123 456 789 1011</p>

<p>Numéro de TVA intracommunautaire : FR12 3456 7890</p>
<p>Directeur de la publication</p>

<p>Prénom et nom du directeur de la publication : Nathanael jessus</p>
<p>Adresse email de contact : jessus@district.com</p>
<p>Hébergement</p>

<p>Nom de l'hébergeur : AFPA</p>

<p>Adresse de l'hébergeur : 30 rue de Poulainville, 80000 AMIENS</p>
<p>Coordonnées de l'entreprise</p>
<p>TheDistrict</p>
<p>123 Rue du District, 75000 Paris</p>
<p>80000 Amiens</p>
<p>Téléphone :  +33 1 23 45 67 89</p>
<p>Email :  info@thedistrict.com</p>
<p>Droits d'auteur</p>

<p>Tous droits réservés © 2023 TheDistrict. Tous les contenus de ce site sont protégés par les lois sur le droit d'auteur.
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