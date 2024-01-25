<?php include_once("include/Header.php"); ?>

<link rel="stylesheet" href="/css/pages/homepage.css">
<header>
    <?php include_once("include/NavBar.php"); ?>
</header>

<div class="hero-section">
    <div class="overlay"></div>
    <h1 class="hero-title">Zom 100: Bucket list of the dead</h1>
    <p class="hero-description">Version Française</p>
    <div class="center-btn">
        <a href="#" class="btn__hero--section">
            <img src="/img/icon/play-solid.svg" alt="play btn">
            <span class="play-btn">Regarder Ep. 1 S1</span>
        </a>
    </div>
</div>

<section class="anime-section">
    <div class="title__anime-card">
        <h2>Découvrez les anime à regarder en hiver !</h2>
        <p>Regardez gratuitement les épisodes de ces simulcasts de l'hiver !</p>
    </div>
    <div class="slider-container">
        <div class="slider">
            <?php echo $content; ?>
        </div>
    </div>
</section>

<section>
    <div class="title__anime-card">
        <h2>Bientôt</h2>
        <p>Bientôt disponible sur notre platforme !</p>
    </div>
    <div>
        <img id="annonce" src="/img/solo-leveling-bandeau.jpg" alt="">
    </div>
</section>

<!-- <section class="anime-section">
    <div class="title__anime-card">
        <h2 class='text__categories'>Action</h2>
        <p class='text__categories'>Tous les anime d'action</p>
    </div>
    <div class="slider-container">
        <div class="slider">
            <?php echo $actions; ?>
        </div>
    </div>
</section> -->
<?php   
include_once("include/Footer.php"); 
?>