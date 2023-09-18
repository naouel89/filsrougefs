<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifier si le email est stocké dans la variable de session
if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
} else {
    // Rediriger vers la page de connexion si l'email n'est pas défini
    header("Location: connexion.php");
    exit();
}

// Vérifier si un plat_id est présent dans la requête POST
if (isset($_POST['plat_id'])) {
    $plat_id = $_POST['plat_id'];
    // Effectuer une requête pour récupérer les détails du plat en fonction de $plat_id depuis votre base de données
    include('connexion_script.php');
    $query = "SELECT * FROM plat WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$plat_id]);
    $plat = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($plat) {
        // Vérifier si le panier est déjà initialisé dans la session
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        // Ajouter le plat au panier
        $_SESSION['panier'][] = $plat;
    // Rediriger vers la page précédente (utilisation de HTTP_REFERER)
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    // Le plat avec l'ID spécifié n'a pas été trouvé, vous pouvez gérer cette erreur ici
    echo "Le plat n'a pas été trouvé.";
}
}
?>
