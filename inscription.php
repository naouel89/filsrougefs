<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Inclure le script de connexion
include('connexion_script.php');
include ('header.php');
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $pseudo = $_POST["pseudo"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $email = $_POST["email"];

    // Vérifier si les mots de passe correspondent
    if ($password === $confirm_password) {
        // Préparation de la requête d'insertion
        $stmt = $conn->prepare("INSERT INTO infouser (pseudo, email, mdp) VALUES (:pseudo, :email, :mdp)");

        // Liaison des paramètres
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mdp', $password); // Utilisation du mot de passe non hashé

        // Exécution de la requête
        if ($stmt->execute()) {
            echo "Inscription réussie !";

            // Redirection vers la page de connexion après inscription réussie
            header("Location: connexion.php");
            exit(); // Assurez-vous d'utiliser exit() après une redirection pour terminer l'exécution du script
        } else {
            echo "Une erreur s'est produite lors de l'inscription.";
        }
    } else {
        echo "Les mots de passe ne correspondent pas.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4">Inscription</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="pseudo">Pseudo:</label>
                        <input type="text" class="form-control" name="pseudo" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirmation du mot de passe:</label>
                        <input type="password" class="form-control" name="confirm_password" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Adresse email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </form>
                <p class="mt-3">Vous avez déjà un compte ? <a href="connexion.php">Connectez-vous !</a></p>
            </div>
        </div>
    </div>
</body>
</html>
