
<?php
include('header.php');
include('navbar.php');
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);





?>
    <h1>Catégories de plats</h1>
    <div class="main-content">
        <?php
     

       
            // Requête pour obtenir les catégories
            $query = "SELECT * FROM categorie";
            $stmt = $conn->prepare($query);
            $stmt->execute();

            // Afficher les catégories avec des liens vers les plats de chaque catégorie
            while ($categorie = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="categorie-item">';
                echo '<a href="plats_par_categorie.php?id=' . $categorie['id'] . '">';
                echo '<img src="' . $categorie['image'] . '" alt="' . $categorie['libelle'] . '">';
                echo '<h2>' . $categorie['libelle'] . '</h2>';
                echo '</a>';
                echo '</div>';
            }
            
    
        ?>
    </div>

    <section class="banner">
        <!-- Le reste de votre contenu HTML ici -->
        <button class="btn btn-primary "><a href= "deconnexion.php">Déconnexion</a></button>
    </section>
    <?php
include ('footer.php') 
?>

