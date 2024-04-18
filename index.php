<?php
use Controller\CinemaController;

spl_autoload_register(function ($className){
    include $className. '.php';
});

$ctrlCinema = new CinemaController();
$id = (isset($_GET['id']))? $_GET['id'] : null;

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {

        case "homePage":$ctrlCinema->homePage();break;
        case "allMovies":$ctrlCinema->allMovies();break;
        case "filmPage":$ctrlCinema->filmPage($id);break;
        case "actorsPage":$ctrlCinema->allActors();break;
    }}
?>