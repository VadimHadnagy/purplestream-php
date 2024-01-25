<?php 
include("include/Header.php");
include("include/Navbar.php");
//***************  fichier qui affiche le hml renvoyé par les controllers
?>
    <?php
    //***************  Si un contrôleur envoie un contenu, on l'affiche
    if (isset($content)) {
        echo $content;
    }
    ?>

<?php include("include/Footer.php"); ?>
<link rel="stylesheet" href="/css/pages/homepage.css">

