<?php
// Démarrez la session si elle n'est pas déjà démarrée
session_start();

// Détruisez la session
session_destroy();

// Redirigez l'utilisateur vers une page de connexion (par exemple, login.php)
header("Location: connexion.php");
exit;
?>
