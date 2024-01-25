<?php 
    include_once("include/Header.php"); 

    if(isset($_SESSION['user'])):
?>
    <link rel="stylesheet" href="/css/pages/AnimePage.css">
    <link rel="stylesheet" href="/css/pages/homepage.css">
    <link rel="stylesheet" href="/css/pages/videoPlayer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <header>
        <?php include_once ("include/NavBar.php"); ?>
    </header>
    <?php
        echo $content;
    ?>
        <script src='https://kit.fontawesome.com/c1b469aede.js' crossorigin='anonymous'></script>

<?php 
    include_once("include/Footer.php"); 
else:
    echo "Vous n'avez pas accès à cette page, veuillez vous connecter";
endif;
?>