<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$titre = "add_plats";
include('header.php');
include('navbar.php');
include('connexion_script.php');
?>

<title>Ajouter un plat au menu</title>

<body>
    <h1>Ajouter un plat au menu</h1>
    <form action="add_plat_script.php" method="post" enctype="multipart/form-data" class="mt-4">
        <!-- Champ pour le nom du plat -->
        <label for="libelle">Nom du plat:</label>
        <input type="text" name="libelle" id="libelle" required><br><br>

        <!-- Champ pour la description du plat -->
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required></textarea><br><br>

        <!-- Champ pour le prix du plat -->
        <label for="prix">Prix:</label>
        <input type="text" name="prix" id="prix" required><br><br>

        <!-- Liste déroulante pour sélectionner la catégorie du plat -->
        <label for="id_categorie">Catégorie:</label>
        <select name="id_categorie" id="id_categorie" required>
            <option value="">Sélectionnez une catégorie</option>
            <?php
            // Connectez-vous à la base de données (You should use a separate file for database connection and include it here)
            $db = new PDO('mysql:host=localhost;charset=utf8;dbname=dist', 'root', '1234');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Récupération des catégories depuis la table "categorie"
            $requete = $db->query("SELECT * FROM categorie");
            while ($categorie = $requete->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $categorie['id'] . "'>" . $categorie['libelle'] . "</option>";
            }
            ?>
        </select><br><br>

        <!-- Champ pour téléverser une image du plat -->
        <label for="image">Image du plat (Formats autorisés : jpg, png, gif):</label><br><br>
        <input type="file" name="image" id="image" accept="*" required><br><br>

        <!-- Bouton pour soumettre le formulaire -->
        <input type="submit" value="Ajouter">

        <!-- Bouton pour retourner au menu sans soumettre le formulaire -->
        <a href="index.php"><input type="button" value="Retour au Menu"></a>
    </form>
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