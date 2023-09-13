
<?php 
$titre = "Restaurant Order";
include 'header.php';
include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Plats</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>

    <h1>Liste des plats</h1>
    <div class="main-content">
        <?php
        // Définir les informations de connexion à la base de données
        $host = "localhost"; // Remplacez par le nom d'hôte de votre base de données
        $username = "root"; // Remplacez par votre nom d'utilisateur
        $password = "1234"; // Remplacez par votre mot de passe
        $dbname = "dist"; // Remplacez par le nom de votre base de données

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            // Gestion des erreurs PDO
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
        ?>
    </div>

    <section class="banner">
        <!-- Le reste de votre contenu HTML ici -->
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
