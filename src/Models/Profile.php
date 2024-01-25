<?php

namespace PurpleStream\Models;

class Profile
{
    private $user_profileid;
    private $user_id;
    private $user_profilename;
    private $user_image;


    public function __construct()
    {
    }


    public function setProfileID($user_profileid)
    {
        $this->user_profileid = $user_profileid;
    }

    public function getProfileID()
    {
        return $this->user_profileid;
    }

    public function setUserID($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUserID()
    {
        return $this->user_id;
    }

    public function setProfilName($user_profilename)
    {
        $this->user_profilename = $user_profilename;
    }

    public function getProfilName()
    {
        return $this->user_profilename;
    }

    public function setProfilImage($user_image)
    {
        $this->user_image = $user_image;
    }

    public function getProfilImage()
    {
        return $this->user_image;
    }
}