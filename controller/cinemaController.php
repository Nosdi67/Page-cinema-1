<?php

namespace Controller;
use Model\Connect;
use PDO;

class CinemaController{

    public function homePage(){
        $bddCinema=Connect::seConnecter();
        $query=$bddCinema->query("SELECT film.nom_film,film_back_img,synopsis,film_cover,film_title_img,id_film,
                        CONCAT(FLOOR(film.duree/ 60), ' Heures et ', MOD(film.duree, 60),'minutes') AS temps_convert
                        FROM film
                        INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur");
        $query2=$bddCinema->query("SELECT nom_film,synopsis,film_cover
                                FROM filmavenir");

        require "view/homePage.php";
    }
    public function allMovies(){
        $bddCinema=Connect::seConnecter();
        $query=$bddCinema->query("SELECT film.nom_film,synopsis,film_cover,id_film,note_alloCine,note_imdb,
                        CONCAT(FLOOR(film.duree/ 60), ' Heures et ', MOD(film.duree, 60),'minutes') AS temps_convert
                        FROM film");
                        
        require "view/allMovies.php";
    }
    public function filmPage($id){
        $bddCinema=Connect::seConnecter();
        $query=$bddCinema->prepare("SELECT id_film,film.nom_film,film.annee,film_back_img,synopsis,film_cover,film_title_img,id_film,
                                    CONCAT(FLOOR(film.duree/ 60), ' Heures et ', MOD(film.duree, 60),'minutes') AS temps_convert
                                    FROM film
                                    WHERE film.id_film= :id");

        $query->execute([':id' => $id]);

        $queryGenre= $bddCinema->prepare("SELECT nom_genre
                                        FROM genre
                                        INNER JOIN identifier ON identifier.id_genre = genre.id_genre
                                        INNER JOIN film ON identifier.id_film = film.id_film
                                        WHERE film.id_film= :id");
        $queryGenre->execute([':id' => $id]);

        $actorInfo=$bddCinema->prepare("SELECT a.id_acteur,nom, prenom,sexe, naissance, img, f.id_film
                                        FROM personne p
                                        INNER JOIN acteur a ON a.id_personne = p.id_personne
                                        INNER JOIN jouer j ON j.id_acteur = a.id_acteur
                                        INNER JOIN film f ON f.id_film = j.id_film
                                        WHERE f.id_film = :id");
        $actorInfo->execute([':id' => $id]);

        $film=$bddCinema->prepare("SELECT * FROM film WHERE id_film = :id");
        $film->execute([':id' => $id]);

        $actorsSelect= $bddCinema->prepare("SELECT a.id_acteur, p.nom, p.prenom 
                                            FROM acteur a 
                                            INNER JOIN personne p ON a.id_personne = p.id_personne");
        $actorsSelect->execute();

        $roleSelect = $bddCinema->prepare("SELECT * FROM role");
        $roleSelect->execute();

        $filmCasting=$bddCinema->prepare("  SELECT nom,prenom,a.id_acteur
                                            FROM personne p 
                                            INNER JOIN acteur a ON a.id_personne = p.id_personne
                                            INNER JOIN jouer j ON j.id_acteur = a.id_acteur
                                            INNER JOIN film f ON f.id_film = j.id_film
                                            WHERE f.id_film =:id");
        
        $filmCasting->execute([':id' => $id]);

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
    
    public function adminPageGenrePost(){
        if(isset($_POST['nom_genre'])){
            $nomGenre=filter_input(INPUT_POST, 'nom_genre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $bddCinema=Connect::seConnecter();
            
            $insertGenre=$bddCinema->prepare("INSERT INTO genre(nom_genre) VALUES (:nomGenre)");
            $insertGenre->execute([':nomGenre' => $nomGenre]);
        }
        require "view/adminPage.php";
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
        $producersInfo=$bddCinema->prepare("SELECT nom, prenom, r.id_realisateur,sexe,naissance,img
                                            FROM personne p
                                            INNER JOIN realisateur r ON r.id_personne = p.id_personne
                                            WHERE r.id_realisateur=:id");
        
        $producersInfo->execute([':id' => $id]);

        $producersInfo2=$bddCinema->prepare("SELECT nom_film,id_film,film_cover
                                            FROM film f
                                            INNER JOIN realisateur r ON r.id_realisateur = f.id_realisateur
                                            WHERE r.id_realisateur=:id");
        
        $producersInfo2->execute([':id' => $id]);
        require "view/producer.php";
    }
    public function adminPage(){
        $bddCinema = Connect::seConnecter();
    
        
        $realisateurList = $bddCinema->prepare("SELECT nom, prenom, r.id_realisateur FROM personne p INNER JOIN realisateur r ON p.id_personne = r.id_personne");
        $realisateurList->execute();
    
        
        $genreList = $bddCinema->prepare("SELECT * FROM genre");
        $genreList->execute();
        
       require "view/adminPage.php";
    }
    

        public function adminPageActorPost() {
            $bddCinema = Connect::seConnecter();
            var_dump($_POST, $_FILES);
        
            if (isset($_POST['nom'], $_POST['prenom'], $_POST['sexe'], $_POST['naissance'], $_POST['role'])&& isset($_FILES['img'])) {
                $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $naissance = filter_input(INPUT_POST, 'naissance', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $role = $_POST['role'];
                $img = $_FILES['img']['name'];
        
                $uploadDir = 'image\image_acteur';
                $defaultImg = 'image\image_utilisteur.png'; 
        
                if ($_FILES['img']['error'] == 0) {
                    $imgName = $_FILES['img']['name'];
                    $destination = $uploadDir . $imgName;
                    if (move_uploaded_file($_FILES['img']['tmp_name'], $destination)) {
                        $img = $destination;
                    } else {
                        $img = $defaultImg;
                    }
                } elseif ($_FILES['img']['error'] == UPLOAD_ERR_NO_FILE) {
                    $img = $defaultImg;
                } else {
                    $img = $defaultImg;
                }
                
                $personneInfo = $bddCinema->prepare("INSERT INTO personne (nom, prenom, sexe, naissance, img)
                                                     VALUES (:nom, :prenom, :sexe, :naissance, :img)");
                $personneInfo->execute([':nom' => $nom, ':prenom' => $prenom, ':sexe' => $sexe, ':naissance' => $naissance, ':img' => $img]);
        
                $id_personne = $bddCinema->lastInsertId();
        
                if ($role === "acteur") {
                    $personneInfo = $bddCinema->prepare("INSERT INTO acteur (id_personne) VALUES (:id_personne)");
                    $personneInfo->execute([':id_personne' => $id_personne]);
                } else if ($role === "realisateur") {
                    $personneInfo = $bddCinema->prepare("INSERT INTO realisateur (id_personne) VALUES (:id_personne)");
                    $personneInfo->execute([':id_personne' => $id_personne]);
                }
                
                header('Location: index.php?action=adminPage');
                exit; 
            }
            
        }
        

    public function adminPageFilmPost(){
        $bddCinema=Connect::seConnecter();

        if(isset($_POST['nom_film']) && isset($_POST['film_cover']) && isset($_POST['annee']) && isset($_POST['duree']) && isset($_POST['synopsis']) && isset($_POST['note_alloCine']) && isset($_POST['note_imdb']) && isset($_POST['id_realisateur']) && isset($_POST['film_back_img']) && isset($_POST['film_cover']) && isset($_POST['film_title_img'])){
            $nom_film=filter_input(INPUT_POST, 'nom_film', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $film_cover=filter_input(INPUT_POST, 'film_cover', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $annee=filter_input(INPUT_POST, 'annee', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $duree=filter_input(INPUT_POST, 'duree', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $synopsis=filter_input(INPUT_POST,'synopsis', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $note_alloCine=filter_input(INPUT_POST, 'note_alloCine', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $note_imdb=filter_input(INPUT_POST, 'note_imdb', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $id_realisateur=filter_input(INPUT_POST, 'id_realisateur', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $film_back_img=filter_input(INPUT_POST, 'film_back_img', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $film_cover=filter_input(INPUT_POST, 'film_cover', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $film_title_img=filter_input(INPUT_POST, 'film_title_img', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $filmInfo=$bddCinema->prepare("INSERT INTO film (nom_film,film_cover,annee,duree,synopsis,note_alloCine,note_imdb,id_realisateur,film_back_img,film_title_img)
                                        VALUES (:nom_film,:film_cover,:annee,:duree,:synopsis,:note_alloCine,:note_imdb,:id_realisateur,:film_back_img,:film_title_img)");

            $filmInfo->execute([':nom_film' => $nom_film, ':film_cover' => $film_cover, ':annee' => $annee, ':duree' => $duree, ':synopsis' => $synopsis, ':note_alloCine' => $note_alloCine, ':note_imdb' => $note_imdb,  
                                ':id_realisateur' => $id_realisateur, ':film_back_img' => $film_back_img, ':film_cover' => $film_cover, ':film_title_img' => $film_title_img]);
            
            $film_id = $bddCinema->lastInsertId();

            
            $identifierInfo = $bddCinema->prepare("INSERT INTO identifier (id_film, id_genre) VALUES (:id_film, :id_genre)");
        
            
            foreach ($_POST['id_genre'] as $genre_id) {
            $identifierInfo->execute([':id_film' => $film_id,':id_genre' => $genre_id]);
            }
                            
            header('location:index.php?action=adminPage');
        }

    }

    public function deleteFilm(){
        $bddCinema=Connect::seConnecter();
        $id_film = filter_input(INPUT_POST, 'id_film', FILTER_SANITIZE_NUMBER_INT);


        if (isset($_POST['id_film'])) {
            $id_film = $_POST['id_film'];
            
        $deleteFromIdentifier=$bddCinema->prepare("DELETE FROM identifier WHERE id_film = :id_film");
        $deleteFromFilm=$bddCinema->prepare("DELETE FROM film WHERE id_film = :id_film");
        $deleteFromIdentifier->execute([':id_film' => $id_film]);
        $deleteFromFilm->execute([':id_film' => $id_film]);
        

        header('location:index.php?action=filmDeletePage');
       
        }
    } 

    public function filmDeletePage(){
        require "view/filmDeletePage.php";
    }

    public function deleteActor(){//MARCHE PAS
        $bddCinema=Connect::seConnecter();
        $id_actor = filter_input(INPUT_POST, 'id_acteur', FILTER_SANITIZE_NUMBER_INT);

        if (isset($_POST['id_acteur'])){
            $id_actor = $_POST['id_acteur'];

        $deleteFromActor = $bddCinema->prepare("DELETE FROM acteur WHERE id_acteur = :id_acteur;");
        $deleteFromActor->execute([':id_acteur' => $id_actor]);

        
            header('Location: index.php?action=actorDeletePage');
    } else {
        echo "Erreur".var_dump($_POST);
    }
}
    public function actorDeletePage(){
       require "view/actorDeletePage.php";
    }

    public function addCastingActor(){
        $bddCinema=Connect::seConnecter();
        $id_film = filter_input(INPUT_POST, 'id_film', FILTER_SANITIZE_NUMBER_INT);
        $id_acteur = filter_input(INPUT_POST, 'id_acteur', FILTER_SANITIZE_NUMBER_INT);
        $id_role=filter_input(INPUT_POST, 'id_role', FILTER_SANITIZE_NUMBER_INT);

        if($id_film && $id_acteur && $id_role){
            $id_film = $_POST['id_film'];
            $id_acteur = $_POST['id_acteur'];
            $id_role = $_POST['id_role'];

            $castingInfo = $bddCinema->prepare("INSERT INTO jouer (id_film, id_acteur,id_role) VALUES (:id_film, :id_acteur, :id_role)");
            $castingInfo->execute([':id_film' => $id_film, ':id_acteur' => $id_acteur,':id_role' => $id_role]);

            header('Location: index.php?action=filmPage&id='.$id_film);
        }   else {
            echo "Erreur".var_dump($_POST);
        }
    }

    public function deleteActorFromCasting(){
        $bddCinema=Connect::seConnecter();
        $id_casting = filter_input(INPUT_POST, 'id_acteur', FILTER_SANITIZE_NUMBER_INT);
        $id_film = filter_input(INPUT_POST, 'id_film', FILTER_SANITIZE_NUMBER_INT);

        if (isset($_POST['id_acteur']) && isset($_POST['id_film'])) {
            $id_casting = $_POST['id_acteur'];
            $id_film = $_POST['id_film'];

            $deleteFromCasting = $bddCinema->prepare("DELETE FROM jouer WHERE id_acteur = :id_acteur");
            $deleteFromCasting->execute([':id_acteur' => $id_casting]);
        }else {
            echo "Erreur".var_dump($_POST);
        }

        header('Location: index.php?action=filmPage&id='.$id_film);
    } 

    public function deleteProducer(){
        $bddCinema=Connect::seConnecter();
        $id_producer = filter_input(INPUT_POST, 'id_realisateur', FILTER_SANITIZE_NUMBER_INT);
        if (isset($_POST['id_realisateur'])) {
            $id_producer = $_POST['id_realisateur'];

            $deleteFromProducerFilm = $bddCinema->prepare("DELETE FROM realisateur WHERE id_realisateur = :id_realisateur");
            $deleteFromProducerFilm->execute([':id_realisateur' => $id_producer]);

            header( 'location: index.php?action=producerDeletePage' );
        }
    } 
}
?>  

