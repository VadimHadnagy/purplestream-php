<?php

namespace PurpleStream\Models;

class Episode
{
// DÉCLARATION DES ATTRIBUTS DE LA CLASSE
    private $anime_episodeid;
    private $season_id;
    private $episode_name;
    private $episode_mp4;


    // MÉTHODE CONSTRUCTEUR DE LA CLASSE
    public function __construct()
    {
        // Le constructeur est actuellement vide
    }


    // SETTER POUR L'ATTRIBUT category_id
    public function setAnimeEpisodeID($anime_episodeid)
    {
        $this->anime_episodeid = $anime_episodeid;
    }

    // GETTER POUR L'ATTRIBUT category_id
    public function getAnimeEpisodeID()
    {
        return $this->anime_episodeid;
    }

    // SETTER POUR L'ATTRIBUT category_name
    public function setSeasonID($season_id)
    {
        $this->season_id = $season_id;
    }

    // GETTER POUR L'ATTRIBUT category_name
    public function getSeasonID()
    {
        return $this->season_id;
    }

    public function setEpisodeName($episode_name)
    {
        $this->episode_name = $episode_name;
    }

    // GETTER POUR L'ATTRIBUT category_name
    public function getEpisodeName()
    {
        return $this->episode_name;
    }

    public function setEpisodeMP4($episode_mp4)
    {
        $this->episode_mp4 = $episode_mp4;
    }

    // GETTER POUR L'ATTRIBUT category_name
    public function getEpisodeMP4()
    {
        return $this->episode_mp4;
    }
}