<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$titre = "Connexion";
include('header.php');


// Vérifie si l'utilisateur est déjà connecté
if (isset($_SESSION['infouser'])) {
    header("Location: index.php"); // Redirige vers la page d'accueil si déjà connecté
    exit;
}

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('header.php'); // Inclut le fichier de connexion à la base de données

    // Récupère les données du formulaire
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    try {
        // Requête SQL pour vérifier les informations de connexion
        $query = "SELECT mdp FROM infouser WHERE email = :email AND mdp = :mdp";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mdp', $mdp);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // L'utilisateur est authentifié avec succès
            $_SESSION['infouser'] = $row['mdp'];
            header("Location: index.php"); // Redirige vers la page d'accueil
            exit;
        } else {
            $messageErreur = "Adresse e-mail ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        echo "Erreur de requête SQL : " . $e->getMessage();
    }
}
?>

<div class="container">
    <h1>Connexion</h1>
    <?php
    if (isset($messageErreur)) {
        echo '<div class="alert alert-danger">' . $messageErreur . '</div>';
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="mdp" name="mdp" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
        <button class="btn btn-primary" ><a href="deconnexion.php">Déconnexion</a></button>
    </form>
</div>

<?php include('footer.php'); ?>
