<?php

namespace PurpleStream\Controllers;

use PurpleStream\Models\anime;
use PurpleStream\Models\Episode;
use PurpleStream\Models\Season;
use PurpleStream\Models\AnimeManager;

class AnimeController
{
    private $animeManager;
    public function __construct()
    {
        $this->animeManager = new AnimeManager();
    }

    public function showHomePage(){
        $allAnimes = $this->animeManager->getAllAnime();

        $content = '';
        foreach ($allAnimes as $anime) {
            $content .= $this->showFicheAnime($anime);
        }
        require VIEWS . 'HomePage.php';
    }

    public function showSearchAnime()
    {
        $categories = $this->animeManager->getAllCategories();
        $content = '';
        require VIEWS . 'FormSearch.php';
    }

    public function searchAnimeFR()
    {
        $animes = $this->animeManager->searchAnimeFR($_POST["query_vf"]);
        $categories = $this->animeManager->getAllCategories();
        $content = '';
    
        if ($animes) {
            foreach ($animes as $anime) {
                $content .= $this->showAnimeSearch($anime);
            }
        } else {
            $content = "<p>Aucun résultat trouvé.</p>";
        }
    
        require VIEWS . 'FormSearch.php';
    }

    public function searchAnimeVOST()
    {
        $animes = $this->animeManager->searchAnimeVOST($_POST["query_vostfr"]);
        $categories = $this->animeManager->getAllCategories();
        $content = '';
    
        if ($animes) {
            foreach ($animes as $anime) {
                $content .= $this->showAnimeSearch($anime);
            }
        } else {
            $content = "<p>Aucun résultat trouvé.</p>";
        }
    
        require VIEWS . 'FormSearch.php';
    }

