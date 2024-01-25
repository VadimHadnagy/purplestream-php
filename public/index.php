<?php

session_start();

require '../src/config/config.php';
require '../vendor/autoload.php';

$router = new PurpleStream\Router($_SERVER['REQUEST_URI']);

$router->get('/', 'LandingController@index');

$router->get('/login?:status', 'UserController@showLoginForm');
$router->get('/register?:error', 'UserController@showRegisterForm');
$router->get('/logout', 'UserController@logout');
$router->get('/user/change-user', 'UserController@showModifyUser');
$router->get('/user/change-user?:error', 'UserController@showModifyUser');
$router->get('/user/change-user?:success', 'UserController@showModifyUser');
$router->get('/user/change-user?error-password', 'UserController@showModifyUser');
$router->get('/user/change-user?error-new-password', 'UserController@showModifyUser');
$router->get('/user/change-user?success-modify-password', 'UserController@showModifyUser');
$router->get('/user/admin-panel', 'UserController@showAdminPanel');
$router->get('/user/profils/', 'UserController@Profil');
$router->get('/user/profil/create', 'UserController@showCreateProfil');

$router->post('/process-login', 'UserController@login');
$router->post('/process-register', 'UserController@create');
$router->post('/user/modify-mail', 'UserController@modifyMail');
$router->post('/user/modify-password', 'UserController@modifyPassword');
$router->Post('/user/profile/process-create', 'UserController@createProfil');

// Route mise à jour pour créer une page anime
$router->get('/admin/anime/create', 'AnimeController@showCreateAnimePage');

// Nouvelles routes pour créer une saison et un épisode d'anime
$router->get('/admin/anime/create-season/?:id', 'AnimeController@showCreateAnimeSeason');
$router->get('/admin/anime/create-episode/?:id', 'AnimeController@showCreateEpisode');

// Nouvelle route pour gérer les anime (supposée être une fonctionnalité d'administration)
$router->get('/admin/animemanager', 'AnimeController@showAnimeManager');
$router->post('/admin/anime/modify-anime/?:id', 'AnimeController@ShowModifyAnime');
$router->post('/admin/anime/process-modify-anime/?:id', 'AnimeController@processModifyAnime');


// Nouvelle route pour afficher les saisons d'anime
$router->get('/anime/show-season/?:id', 'AnimeController@showAnimeSeason');

// Nouvelle route pour afficher un épisode spécifique d'anime
$router->get('/anime/show-episode/?:id', 'AnimeController@showEpisode');

$router->get('/anime/:id/season/:season_id/episode', 'AnimeController@showDefaultEpisode');
$router->get('/anime/:id/season/:season_id/episode/:episode_id', 'AnimeController@showAnimeEpisode');
// Route mise à jour pour traiter la création d'anime
$router->post('/admin/anime/process-create', 'AnimeController@createAnime');

// Route mise à jour pour traiter la création de saison d'anime
$router->post('/admin/anime/process-create-season/?:id', 'AnimeController@createSeason');
$router->post('/admin/anime/delete/?:id', 'AnimeController@deleteAnime');
$router->post('/admin/anime/delete-episode/?:id', 'AnimeController@deleteEpisode');


// Route mise à jour pour traiter la création d'épisode d'anime
$router->post('/admin/anime/process-create-episode/?:id', 'AnimeController@createEpisode');

// Nouvelle route pour rechercher tous les animes (supposée être une fonctionnalité d'administration)
$router->post('/admin/allAnimes', 'AnimeController@searchAnime');

$router->get('/user/account', 'UserController@showProfils');


$router->get('/home', 'AnimeController@showHomePage');



$router->get('/anime/search',  'AnimeController@showSearchAnime');
$router->post('/anime/search/vf', 'AnimeController@searchAnimeFR');
$router->post('/anime/search/vostfr', 'AnimeController@searchAnimeVOST');
$router->post('/anime/searchbycategories', 'AnimeController@searchByCategories');

$router->get('/anime/?:id', 'AnimeController@showAnimePage');


$router->run();
