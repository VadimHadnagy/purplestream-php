<?php

namespace PurpleStream\Models;

class Season
{
    private $season_id;
    private $anime_id;
    private $season_name;
    private $season_description;
    private $season_image;

    public function __construct()
    {
    }


    public function setSeasonID($season_id)
    {
        $this->season_id = $season_id;
    }

    public function getSeasonID()
    {
        return $this->season_id;
    }

    public function setAnimeId($anime_id)
    {
        $this->anime_id = $anime_id;
    }

    public function getAnimeID()
    {
        return $this->anime_id;
    }

    public function setSeasonName($season_name)
    {
        $this->season_name = $season_name;
    }

    public function getSeasonName()
    {
        return $this->season_name;
    }

    public function setSeasonDescritpion($season_description)
    {
        $this->season_description = $season_description;
    }

    public function getSeasonDescription()
    {
        return $this->season_description;
    }

    public function setSeasonImage($season_image)
    {
        $this->season_image = $season_image;
    }

    public function getSeasonImage()
    {
        return $this->season_image;
    }
}