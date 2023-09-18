<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
try {
    $pdo = new PDO("mysql:host=localhost;dbname=dist", "root", "1234");
    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch categories from the database
    $sql = "SELECT * FROM categorie WHERE active = 'Yes'";
    $result = $pdo->query($sql);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">The District</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="contact.php">Contact</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    Catégorie
                </a>
                <ul class="dropdown-menu">
                    <?php
                    foreach ($result as $row) {
                        $categoryId = $row["id"];
                        $categoryName = $row["libelle"];
                        echo '<li><a class="dropdown-item" href="plats_par_categorie.php?id=' . $categoryId . '">' . $categoryName . '</a></li>';
                    }
                    ?>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled">The District</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="panier.php"><i class="fa fa-shopping-cart"></i> Panier <span
                            id="cart-price">0</span></a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="connexion.php">Connexion</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="deconnexion.php">Déconnexion</a>
            </li>
        </ul>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Recherche" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Recherche</button>
        </form>
    </div>
</nav>

<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images_the_district(1)/images_the_district/bg.jpg" class="d-block w-100"
          alt="images_the_district(1)/images_the_district/bg.jpg" style="width: 900px; height: 450px;">
      </div>
      <div class="carousel-item">
        <img src="images_the_district(1)/images_the_district/bg1.jpeg" class="d-block w-100"
          alt="images_the_district(1)/images_the_district/bg1.jpeg" style="width: 900px; height: 450px;">
      </div>
      <div class="carousel-item">
        <img src="images_the_district(1)/images_the_district/bg3.jpeg" class="d-block w-100"
          alt="images_the_district(1)/images_the_district/bg3.jpeg" style="width: 900px; height: 450px;">
      </div>
    </div>

    <div class="overlay">
      <div class="text-container">
        <h1>The District</h1>

        <img class="logo" src="images_the_district(1)/images_the_district/the_district_brand/logo_transparent.png"
          alt="logo" title="logo" width="500" height="500">
      </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
     crossorigin="anonymous" referrerpolicy="no-referrer"></script>