    public function searchByCategories() {
        // Vérifiez si la requête est une requête POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Créez un tableau pour stocker les IDs des catégories cochées
            $checkedCategoryIDs = array();

            // Parcourez chaque ID de catégorie
            foreach($_POST as $key => $value){
                // Vérifiez si la case correspondante a été cochée
                if ($value == 'on') {
                    // La case a été cochée, ajoutez l'ID de la catégorie au tableau
                    $checkedCategoryIDs[] = $key;
                }
            }

            // Faites une requête vers le manager en utilisant les IDs des catégories
            $result = $this->animeManager->getCategoriesByIds($checkedCategoryIDs);
            $categories = $this->animeManager->getAllCategories();
            $content = "";
            if($result <= 0) {
                $content = "<h1>Aucun animé trouver</h1>";
            } else {
                foreach($result as $anime)
                {
                    $content .= $this->showAnimeSearch($anime);
                }
            }
            require(VIEWS . 'FormSearch.php');
        }
    }

    public function showCreateAnimePage(){
        $categories = $this->animeManager->getAllCategories();
        $languages = $this->animeManager->getAllLanguages();
        require VIEWS . 'FormCreateAnime.php';
    }

    public function showCreateAnimeSeason()
    {
        require VIEWS . 'FormCreateSeason.php';
    }

    public function showCreateEpisode()
    {
        require VIEWS . 'FormCreateEpisode.php';
    }

    public function showAnimeManager()
    {
        require VIEWS . 'AnimeManager.php';
    }

    public function showAnimeSeason()
    {
        $seasons = $this->animeManager->getAllSeasonsAnime($_GET["id"]);
        foreach($seasons as $season)
        {   
            $content = "<div class='div__anime'>
                <h1>Voici les saisons de l'anime</h1>";

            $seasons = $this->animeManager->getAllSeasonsAnime($_GET["id"]);
            foreach($seasons as $season)
            {   
                $content .= "<div class='div__anime-button'>
                    <h2>" . $season->getSeasonName() . "</h2>
                    <button><a href='/anime/show-episode?id=" . $season->getSeasonID() . "'>Voir les épisodes de la saison</a></button>
                    <button><a href='/admin/anime/create-episode?id=" . $season->getSeasonID() . "'>Crée episode</a></button>

                </div>";
            }

            $content .= "</div>";
        }
        $id = $_GET["id"];
        $_SESSION["animeID"] = $id;
        require VIEWS . 'Layout.php';
    }

    public function createAnime()
    {
        $anime = new Anime();
        $anime->setAnimeName(htmlspecialchars($_POST["anime__name"]));
        $anime->setAnimeDescription(htmlspecialchars($_POST["anime__description"]));
        
        if (isset($_FILES['anime__image']) && $_FILES['anime__image']["error"] !== UPLOAD_ERR_NO_FILE) {
            $uploaddir = 'img/anime/';
            $uploadfile = $uploaddir . basename($_FILES['anime__image']['name']);
            
            if (move_uploaded_file($_FILES['anime__image']['tmp_name'], $uploadfile)) {
                $anime->setAnimeImage($_FILES['anime__image']['name']);
            } else {
                echo "Erreur lors du déplacement du fichier.";
            }
        }
        
        $anime->setAnimeLanguageID(htmlspecialchars($_POST["anime__select-language"]));
        $anime->setCategories($_POST["anime__select-categories"]);
        $saveAnime = $this->animeManager->saveAnime($anime);
        $content = $this->showSuccesfulCreate($saveAnime);
        require VIEWS . 'Layout.php'; 
    }

    public function createSeason($id)
    {
        $season = new Season();
        $season->setAnimeId($id);
        $season->setSeasonName(htmlspecialchars($_POST["season__name"]));
        $season->setSeasonDescritpion(htmlspecialchars($_POST["season__desription"]));

        if (isset($_FILES['season__image']) && $_FILES['season__image']["error"] !== UPLOAD_ERR_NO_FILE) {
            $uploaddir = 'img/season';
            $uploadfile = $uploaddir . basename($_FILES['season__image']['name']);
            
            if (move_uploaded_file($_FILES['season__image']['tmp_name'], $uploadfile)) {
                $season->setSeasonImage($_FILES['season__image']['name']);
            } else {
                echo "Erreur lors du déplacement du fichier.";
            }
        }

        $saveSeason = $this->animeManager->saveSeason($season);
        $content = $this->showSuccesfulCreateSeason($saveSeason);

        require VIEWS . "Layout.php";
    }

    public function createEpisode($idSeason)
    {
        $episode = new Episode();
        $episode->setSeasonId($_GET["id"]);
        $episode->setEpisodeName(htmlspecialchars($_POST["episode__name"]));
        $episode->setEpisodeMP4(htmlspecialchars($_POST['episode__mp4']));
        $saveEpisode = $this->animeManager->saveEpisode($episode);
        $content = $this->showSuccesfulCreateEpisode($episode);
        require VIEWS . "Layout.php";
    }

    public function searchAnime()
    {
        $animes = $this->animeManager->searchAllAnimes($_POST["searchAnime"]);
        $content = "";
        foreach($animes as $anime)
        {
            $content .= $this->showAnime($anime);
        }

        require VIEWS . "AnimeManager.php";
    }
    public function showAnimeEpisode($id, $season_id, $episode_id) {
        $anime = $this->animeManager->getAnimeByID($id);
        $episodesList = $this->animeManager->getAllEpisodesBySeasonID($season_id);
        $episode = $this->animeManager->getEpisodeByID($episode_id, $season_id);
        $previousEpisode = $this->animeManager->getPreviousEpisode($episode, $episodesList);
        $nextEpisode = $this->animeManager->getNextEpisode($episode, $episodesList);
        $currentSeason = $this->animeManager->getSeasonByID($season_id);
        $seasonName = $currentSeason ? $currentSeason->getSeasonName() : "Saison inconnue";

        // Construire les données nécessaires pour l'affichage
        $content = $this->buildEpisode($id, $anime, $seasonName, $episode, $episodesList, $previousEpisode, $nextEpisode, $season_id, $episode_id);

        require VIEWS . 'VideoPlayer.php';
    }

    public function buildEpisode($id, $anime, $seasonName, $episode, $episodesList, $previousEpisode, $nextEpisode, $season_id, $episode_id) {
        $content = "
            <div id='img-div'>
                <img id='img-details__player--video' src='/img/anime/{$anime->getAnimeImage()}' alt='{$anime->getAnimeName()}'>
                <h3>{$anime->getAnimeName()}</h3>
                <h4>{$seasonName}</h4>
            </div>
        ";

        if ($episode && $episode->getSeasonID() == $season_id) {
            // Ajouter des boutons pour les épisodes précédents et suivants
            $content .= "<div class='navigation-buttons'>";
            if ($previousEpisode) {
                $content .= "<a class='btn-previous' href='/anime/{$id}/season/{$season_id}/episode/{$previousEpisode->getAnimeEpisodeID()}'>Précédent</a>";
            }

            // Générer le formulaire avec le menu déroulant et styliser le select
            $content .= "<form method='get'>";
            $content .= "<select name='episode' onchange='this.form.submit()'>";
            foreach ($episodesList as $ep) {
                $selected = ($ep->getAnimeEpisodeID() == $episode_id) ? "selected" : "";
                $content .= "<option value='{$ep->getAnimeEpisodeID()}' $selected>{$ep->getEpisodeName()}</option>";
            }
            $content .= "</select>";
            $content .= "</form>";

            if ($nextEpisode) {
                $content .= "<a class='btn-next' href='/anime/{$id}/season/{$season_id}/episode/{$nextEpisode->getAnimeEpisodeID()}'>Suivant</a>";
            }
            $content .= "</div>";

            // Générer le chemin du fichier vidéo
            $videoPath = "{$episode->getEpisodeMP4()}";

            // Générer le lecteur vidéo
            $content .= "<iframe id='un_episode' src='{$videoPath}' scrolling='no' frameborder='0' allowfullscreen='true' webkitallowfullscreen='true' referrerpolicy='no-referrer' mozallowfullscreen='true'></iframe>";

            // Si une nouvelle sélection d'épisode a été faite
            if (isset($_GET['episode']) && $_GET['episode'] != $episode_id) {
                $newEpisode = $_GET['episode'];
                header("Location: /anime/{$id}/season/{$season_id}/episode/{$newEpisode}");
                exit();
            }
        } else {
            // L'épisode n'a pas été trouvé.
            $content = "<p>L'épisode n'a pas été trouvé.</p>";
        }

        return $content;
    }

    public function showEpisode($id)
    {
        $id = $_GET["id"];
        $episodes = $this->animeManager->getAllEpisodesBySeasonID($id);
        $content = "";
        foreach($episodes as $episode)
        {
            $content .= "
            <div class='div__episode'>
                <h1>Voici les épisodes de la saison</h1>
                <div class='div__episode-button'>
                    <h2>" . $episode->getEpisodeName() . "</h2>
                    <form action='/admin/anime/delete-episode/?id=" . $episode->getAnimeEpisodeID() . "' method='post'>
                        <button type='submit'>supprimer l'épisode</button>
                </div>
            ";
        }

        require VIEWS . "Layout.php";
    }

    public function deleteEpisode()
    {
        $this->animeManager->deleteEpisode($_GET["id"]);
        require VIEWS . "AnimeManager.php";
    }

    public function showAnimePage($id) {
        $anime = $this->animeManager->getAnimeByID($id);
    
        if ($anime) {
            $seasons = $this->animeManager->getAllSeasonsAnime($id);
            $content = $this->generateAnimePageContent($anime, $seasons, $id);
    
            require VIEWS . 'AnimePage.php';
        } else {
            require VIEWS . 'Layout.php';
        }
    }    
