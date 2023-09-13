<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <title>DISTRIC</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
  <?php
  
    $host = "localhost"; // Remplacez par le nom d'hôte de votre base de données
    $username = "root"; // Remplacez par votre nom d'utilisateur
    $password = "1234"; // Remplacez par votre mot de passe
    $dbname = "dist"; // Remplacez par le nom de votre base de données
 
 // Établir la connexion à la base de données
     $db = new PDO('mysql:host=localhost;charset=utf8;dbname=dist', 'root', '1234');
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
 
     try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        // Gestion des erreurs PDO
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
  
    ?>