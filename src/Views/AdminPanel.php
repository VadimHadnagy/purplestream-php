<?php
    include("include/Header.php");
    include("include/Navbar.php");
?>
    <link rel="stylesheet" href="/css/pages/Admin.css">
    <link rel="stylesheet" href="/css/pages/HomePage.css">
    <header>
        <?php include_once("include/NavBar.php"); ?>
    </header>

    <section class="admin__panel">
        <div class="welcome__admin">
            <?php
                echo "<h3>Bienvenue Administrateur " . $_SESSION["user"]["user_name"] . "</h3>";
            ?>
        </div>
        <div class="admin__button">
            <button><a href="/admin/animemanager">Rechercher un(des) anime(s)</a></button>
            <button><a href="/admin/anime/create">Crée un anime</a></button>
        </div>
    </section>

<?php
    include("include/Footer.php");  
?>