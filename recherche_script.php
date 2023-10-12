<?php
if (isset($_GET['searchTerm']) && isset($_GET['searchType'])) {
    $searchQuery = $_GET['searchTerm'];
    $searchType = $_GET['searchType'];

    try {
        // Connexion à la base de données MariaDB
        $pdo = new PDO("mysql:host=localhost;dbname=jessus", "jessus", "1234"); // Remplacez "" par votre mot de passe si nécessaire
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($searchType === 'plats') {
            // Recherche de plats par libellé
            $sql = "SELECT * FROM plat WHERE libelle LIKE :query ORDER BY id ASC";
        } elseif ($searchType === 'categories') {
            // Recherche de catégories par libellé
            $sql = "SELECT * FROM categorie WHERE libelle LIKE :query";
        } else {
            echo 'Type de recherche non valide.';
            exit;
        }

        $query = '%' . $searchQuery . '%'; // Ajoutez des jokers % pour la recherche partielle

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':query', $query, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Afficher les résultats de la recherche
        if (count($results) > 0) {
            echo '<h3>Résultats de la recherche :</h3>';
            echo '<ul>';
            foreach ($results as $result) {
                echo '<li>';
                echo 'Libellé : ' . $result['libelle'] . '<br>';
                echo 'Description : ' . $result['description'] . '<br>';
                echo 'Prix : ' . $result['prix'] . '<br>';
                echo 'Image : ' . $result['image'] . '<br>';
                echo 'ID Catégorie : ' . $result['id_categorie'] . '<br>';
                echo 'Actif : ' . $result['active'] . '<br>';
                // Ajoutez un lien vers la page de détail du plat
                echo '<a href="detail_plat.php?id=' . $result['id'] . '">Voir les détails</a>';
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo 'Aucun résultat trouvé.';
        }
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
} else {
    echo 'Veuillez saisir un terme de recherche et sélectionner un type.';
}
?>
