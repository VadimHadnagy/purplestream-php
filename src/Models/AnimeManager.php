<?php

namespace PurpleStream\Models;

class AnimeManager
{
    private $connexion;

    // Constructeur de la classe
    public function __construct()
    {
        // Connexion à la base de données
        $this->connexion = new \PDO('mysql:host=' . DB_CONFIG["HOST"]. ';dbname=' . DB_CONFIG["DATABASE"] . ';charset=utf8;', DB_CONFIG["USER"], DB_CONFIG["PASSWORD"]);
        $this->connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getAllCategories()
    {
        $stmt = $this->connexion->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Category::class);
    }

    public function getAllLanguages()
    {
        $stmt = $this->connexion->prepare("SELECT * FROM languages");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Language::class);
    }

    public function saveAnime(Anime $anime) 
    {
        $stmt = $this->connexion->prepare("INSERT INTO anime (language_id, anime_name, anime_description, anime_image) VALUES (?,?,?,?)");
        $stmt->execute(array(
            $anime->getAnimeLanguageID(),
            $anime->getAnimeName(),
            $anime->getAnimeDescription(),
            $anime->getAnimeImage()
        ));
    
        $animeId = $this->connexion->lastInsertId();
        
        // Appeler la deuxième méthode pour insérer dans la table anime_cat
        $this->saveCategoriesAnime($animeId, $anime->getCategories());
    
        return $animeId;
    }   

    public function saveSeason(Season $season)
    {
        $stmt = $this->connexion->prepare("INSERT INTO anime_season (anime_id, season_name, season_description, season_image) VALUES (?,?,?,?)");
        $stmt->execute(array(
            $season->getAnimeID(),
            $season->getSeasonName(),
            $season->getSeasonDescription(),
            $season->getSeasonImage()
        ));

        return $seasonID = $this->connexion->lastInsertId();
    }

    public function saveEpisode(Episode $episode)
    {
        $stmt = $this->connexion->prepare("INSERT INTO anime_episode (season_id, episode_name, episode_mp4) VALUES (?,?,?)");
        $stmt->execute(array(
            $episode->getSeasonID(),
            $episode->getEpisodeName(),
            $episode->getEpisodeMP4()
        ));

        return $episodeID = $this->connexion->lastInsertId();
    }

    public function searchAllAnimes($anime)
    {
        $stmt = $this->connexion->prepare("SELECT * FROM anime WHERE anime_name LIKE ?");
        $stmt->execute(array("%$anime%"));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Anime::class);
    }
    
    public function saveCategoriesAnime($animeId, $categoryIds)
    {
        // Insérer dans la table anime_cat pour chaque catégorie
        foreach ($categoryIds as $categoryId) {
            $stmt = $this->connexion->prepare("INSERT INTO anime_cat (anime_id, category_id) VALUES (?, ?)");
            $stmt->execute([$animeId, $categoryId]);
        }
    }

    public function getAllSeasonsAnime($id)
    {
        $stmt = $this->connexion->prepare("SELECT * FROM anime_season WHERE anime_id = ?");
        $stmt->execute(array($id));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Season::class);
    }
    
    public function getAllAnime()
    {
        $stmt = $this->connexion->prepare("SELECT * FROM anime");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Anime::class);
    }
    

    public function SearchAnimeFR($anime){
        $query = $anime . '%';  // Ajout de '%' à la fin pour une recherche approximative au début

        $stmt = $this->connexion->prepare("SELECT * FROM anime 
            INNER JOIN languages ON languages.language_id = anime.language_id 
            WHERE anime.language_id = 2 AND anime.anime_name LIKE ?");
            
        $stmt->execute([$query]);
    
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Anime::class);
    }

    public function searchAnimeVOST($anime){
        $query = $anime . '%';  // Ajout de '%' à la fin pour une recherche approximative au début

        $stmt = $this->connexion->prepare("SELECT * FROM anime 
            INNER JOIN languages ON languages.language_id = anime.language_id 
            WHERE anime.language_id = 1 AND anime.anime_name LIKE ?");
            
        $stmt->execute([$query]);
    
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Anime::class);
    }

    public function getAnimeByID($animeID)
{
    $stmt = $this->connexion->prepare("SELECT * FROM anime WHERE anime_id = ?");
    $stmt->execute([$animeID]);
    $result = $stmt->fetchObject(Anime::class);

    return $result;
}

