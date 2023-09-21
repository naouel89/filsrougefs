<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
 
$titre = "Restaurant Order";
include ('header.php');
include ('navbar.php');




// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Connect to the database (You should use a separate file for database connection and include it here)
        $db = new PDO('mysql:host=localhost;charset=utf8;dbname=dist', 'root', '1234');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //
        // Retrieve the form data
        $libelle = $_POST['libelle'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $id_categorie = $_POST['id_categorie'];

        // Retrieve the image information
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        // Check if the file is an image and has a valid extension
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
        $file_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        if (in_array($file_extension, $allowed_extensions)) {
            // Generate a unique filename for the image
            $unique_image_name = uniqid() . '.' . $file_extension;

            // Move the uploaded image to a directory (e.g., 'uploads/')
            $upload_path = '' . $unique_image_name;

            if (move_uploaded_file($image_tmp, $upload_path)) {
                // Prepare an SQL statement to insert the data into the 'plat' table
                $stmt = $db->prepare("INSERT INTO plat (libelle, description, prix, image, id_categorie, active) VALUES (?, ?, ?, ?, ?, 'Yes')");
                $stmt->execute([$libelle, $description, $prix, $unique_image_name, $id_categorie]);

                // Redirect the user to the menu page after successful insertion
                header("Location: index.php");
                exit();
            } else {
                echo "Une erreur s'est produite lors du téléchargement de l'image.";
            }
        } else {
            echo "Format d'image non valide. Les formats autorisés sont : jpg, jpeg, png, gif.";
        }
    } catch (PDOException $e) {
        echo "Erreur de base de données : " . $e->getMessage();
    }
} else {
    // Display an error message if the request method is not POST
    echo "Méthode non autorisée.";
}
?>
