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
    public function filmPage($id){
        $bddCinema=Connect::seConnecter();
        $query=$bddCinema->prepare("SELECT id_film,film.nom_film,film.annee,personne.prenom,personne.nom,film_back_img,synopsis,film_cover,film_title_img,id_film,
                        CONCAT(FLOOR(film.duree/ 60), ' Heures et ', MOD(film.duree, 60),'minutes') AS temps_convert
                        FROM film
                        INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
                        INNER JOIN personne ON personne.id_personne = realisateur.id_personne
                        WHERE film.id_film= :id");
        $query->execute([':id' => $id]);
        $queryGenre= $bddCinema->prepare("SELECT nom_genre
                                FROM genre
                                INNER JOIN identifier ON identifier.id_genre = genre.id_genre
                                INNER JOIN film ON identifier.id_film = film.id_film
                                WHERE film.id_film= :id");
        $queryGenre->execute([':id' => $id]);
                                
        require "view/film.php";
    }
    public function allActors(){
        $actor_id = isset($_GET['id']) ? $_GET['id'] : null;
        $bddCinema=Connect::seConnecter();
        $actorRequete=$bddCinema->query("SELECT personne.nom, personne.prenom,personne.sexe,personne.naissance,personne.img
                                        FROM personne 
                                        INNER JOIN acteur ON acteur.id_personne = personne.id_personne
                                        ");
       
        if ($actor_id) :
            // Utiliser la méthode du modèle pour récupérer les détails du film en fonction de l'ID
            $actorDetails = \Model\Connect::getActorById($actor_id);
        endif;
        
        require "view/actors.php";
    }
}
?>