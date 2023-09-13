<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>The District: - <?= $titre ?></title>


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <?php
 
 // Vérification si le formulaire a été soumis
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Connexion à la base de données
     $servername = "localhost"; // Remplacez par le nom de votre serveur MySQL
     $username = "root"; // Remplacez par votre nom d'utilisateur MySQL
     $password = "1234"; // Remplacez par votre mot de passe MySQL
     $dbname = "dist"; // Remplacez par le nom de votre base de données

     $conn = new mysqli($servername, $username, $password, $dbname);

     // Vérification de la connexion
     if ($conn->connect_error) {
         die("La connexion à la base de données a échoué : " . $conn->connect_error);
     }}

 