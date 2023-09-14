<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$titre = "Catégories de plats";
include ('header.php');
include ('navbar.php');

?>

<body>
<h1>Plats</h1>
    <div class="main-content">
        <?php
        // Récupérez l'ID de la catégorie depuis l'URL
        if (isset($_GET['id'])) {
            $id_categorie = $_GET['id'];

            // Requête pour obtenir les plats de la catégorie sélectionnée
            $query = "SELECT * FROM plat WHERE id_categorie = ?";
            $stmt = $conn->prepare($query);
            $stmt->execute([$id_categorie]);

            // Afficher les plats de la catégorie
            while ($plat = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="plat-item">';
                echo '<h2>' . $plat['libelle'] . '</h2>';
                echo '<p>Description : ' . $plat['description'] . '</p>';
                echo '<p>Prix : ' . $plat['prix'] . ' €</p>';
                echo '<img src="' . $plat['image'] . '" alt="' . $plat['libelle'] . '">';
     // Add "Ajouter au panier" button
     echo '<form action="ajouter_panier.php" method="post">';
     echo '<input type="hidden" name="plat_id" value="' . $plat['id'] . '">';
     echo '<input type="submit" name="add_to_cart" value="Ajouter au panier">';
     echo '</form>';

     // Add "Plus de détails" button
     echo '<a href="detail_plat.php?id=' . $plat['id'] . '">Plus de détails</a>';

 }
                echo '</div>';
            }
         else {
            echo "ID de catégorie non spécifié dans l'URL.";
        }

        
        ?>
    </div>

    <section class="banner">
        <!-- Le reste de votre contenu HTML ici -->
    </section>
    <button class="btn btn-secondary" id="retourButton">Retour</button>
        </div>
    </div>
</div>

<?php
// Include your footer code here
include('footer.php');
?>

<!-- JavaScript to navigate back to the previous page -->
<script>
    document.getElementById('retourButton').addEventListener('click', function() {
        window.history.back();
    });
</script>