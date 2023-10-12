<?php

ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
include('connexion_script.php');
include('header.php');

function getPlatDetailsById($idPlat, $db) {
    $sql = "SELECT * FROM plat WHERE id = :idPlat";
    $requete = $db->prepare($sql);
    $requete->bindParam(':idPlat', $idPlat);
    $requete->execute();
    return $requete->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_plat'])) {
    $idPlat = $_POST['id_plat'];
    $plat = getPlatDetailsById($idPlat, $db);

    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }

    $_SESSION['panier'][] = array(
        'id_plat' => $plat['id'],
        'libelle' => $plat['libelle'],
        'quantite' => $plat['quantite'],
        'prix' => $plat['prix']
    );

    header("Location: panier.php");
    exit();
}



if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
    echo "<h1>Votre Panier</h1>";

    $total = 0;
    foreach ($_SESSION['panier'] as $plat) {
        echo "<p>" . $plat['libelle'] . " - Prix unitaire : " . $plat['prix'] . " €</p>";
        $total += $plat['prix'];
    }
    echo "<p>quantite :" . $quantite . "</p>";
    echo "<p><strong>Total : " . $total . " €</strong></p>";

    echo '<form action="traitement_commande.php" method="post">';
    echo '<label for="adresse_client">Adresse du Client:</label>';
    echo '<input type="text" id="adresse_client" name="adresse_client" required><br><br>';
    echo '<label for="nom_client">Nom du Client:</label>';
    echo '<input type="text" id="nom_client" name="nom_client" required><br><br>';
    echo '<label for="telephone_client">Téléphone du Client:</label>';
    echo '<input type="text" id="telephone_client" name="telephone_client" required><br><br>';
    echo '<label for="email_client">email</label>';
    echo '<input type="text" id="email_client" name="email_client" required><br><br>';
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

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// session_start();
// var_dump($_SESSION['panier']); // Ajoutez cette ligne pour vérifier le contenu du panier
// // Inclure le script de connexion à la base de données
// include('connexion_script.php');
// include('header.php');
// require('DAO.php');

// // Vérifier si le panier existe dans la session
// if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
//     echo "Votre panier est vide.";
// } else {
//     // Afficher les éléments du panier
//     echo "<h2>Votre panier :</h2>";

// echo "<ul>";
// foreach ($_SESSION['panier'] as $id_plat => $quantite) {
//     // Récupérer les détails du plat depuis la base de données
//     $id_plat = 0; // La valeur de l'id que vous souhaitez récupérer
//     $stmt = $db->prepare("SELECT * FROM plat WHERE id = :id_plat");
//     $stmt->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
//     $stmt->execute();
//     $plat = $stmt->fetch(PDO::FETCH_ASSOC);
//     // Afficher les détails du plat dans le panier
// echo "<li>{$plat['nom']} - Quantité : $quantite</li>";
// }
// echo "</ul>";
//     // Formulaire de commande
//     echo "<h2>Passer la commande :</h2>";
//     echo "<form method='post' action='traitement_commande.php'>";
//     echo "Nom : <input type='text' name='nom_client' required><br>";
//     echo "Téléphone : <input type='text' name='telephone_client' required><br>";
//     echo "Email : <input type='email' name='email_client' required><br>";
//     echo "Adresse : <input type='text' name='adresse_client' required><br>";
//     echo "<input type='submit' value='Valider la commande'>";
//     echo "</form>";
// }

// include('footer.php');
?>
