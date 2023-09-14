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
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="recherche" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">recherche</button>
            </form>
        </div>
    </div>
</nav>

<!-- Rest of your HTML content here -->
