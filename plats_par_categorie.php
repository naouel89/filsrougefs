<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Plats par catégorie</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <h1>Plats par catégorie</h1>
    <div class="main-content">
        <?php
        // Récupérez l'ID de la catégorie depuis l'URL
        $categorie_id = $_GET['id'];

        // Inclure ici la connexion à la base de données

        // Requête pour obtenir les plats de la catégorie sélectionnée
        $query = "SELECT * FROM plat WHERE id_categorie = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$categorie_id]);

        // Afficher les plats de la catégorie
        while ($plat = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="plat-item">';
            echo '<h2>' . $plat['libelle'] . '</h2>';
            echo '<p>Description : ' . $plat['description'] . '</p>';
            echo '<p>Prix : ' . $plat['prix'] . ' €</p>';
            echo '<img src="' . $plat['image'] . '" alt="' . $plat['libelle'] . '">';
            echo '</div>';
        }
        ?>
    </div>

    <section class="banner">
        <!-- Le reste de votre contenu HTML ici -->
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
