<?php

// Inclure le script de connexion à la base de données
require('connexion_script.php');

// Fonction pour récupérer les plats depuis la base de données
function get_plats($host, $dbname, $username, $password)
{
    try {
        // Connexion à la base de données MySQL
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        // Exécutez la requête SQL pour obtenir les plats les plus populaires
        $stmt = $db->query("SELECT p.image, p.libelle, SUM(c.quantite) AS total_quantite
                            FROM commande c
                            INNER JOIN plat p ON c.id_plat = p.id
                            GROUP BY c.id_plat
                            ORDER BY total_quantite DESC
                            LIMIT 6");
        
        // Récupérez les résultats sous forme de tableau associatif
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;
    } catch (PDOException $e) {
        // Gérez les erreurs de connexion ici
        return array(); // Retourne un tableau vide en cas d'erreur
    }
}

// Récupérez les données de la base de données
$plats = get_plats($host, $dbname, $username, $password);

// Fonction pour créer le code HTML du carrousel
function createCarousel($plats)
{
    $carouselHtml = ''; // Variable pour stocker le code HTML du carrousel

    // Variable pour suivre l'index du carrousel
    $index = 0;

    // Parcourez les plats et ajoutez-les au carrousel
    foreach ($plats as $plat) {
        $image = $plat['image'];
        $libelle = $plat['libelle'];
        $totalQuantite = $plat['total_quantite'];

        // Définissez la classe "active" pour le premier élément du carrousel
        $activeClass = ($index === 0) ? 'active' : '';

        // Créez le code HTML pour un élément du carrousel
        $carouselHtml .= '<div class="carousel-item ' . $activeClass . '">';
        $carouselHtml .= '<img src="' . $image . '" class="d-block w-100 custom-carousel-image" alt="Image du plat">';
        $carouselHtml .= '<div class="carousel-caption">';
        $carouselHtml .= '<h3>' . $libelle . '</h3>';
        $carouselHtml .= '<p>Total des ventes : ' . $totalQuantite . '</p>';
        $carouselHtml .= '</div>';
        $carouselHtml .= '</div>';

        // Incrémentez l'index pour suivre les éléments du carrousel
        $index++;
    }

    return $carouselHtml;
}

try {
    // Récupérez les plats depuis la base de données
    $plats = get_plats($host, $dbname, $username, $password);

    // Créez le code HTML du carrousel à partir des données obtenues
    $carouselHtml = createCarousel($plats);
} catch (PDOException $e) {
    // En cas d'erreur de connexion à la base de données, affichez un message d'erreur
    $carouselHtml = "Erreur de connexion à la base de données : " . $e->getMessage();
}

?>
