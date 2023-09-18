<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include ('connexion_script.php');
$titre = "Connexion";

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];

         // Requête pour obtenir le mot de passe associé à l'email
        $stmt = $conn->prepare("SELECT mdp FROM infouser WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch();

        if ($row && $mdp == $row['mdp']) {
            // Mot de passe correct, authentification réussie
            $_SESSION["email"] = $email;
            header("Location: index.php"); // Redirection vers la page d'accueil après connexion
            exit();
        } else {
            $messageErreur = "Email ou mot de passe incorrect.";
        }
    }
include ('header.php');
?>


<div class="container mt-5">
    <h1 class="mb-4">Connexion</h1>
    <?php
    if (isset($messageErreur)) {
        echo '<div class="alert alert-danger">' . $messageErreur . '</div>';
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="email">Adresse e-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="mdp" name="mdp" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>
<?php
include('footer.php');
?>
</body>
</html>
