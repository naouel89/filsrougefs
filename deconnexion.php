
<?php
session_start();
session_unset(); // Supprimez toutes les données de session
session_destroy(); // Détruire la session
header("Location: connexion.php"); // Rediriger vers la page d'accueil ou une autre page
exit;
?>
