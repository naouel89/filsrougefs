<?php
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
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
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
                            echo '<li><hr class="dropdown-divider"></li>';
                        }
                        ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">The District</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="commande.html"><i class="fa fa-shopping-cart"></i> Panier <span
                                id="cart-price">0</span></a>
                </li>
            </ul>
            <ul class="navbar-nav">
            <button class="btn"><a href="connexion.php">Connexion</a></button>

            <button class="btn"><a href="deconnexion.php">Déconnexion</a></button>

            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="recherche" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">recherche</button>
            </form>
        </div>
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
<ul class="navbar-nav">
                
<!-- Rest of your HTML content here -->
