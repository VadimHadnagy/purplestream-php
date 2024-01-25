<?php 
    include_once("include/Header.php"); 
    if(isset($_SESSION['user'])):
        if($_SESSION['user']['user_role'] == 1):
?>   
<link rel="stylesheet" href="/css/pages/HomePage.css">
    <header>
        <?php include_once("include/NavBar.php"); ?>
    </header>
<main>
        <form action="/admin/anime/process-create-episode/?id=<?php echo $_GET["id"] ?>" method="post" enctype="multipart/form-data">
            <div class="input__container">
                <label for="episode__name">Veuillez entrez un nom d'episode</label>
                <input type="text" class="episode__name" name="episode__name">
            </div>
            <div class="input__container">
                <label for="episode__description">Veuillez entrez une description</label>
                <textarea name="episode__description" id="episode__description" cols="30" rows="10"></textarea>
            </div>
            <div class="input__container">
                <label for="episode__mp4">Veuillez entrez une video pour son URL</label>
                <input type="text" name="episode__mp4" id="episode__mp4">
            </div>
            <input type="submit" value="Envoyer">
        </form>
    </main>
<?php 
else:
    echo "Accès refusé. Vous n'avez pas les droits d'administrateur.";
endif;
else:
    echo "Vous n'êtes pas connecté.";
endif;
?>