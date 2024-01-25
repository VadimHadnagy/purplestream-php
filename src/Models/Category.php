<?php

namespace PurpleStream\Models;

class Category
{
// DÉCLARATION DES ATTRIBUTS DE LA CLASSE
    private $category_id;
    private $category_name;


    // MÉTHODE CONSTRUCTEUR DE LA CLASSE
    public function __construct()
    {
        // Le constructeur est actuellement vide
    }


    // SETTER POUR L'ATTRIBUT category_id
    public function setAnimeCategoryID($category_id)
    {
        $this->category_id = $category_id;
    }

    // GETTER POUR L'ATTRIBUT category_id
    public function getAnimeCategoryID()
    {
        return $this->category_id;
    }

    // SETTER POUR L'ATTRIBUT category_name
    public function setAnimeCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }

    // GETTER POUR L'ATTRIBUT category_name
    public function getAnimeCategoryName()
    {
        return $this->category_name;
    }
}