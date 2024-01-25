<?php 
    include_once("include/Header.php"); 
    if(isset($_SESSION['user'])):
        if($_SESSION['user']['user_role'] == 1):
?>     
<link rel="stylesheet" href="/css/pages/admin.css">
<link rel="stylesheet" href="/css/pages/HomePage.css">
    <header>
        <?php include_once("include/NavBar.php"); ?>
    </header>
    <main>
        <form action="/admin/allAnimes" method="post">
            <div class="input__container">
                <label for="searchAnime">Rechercher un anime</label>
                <input type="text" name="searchAnime" id="searchAnime">
            </div>
        </form>
    </main>

    <div>
    <?php
    if (isset($content)) {
        echo $content;
    }
    ?>
    </div>
    <?php 
else:
    echo "Accès refusé. Vous n'avez pas les droits d'administrateur.";
endif;
else:
    echo "Vous n'êtes pas connecté.";
endif;
?>