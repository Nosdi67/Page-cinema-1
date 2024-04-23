<?php
use Controller\CinemaController;

spl_autoload_register(function ($className){
    include $className. '.php';
});

$ctrlCinema = new CinemaController();
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$cleanId=filter_var($id, FILTER_SANITIZE_NUMBER_INT);

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {

        case "homePage":$ctrlCinema->homePage();break;
        case "allMovies":$ctrlCinema->allMovies();break;
        case "filmPage":$ctrlCinema->filmPage($id);break;
        case "actorsPage":$ctrlCinema->allActors();break;
        case "actorPage":$ctrlCinema->actorPage($id);break;
        case "genreList":$ctrlCinema->genreList();break;
        case "producersPage":$ctrlCinema->producersPage();break;
        case "producerPage":$ctrlCinema->producerPage($id);break;
        case "adminPage":$ctrlCinema->adminPage();break;
        case "adminPageActorPost":$ctrlCinema->adminPageActorPost();break;
        case "adminPageFilmPost":$ctrlCinema->adminPageFilmPost();break;
        case "adminPageGenrePost":$ctrlCinema->adminPageGenrePost();break;
    }}
?>