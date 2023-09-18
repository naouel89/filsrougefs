
<?php

// Fonction de déconnexion
if (isset($_GET["logout"])) {
    session_unset(); // Supprimez toutes les données de session
    session_destroy(); // Détruire toutes les données de la session
  
    exit();
}
header("Location: connexion.php");
?>