<?php

namespace PurpleStream\Models;

class Language
{
    private $language_id;
    private $langage_name;

    public function __construct()
    {
    }

    public function setAll($language_id, $langage_name)
    {
        $this->setLanguageId($language_id);
        $this->setLanguageName($langage_name);
    }

    public function setLanguageId($language_id)
    {
        $this->language_id = $language_id;
    }

    public function getLanguageId()
    {
        return $this->language_id;
    }

    public function setLanguageName($langage_name)
    {
        $this->langage_name = $langage_name;
    }

    public function getLanguageName()
    {
        return $this->langage_name;
    }
}
