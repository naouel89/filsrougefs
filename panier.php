<?php

ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
include('connexion_script.php');

function getPlatDetailsById($idPlat, $conn) {
    $sql = "SELECT * FROM plat WHERE id = :idPlat";
    $requete = $conn->prepare($sql);
    $requete->bindParam(':idPlat', $idPlat);
    $requete->execute();
    return $requete->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_plat'])) {
    $idPlat = $_POST['id_plat'];
    $plat = getPlatDetailsById($idPlat, $conn);

    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }

    $_SESSION['panier'][] = array(
        'id_plat' => $plat['id'],
        'libelle' => $plat['libelle'],
        'prix' => $plat['prix']
    );

    header("Location: panier.php");
    exit();
}

include('header.php');

if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
    echo "<h1>Votre Panier</h1>";

    $total = 0;
    foreach ($_SESSION['panier'] as $plat) {
        echo "<p>" . $plat['libelle'] . " - Prix unitaire : " . $plat['prix'] . " €</p>";
        $total += $plat['prix'];
    }

    echo "<p><strong>Total : " . $total . " €</strong></p>";

    echo '<form action="traitement_commande.php" method="post">';
    echo '<label for="adresse_client">Adresse du Client:</label>';
    echo '<input type="text" id="adresse_client" name="adresse_client" required><br><br>';
    echo '<label for="nom_client">Nom du Client:</label>';
    echo '<input type="text" id="nom_client" name="nom_client" required><br><br>';
    echo '<label for="telephone_client">Téléphone du Client:</label>';
    echo '<input type="text" id="telephone_client" name="telephone_client" required><br><br>';
    echo '<input type="hidden" name="total" value="' . $total . '">';
    echo '<input type="submit" value="Valider la Commande">';
    echo '</form>';
} else {
    echo "Votre panier est vide.";
}
?>
<script src="jquery-2.1.1.min.js"></script>
<?php
include('footer.php');
?>