public function getCategoriesByAnimeID($animeID)
    {
        $stmt = $this->connexion->prepare("SELECT categories.category_name 
                                           FROM categories
                                           INNER JOIN anime_cat ON categories.category_id = anime_cat.category_id
                                           WHERE anime_cat.anime_id = ?");
        $stmt->execute([$animeID]);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }
    
    public function getEpisodeByID($episode_id, $season_id): ?Episode 
    {
        $stmt = $this->connexion->prepare("SELECT * FROM anime_episode WHERE anime_episodeid = ?");
        $stmt->execute([$episode_id]);
    
        if ($stmt->rowCount() > 0) {
            // Il y a des résultats, retourner l'objet Episode
            $result = $stmt->fetchObject(Episode::class);
            return $result;
        } else {
            // Aucun résultat trouvé, retourner null
            return null;
        }
    }

    public function getAllEpisodesBySeasonID($seasonID){
        $stmt = $this->connexion->prepare("SELECT * FROM anime_episode WHERE season_id = ?");
        $stmt->execute([$seasonID]);
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Episode::class);
    }

    public function deleteEpisode($id) {
        $stmt = $this->connexion->prepare("DELETE FROM anime_episode WHERE anime_episodeid = ?");
        $stmt->execute([$id]);
    }

    public function getPreviousEpisode($currentEpisode, $episodesList)
    {
        $currentEpisodeIndex = array_search($currentEpisode, $episodesList);

        return ($currentEpisodeIndex > 0) ? $episodesList[$currentEpisodeIndex - 1] : null;
    }

    public function getNextEpisode($currentEpisode, $episodesList)
    {
        $currentEpisodeIndex = array_search($currentEpisode, $episodesList);

        return ($currentEpisodeIndex < count($episodesList) - 1) ? $episodesList[$currentEpisodeIndex + 1] : null;
    }

public function getFirstEpisodeID($seasonID) {
    $stmt = $this->connexion->prepare("SELECT * FROM anime_episode WHERE season_id = ? ORDER BY anime_episodeid ASC LIMIT 1");
    $stmt->execute([$seasonID]);
    $firstEpisode = $stmt->fetchObject(Episode::class);

    return $firstEpisode ? $firstEpisode->getAnimeEpisodeID() : null;
}

public function getEpisodesList($season_id) {
    $stmt = $this->connexion->prepare("SELECT * FROM anime_episode WHERE season_id = ?");
    $stmt->execute([$season_id]);
    return $stmt->fetchAll(\PDO::FETCH_CLASS, Episode::class);
}

public function getCategoriesByIds($categoryIds)
{
    $placeholders = implode(',', array_fill(0, count($categoryIds), '?'));

    $stmt = $this->connexion->prepare("SELECT anime.* FROM anime 
        INNER JOIN anime_cat ON anime.anime_id = anime_cat.anime_id 
        WHERE anime_cat.category_id IN ($placeholders)
        GROUP BY anime.anime_id
        HAVING COUNT(DISTINCT anime_cat.category_id) = " . count($categoryIds));
    $stmt->execute($categoryIds);

    $result = $stmt->fetchAll(\PDO::FETCH_CLASS, Anime::class);

    return $result;
}



    public function getSeasonByID($seasonID)
    {
        $stmt = $this->connexion->prepare("SELECT * FROM anime_season WHERE season_id = ?");
        $stmt->execute([$seasonID]);
        $result = $stmt->fetchObject(Season::class);

        return $result;
    }

    public function deleteAnime($animeID)
    {
        // Delete categories associated with the anime
        $stmt = $this->connexion->prepare("DELETE FROM anime_cat WHERE anime_id = ?");
        $stmt->execute([$animeID]);

        // Get episode IDs associated with the seasons
        $stmt = $this->connexion->prepare("SELECT anime_episodeid FROM anime_episode WHERE season_id IN (SELECT season_id FROM anime_season WHERE anime_id = ?)");
        $stmt->execute([$animeID]);
        $episodeIDs = $stmt->fetchAll(\PDO::FETCH_COLUMN);

        // Delete episodes associated with the seasons
        $stmt = $this->connexion->prepare("DELETE FROM anime_episode WHERE season_id IN (SELECT season_id FROM anime_season WHERE anime_id = ?)");
        $stmt->execute([$animeID]);

        // Delete seasons associated with the anime
        $stmt = $this->connexion->prepare("DELETE FROM anime_season WHERE anime_id = ?");
        $stmt->execute([$animeID]);

        // Delete the anime
        $stmt = $this->connexion->prepare("DELETE FROM anime WHERE anime_id = ?");
        $stmt->execute([$animeID]);
    }

    public function modifyAnime($animeID)
    {
        $stmt = $this->connexion->prepare("SELECT * FROM anime WHERE anime_id = ?");
        $stmt->execute([$animeID]);
        $result = $stmt->fetchObject(Anime::class);

        return $result;
    }
    public function updateAnime($animeId, $animeName, $animeDescription)
    {
        $stmt = $this->connexion->prepare("UPDATE anime SET anime_name = ?, anime_description = ? WHERE anime_id = ?");
        $stmt->execute([$animeName, $animeDescription, $animeId]);
    
        return $stmt->rowCount() > 0;
    }
}