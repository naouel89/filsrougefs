
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
require 'DAO.php';
$platcontent = get_plats('localhost', 'dist', 'root', '1234');

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
            //afficher
            

// Récupérez les données de la base de données
$plats = get_plats($host, $dbname, $username, $password);


?>


    <div class="container">
        <h1>Liste des Plats les plus vendu :</h1>

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicateurs de carrousel -->
            <ol class="carousel-indicators">
                <?php for ($i = 0; $i < count($plats); $i++) : ?>
                    <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>"
                    <?php if ($i === 0) echo 'class="active"'; ?>>
                    </li>
                <?php endfor; ?>
            </ol>

            <!-- Contenu du carrousel -->
            <div class="carousel-inner">
                <?php foreach ($plats as $key => $plat) : ?>
                    <div class="carousel-item <?php if ($key === 0) echo 'active'; ?>">
                        <img src="<?php echo $plat['image']; ?>" class="d-block w-100" alt="<?php echo $plat['libelle']; ?>">
                        <div class="carousel-caption">
                            <h3><?php echo $plat['libelle']; ?></h3>
                            <p>Total Quantité: <?php echo $plat['total_quantite']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Contrôles du carrousel -->
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <?php
include ('footer.php') ;

?>

