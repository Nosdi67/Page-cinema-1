<?php

use Controller\CinemaController;

spl_autoload_register(function ($className){
    include $className. '.php';
});

$ctrlCinema = new CinemaController();

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {

        case "homePage":$ctrlCinema->homePage();break;
        case "allMovies":$ctrlCinema->allMovies();break;
    }}
?>