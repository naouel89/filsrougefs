<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
 
$titre = "Restaurant Order";
include ('header.php');
include ('navbar.php');


            // Requête pour obtenir les plats
            $query = "SELECT * FROM plat";
            $stmt = $conn->prepare($query);
            $stmt->execute();

            // Afficher les plats
            while ($plat = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="plat-item">';
                echo '<h2>' . $plat['libelle'] . '</h2>';
                echo '<p>Description : ' . $plat['description'] . '</p>';
                echo '<p>Prix : ' . $plat['prix'] . ' €</p>';
                echo '<img src="' . $plat['image'] . '" alt="' . $plat['libelle'] . '">';
                echo '</div>';
            }
      
        ?>
    </div>

    <section class="banner">
        <!-- Le reste de votre contenu HTML ici -->
    </section>
<?php
include ('footer.php') 
?>
