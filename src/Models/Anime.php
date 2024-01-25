<?php

namespace PurpleStream\Models;

class Anime
{
    private $anime_id;
    private $anime_name;
    private $anime_description;
    private $anime_image;
    private $langage_name;
    private $language_id;
    private $category_id;
    private $categories = array();

    public function __construct()
    {
    }


    public function setAnimeID($anime_id)
    {
        $this->anime_id = $anime_id;
    }

    public function getAnimeID()
    {
        return $this->anime_id;
    }

    public function setAnimeName($anime_name)
    {
        $this->anime_name = $anime_name;
    }

    public function getAnimeName()
    {
        return $this->anime_name;
    }

    public function setAnimeDescription($anime_description)
    {
        $this->anime_description = $anime_description;
    }

    public function GetAnimeDescription()
    {
        return $this->anime_description;
    }

    public function setAnimeImage($anime_image)
    {
        $this->anime_image = $anime_image;
    }

    public function GetAnimeImage()
    {
        return $this->anime_image;
    }

    public function getLangageName()
    {
        return $this->langage_name;
    }

    public function setAnimeCategoryID($category_id)
    {
        $this->category_id = $category_id;
    }

    public function getAnimeCategoryID()
    {
        return $this->category_id;
    }

    public function setAnimeLanguageID($language_id)
    {
        $this->language_id = $language_id;
    }

    public function getAnimeLanguageID()
    {
        return $this->language_id;
    }

    public function setLanguageId($language_id) {
        $this->language_id = $language_id;
    }

    public function getLanguageId() {
        return $this->language_id;
    }

    public function setLanguageName($langage_name) {
        $this->langage_name = $langage_name;
    }

    public function setCategories(array $categories) {
        $this->categories = $categories;
    }

    public function getCategories() {
        return $this->categories;
    }
}