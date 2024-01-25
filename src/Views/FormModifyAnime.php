
<?php
include("include/Header.php");
include("include/Navbar.php");
if (isset($_SESSION['user'])):
    if ($_SESSION['user']['user_role'] == 1):
        ?>
        <link rel="stylesheet" href="/css/pages/HomePage.css">
        <section class="modify__anime">
            <form action="/admin/anime/process-modify-anime/?id" method="post">
                <input type="hidden" name="anime_id" value="<?= $anime->getAnimeId() ?>">
                <label for="anime_name">Nom de l'anime:</label>
                <input type="text" name="anime_name" value="<?= $anime->getAnimeName() ?>">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="5" cols="33"><?= $anime->getAnimeDescription() ?></textarea>
                <label for="anime_image">Image de l'anime:</label>
                <input type="file" name="anime_image">
                <input type="submit" value="Modifier">
            </form>
        </section>
        <?php
        include("include/Footer.php");
    else:
        echo "Accès refusé. Vous n'avez pas les droits d'administrateur.";
    endif;
else:
    echo "Vous n'êtes pas connecté.";
endif;
?>