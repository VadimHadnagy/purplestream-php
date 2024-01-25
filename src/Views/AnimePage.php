<?php 
    include_once("include/Header.php"); 
?>        
<link rel="stylesheet" href="/css/pages/AnimePage.css">
    <link rel="stylesheet" href="/css/pages/HomePage.css">
    <header>
        <?php include_once("include/NavBar.php"); ?>
    </header>
<div class="body-anime">   
    <?php
        echo $content;
    ?>
</div>

<?php 
include_once("include/Footer.php");
?>