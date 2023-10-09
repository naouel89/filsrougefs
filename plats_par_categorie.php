    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();

    $titre = "Catégories de plats";
    include('header.php');
    include('connexion_script.php');
    include('navbar.php');

    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION["email"])) {
        // Récupérer l'email de l'utilisateur connecté
        $email = $_SESSION["email"];
        

        // Afficher l'utilisateur connecté
        echo '<p>Bienvenue, ' . $email . '</p>';
    } else {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        header("Location: connexion.php");
        exit();
    }
    ?>
    <body>
        
    <h1 class="text-center mt-5">Plats</h1>

<div class="container mt-5">
    <div class="row">
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
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<img src="' . $plat['image'] . '" class="card-img-top" alt="' . $plat['libelle'] . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $plat['libelle'] . '</h5>';
                echo '<p class="card-text">Prix : ' . $plat['prix'] . ' €</p>';
                echo '<form action="ajouter_panier.php" method="post">';
                echo '<input type="hidden" name="plat_id" value="' . $plat['id'] . '">';
                echo '<button type="submit" name="add_to_cart" class="btn btn-primary">Ajouter au panier</button>';
                echo '</form>';
                echo '<a href="detail_plat.php?id=' . $plat['id'] . '" class="btn btn-secondary mt-2">Plus de détails</a>';
                echo '</div></div></div>';
            }
        } else {
            echo '<div class="col text-center"><p class="alert alert-danger">ID de catégorie non spécifié dans l\'URL.</p></div>';
        }
        ?>
    </div>
</div>

        <section class="banner">
            <!-- Le reste de votre contenu HTML ici -->
        </section>
        <button class="btn btn-secondary" id="retourButton">Retour</button>
            </div>
        </div>
    </div>
    </body>

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