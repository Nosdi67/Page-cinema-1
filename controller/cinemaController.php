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
        $bddCinema=Connect::seConnecter();
        $actorRequete=$bddCinema->query("SELECT personne.nom, personne.prenom,personne.sexe,personne.naissance,personne.img,acteur.id_acteur
                                        FROM personne 
                                        INNER JOIN acteur ON acteur.id_personne = personne.id_personne");
        
        require "view/actors.php";
    }
    public function actorPage($id){
        $bddCinema=Connect::seConnecter();
        $actorInfo=$bddCinema->prepare("SELECT nom, prenom, a.id_acteur, sexe, naissance, img
                                            FROM personne p
                                            INNER JOIN acteur a ON a.id_personne = p.id_personne
                                            WHERE a.id_acteur = :id");
        $actorInfo->execute([':id' => $id]);
        $actorAndFilm=$bddCinema->prepare("SELECT nom, prenom, acteur.id_acteur,sexe,naissance,img,nom_role,film.nom_film,film.id_film,film_cover
                                        FROM personne
                                        INNER JOIN acteur ON acteur.id_personne = personne.id_personne
                                        INNER JOIN jouer ON jouer.id_acteur = acteur.id_acteur
                                        INNER JOIN film ON film.id_film = jouer.id_film
                                        INNER JOIN role ON role.id_role = jouer.id_role
                                        WHERE acteur.id_acteur=:id");
        $actorAndFilm->execute([':id' => $id]);
        require "view/actorPage.php";
    }
}
?>