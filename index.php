
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
  // Afficher l'utilisateur connecté
    echo '<p>Bienvenue, ' . $email . '</p>';
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
include ('footer.php') ;

?>

