<?php

namespace PurpleStream\Controllers;

class LandingController {
    public function __construct() 
    {

    }

    public function index() {
        require VIEWS . 'Landing.php';
    }

}