public function generateAnimePageContent(Anime $anime, $seasons, $id) {
    $languageText = ($anime->getAnimeLanguageID() == 1) ? "VOSTFR" : "VF";

    // Générez le contenu de la page de l'anime
    $animeContent = "
        <div class='anime-details'>
            <h1>Aperçu</h1>
            <hr>
            <img id='img-details' src='/img/anime/{$anime->getAnimeImage()}' alt='{$anime->getAnimeName()}'>
            <h1 id='anime_title'>{$anime->getAnimeName()} <span class='anime-language'>| {$languageText}</span></h1>
            <h4>Avancement: <span>En cours de dev</span></h4>  
            <button id='btn-favoris'>+ Favoris</button>
            <button id='btn-watchlist'>+ Watchlist</button>
        </div>
    ";

    // Récupérez le season_id depuis les paramètres GET
    $selectedSeasonID = isset($_GET['season_id']) ? $_GET['season_id'] : null;

    // Générez les boutons de saison et les noms de saison
    $seasonButtons = "
    <div class='button-container'>
        <h3>Anime</h3>
        <hr>
        <div id='container-season'>";
    foreach ($seasons as $season) {
        $seasonImage = $season->getSeasonImage();
        $seasonID = $season->getSeasonID();
        $seasonName = $season->getSeasonName();

        // Instanciez correctement la classe Season
        $seasonInstance = new Season(); // Assurez-vous que la classe est correctement importée

        // Utilisez la méthode getFirstEpisodeID sur l'instance de Season
        $firstEpisodeID = $this->animeManager->getFirstEpisodeID($seasonID);

    $seasonButtons .= "
        <a class='' href='{$anime->getAnimeID()}/season/{$seasonID}/episode/{$firstEpisodeID}'>
            <div class='season-container'>
                <img class='season-img' src='/img/anime/{$anime->getAnimeImage()}' alt='{$seasonName}'>
            </div>
            <p class='season-name'>{$seasonName}</p>
        </a>";
        }
    $seasonButtons .= "
        </div>
    </div>";

    // Générez le contenu de la section "Synopsis"
    $synopsisContent = "
        <div>
            <h3>Synopsis</h3>
            <hr>
            <div class='synopsis-container'>
                <p class='synopsis-text'>{$anime->getAnimeDescription()}</p>
            </div>
        </div>
    ";

    // Combine le contenu de l'anime avec les boutons de saison, le contenu de la section "Synopsis", et le nom de la saison cliquée
    $combinedContent = $animeContent . $seasonButtons . $synopsisContent;
    return $combinedContent;
}

    
    public function showSuccesfulCreate($saveAnime, $message = null)
    {
        return "
            <div class='div__anime'>
                <h1>Votre animée a été créer avec succées</h1>
                <div class='div__anime-button'>
                <button><a href='create-season?id=" . $saveAnime . "'>crée saison</a></button>
                </div>
            </div>  
            ";
    }

    public function showSuccesfulCreateEpisode(Episode $episode, $message = null)
    {
        
        return "
            <div class='div__episode'>
                <h1>Votre épisode a été créer avec succées</h1>
                <div class='div__episode-button'>
                    <h2>" . $episode->getEpisodeName() . "</h2>
                    <button><a href='/anime/show-season?id=" . $_SESSION["animeID"] . "'>Voir les saisons de l'anime</a></button>
                </div>
            </div>
        ";
    }

    public function showAnime(Anime $anime, $message = null)
    {
        $languageText = ($anime->getAnimeLanguageID() == 1) ? "VOSTFR" : "VF";
        return "
            <section class='anime-section'>
                <div class='anime-container'>
                    <h2>" . $anime->getAnimeName() . "<span> | " . $languageText . "</span></h2>
                    <p>" . $anime->GetAnimeDescription() . "</p>
                    <button class='anime-button'><a href='/anime/show-season?id=" . $anime->getAnimeID() . "'>Voir les saisons de l'anime</a></button>
                    <button class='anime-button'><a href='/admin/anime/create-season/?id=" . $anime->getAnimeID() . "'>Crée une saison</a></button>
                    <form action='/admin/anime/modify-anime/" . $anime->getAnimeID() . "' method='post'>
                        <button type='submit'>modifier l'anime</button>
                    </form>
                    <form action='/admin/anime/delete/" . $anime->getAnimeID() . "' method='post'>
                        <button type='submit'>supprimer l'anime</button>
                    </form>
                </div>
            </section>
        ";
    }

    public function ShowModifyAnime($id)
    {
        $anime = $this->animeManager->modifyAnime($id);
        require(VIEWS . "FormModifyAnime.php");
    }

    
    public function deleteAnime($id)
    {
        $this->animeManager->deleteAnime($id);
        require(VIEWS . "AnimeManager.php");
    }

    public function processModifyAnime()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $animeId = $_POST['anime_id'];
            $animeName = htmlspecialchars($_POST['anime_name']);
            $animeDescription = htmlspecialchars($_POST['description']);
    
            $this->animeManager->updateAnime($animeId, $animeName, $animeDescription);
    
            $message = "L'anime a été modifié avec succès.";
    
            $content = "<p>$message</p>
            <a href='/home'>Retour à la page d'accueil</a>";
            require(VIEWS . "Layout.php");
        }
    }

    public function showSuccesfulCreateSeason($saveSeason, $message = null)
    {
        return "
            <div class='div__anime'>
                <h1>Votre saison a été créer avec succées</h1>
                <div class='div__anime-button'>
                <button><a href='/admin/anime/create-episode?id=" . $saveSeason . "'>crée épisode</a></button>
                </div>
            </div>  
            ";
    }

    public function showFicheAnime(Anime $anime){
        $languageText = ($anime->getAnimeLanguageID() == 1) ? "VOSTFR" : "VF";
        return "
        <div class='anime-card anime-card--search'>
            <a href='/anime/" . $anime->getAnimeID() . "' class='anime-card__link anime-card__link--search'>
                <div class='image-container'>
                    <img class='anime-card__image anime-card__image--search' src='/img/anime/" . $anime->getAnimeImage() . "' alt='" . $anime->getAnimeName() . "'>
                </div>
                <div class='text-overlay'>
                    <h3 class='title__anime-card'>" . $anime->getAnimeName() . ' <span class="anime-card__span">| ' . $languageText . "</span></h3>
                </div>
            </a>
        </div>";
    }
    public function showAnimeSearch(Anime $anime){
        $languageText = ($anime->getAnimeLanguageID() == 1) ? "VOSTFR" : "VF";
        return "
        <div class='anime-card anime-card--search'>
            <a href='/anime/" . $anime->getAnimeID() . "' class='anime-card__link anime-card__link--search'>
                <img class='anime-card__image anime-card__image--search' src='/img/anime/" . $anime->getAnimeImage() . "' alt='" . $anime->getAnimeName() . "'>
                <div class='text-overlay'>
                    <h3>" . $anime->getAnimeName() . ' <span class="anime-card__span">| ' . $languageText . "</span></h3>
                </div>
            </a>
        </div>";
    }

    public function showDefaultEpisode($id, $season_id) {
        $content = "
            <div class='div__episode'>
                <h1>Aucun épisode trouvé</h1>
                <div class='div__episode-button'>
                    <p>Il n'y a pas d'épisode disponible pour cette saison.</p>
                    <button><a href='/anime/" . $id . "'>Retour aux saisons de l'anime</a></button>
                </div>
            </div>
        ";
        require VIEWS . "Layout.php"; 
    }


}