<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$titre = "Catégories de plats";
include ('header.php');
include ('navbar.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <title>Categorie</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>


    <h1>Catégories de plats</h1>
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
