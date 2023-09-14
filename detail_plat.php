<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
 
$titre = "Restaurant Order";
include ('header.php');
include ('navbar.php');

    

if (isset($_GET['id'])) {
    $plat_id = $_GET['id'];

    // Fetch plat details from the database based on plat_id
    $query = "SELECT * FROM plat WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$plat_id]);
    $plat = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($plat) {
        // Display plat details
        $platName = $plat['libelle'];
        $platDescription = $plat['description'];
        $platPrice = $plat['prix'];
        $platImage = $plat['image'];

        // You can add more details here if needed
    } else {
        echo "Plat non trouvé.";
    }
} else {
    echo "ID de plat non spécifié dans l'URL.";
};


// Include your header and navigation code here

?>

<div class="container">
<h1>Détails du Plat</h1>
<div class="row">
    <div class="col-md-6">
        <img src="<?php echo $platImage; ?>" alt="<?php echo $platName; ?>" class="img-fluid">
    </div>
    <div class="col-md-6">
        <h2><?php echo $platName; ?></h2>
        <p>Description : <?php echo $platDescription; ?></p>
        <p>Prix : <?php echo $platPrice; ?> €</p>
        
        <!-- Add to cart button -->
        <form action="ajouter_panier.php" method="post">
            <input type="hidden" name="plat_id" value="<?php echo $plat_id; ?>">
            <button type="submit" class="btn btn-primary">Ajouter au Panier</button>
        <!-- Retour (Back) button using JavaScript -->
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