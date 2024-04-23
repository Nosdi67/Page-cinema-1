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

        $filmsInfo=$bddCinema->prepare("SELECT nom, prenom, a.id_acteur, sexe
                                            FROM personne p
                                            INNER JOIN acteur a ON a.id_personne = p.id_personne
                                            WHERE a.id_acteur = :id");
        $filmsInfo->execute([':id' => $id]);
        
        $actorAndFilm=$bddCinema->prepare("SELECT nom, prenom, a.id_acteur,sexe,naissance,img,nom_role,f.nom_film,f.id_film,film_cover
                                            FROM personne p
                                            INNER JOIN acteur a ON a.id_personne = p.id_personne
                                            INNER JOIN jouer j ON j.id_acteur = a.id_acteur
                                            INNER JOIN film f ON f.id_film = j.id_film
                                            INNER JOIN role r ON r.id_role = j.id_role
                                            WHERE a.id_acteur=:id");
        $actorAndFilm->execute([':id' => $id]);
        require "view/actorPage.php";
    }
    
    public function genreList(){
        $bddCinema=Connect::seConnecter();

        $genreRequete=$bddCinema->query("SELECT * FROM genre");

        require "view/genrePage.php";
    }

    public function addGenreForm(){
        require "view/genreForm.php";
    }
    
    public function addGenre(){
        if(isset($_POST['nom_genre'])){
            $nomGenre=filter_input(INPUT_POST, 'nom_genre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $bddCinema=Connect::seConnecter();
            
            $insertGenre=$bddCinema->prepare("INSERT INTO genre(nom_genre) VALUES (:nomGenre)");
            $insertGenre->execute([':nomGenre' => $nomGenre]);
        }
        require "view/genreForm.php";
    }
    //une injection SQL c'est un problème de sécurité, 
    //on ne peut pas mettre de données directement dans une requête SQL.
    //on risque de créer des failles de sécurité.

    //une requet prepare est une requête préparée qui permet d'éviter les injections SQL.

    public function producersPage(){
        $bddCinema=Connect::seConnecter();
        $producersInfo=$bddCinema->prepare("SELECT nom, prenom, r.id_realisateur,sexe,naissance,img
                                            FROM personne p
                                            INNER JOIN realisateur r ON r.id_personne = p.id_personne");
        $producersInfo->execute();
        require "view/producersPage.php";
    }
    
    public function producerPage($id){

        $bddCinema=Connect::seConnecter();
        $producersInfo=$bddCinema->prepare("SELECT nom, prenom, r.id_realisateur,sexe,naissance,img,nom_film,id_film,film_cover
                                            FROM personne p
                                            INNER JOIN realisateur r ON r.id_personne = p.id_personne
                                            INNER JOIN film f ON f.id_realisateur = r.id_realisateur
                                            WHERE r.id_realisateur=:id");
        
        $producersInfo->execute([':id' => $id]);

        $producersInfo2=$bddCinema->prepare("SELECT nom, prenom, r.id_realisateur,sexe,naissance,img,nom_film,id_film,film_cover
                                            FROM personne p
                                            INNER JOIN realisateur r ON r.id_personne = p.id_personne
                                            INNER JOIN film f ON f.id_realisateur = r.id_realisateur
                                            WHERE r.id_realisateur=:id");
        
        $producersInfo2->execute([':id' => $id]);

        $producersInfo3=$bddCinema->prepare("SELECT nom, prenom, r.id_realisateur,sexe,naissance,img,nom_film,id_film,film_cover
                                            FROM personne p
                                            INNER JOIN realisateur r ON r.id_personne = p.id_personne
                                            INNER JOIN film f ON f.id_realisateur = r.id_realisateur
                                            WHERE r.id_realisateur=:id");
        
        $producersInfo3->execute([':id' => $id]);
        require "view/producer.php";
    }
}
    
?>

