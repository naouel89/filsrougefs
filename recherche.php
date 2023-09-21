<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche de Plats/Catégories</title>
</head>
<body>
    <h1>Recherche de Plats/Catégories</h1>
    <form action="recherche_script.php" method="GET">
        <label for="searchTerm">Terme de recherche :</label>
        <input type="text" id="searchTerm" name="searchTerm" required>
        <label for="searchType">Type de recherche :</label>
        <select id="searchType" name="searchType" required>
            <option value="plats">Plats</option>
            <option value="categories">Catégories</option>
        </select>
        <button type="submit">Rechercher</button>
    </form>
</body>
</html>
