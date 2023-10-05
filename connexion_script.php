
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
    try {
      $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
      // Gérer les erreurs de connexion à la base de données ici
      echo "Erreur de connexion : " . $e->getMessage();
      exit();
  }
  
    ?>