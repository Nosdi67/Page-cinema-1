<?php

namespace Controller;
use Model\Connect;

class CinemaController{

    public function homePage(){
        $bddCinema=Connect::seConnecter();
        $query=$bddCinema->query("SELECT film.nom_film,film.annee,personne.prenom,personne.nom,film_back_img,synopsis,film_cover,film_title_img,id_film,
                        CONCAT(FLOOR(film.duree/ 60), ' Heures et ', MOD(film.duree, 60),'minutes') AS temps_convert
                        FROM film
                        INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
                        INNER JOIN personne ON personne.id_personne = realisateur.id_personne");
        $query2=$bddCinema->query("SELECT nom_film,synopsis,film_cover
                            FROM filmavenir");

        require "view/homePage.php";
    }
    public function allMovies(){
        $bddCinema=Connect::seConnecter();
        $query=$bddCinema->query("SELECT film.nom_film,film.annee,personne.prenom,personne.nom,film_back_img,synopsis,film_cover,film_title_img,id_film,note_alloCine,note_imdb,
                        CONCAT(FLOOR(film.duree/ 60), ' Heures et ', MOD(film.duree, 60),'minutes') AS temps_convert
                        FROM film
                        INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
                        INNER JOIN personne ON personne.id_personne = realisateur.id_personne");
                        
        require "view/allMovies.php";
    }
    public function filmPage(){
        $film_id = isset($_GET['id']) ? $_GET['id'] : null;
        $bddCinema=Connect::seConnecter();
        $query=$bddCinema->query("SELECT id_film,film.nom_film,film.annee,personne.prenom,personne.nom,film_back_img,synopsis,film_cover,film_title_img,id_film,
                        CONCAT(FLOOR(film.duree/ 60), ' Heures et ', MOD(film.duree, 60),'minutes') AS temps_convert
                        FROM film
                        INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
                        INNER JOIN personne ON personne.id_personne = realisateur.id_personne
                        WHERE film.id_film= $film_id");
        $queryGenre= $bddCinema->prepare("SELECT nom_genre
                                FROM genre
                                INNER JOIN identifier ON identifier.id_genre = genre.id_genre
                                INNER JOIN film ON identifier.id_film = film.id_film
                                WHERE film.id_film= ?");
                                
        if ($film_id) :
            // Utiliser la méthode du modèle pour récupérer les détails du film en fonction de l'ID
            $filmDetails = \Model\Connect::getFilmDetailsById($film_id); 
        endif;                       
        require "view/film.php";
    }
}
?>