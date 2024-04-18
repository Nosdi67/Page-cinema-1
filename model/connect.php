<?php

namespace Model;

abstract class Connect {

    const HOST = 'localhost';
    const DB = 'cinema';
    const USER = 'root';
    const PASS = "";

    public static function seConnecter(){
        try{
            return new \PDO('mysql:host='. self::HOST. ';dbname='. self::DB. ';charset=utf8', self::USER, self::PASS);
        } catch(\PDOException $ex){
            return $ex->getMessage();
        }
    }
    
    public static function getFilmDetailsById($film_id) {
 
    $pdo=self::seConnecter();

    // Préparez la requête SQL pour sélectionner les détails du film en fonction de son ID
    $query = $pdo->prepare("SELECT * FROM film WHERE id_film = :film_id");
    
    // Exécutez la requête en liant les paramètres
    $query->execute(array(':film_id' => $film_id));

    // Récupérez les détails du film sous forme de tableau associatif
    $filmDetails = $query->fetch(\PDO::FETCH_ASSOC);

    return $filmDetails;
}
    public static function getActorById($actor_id){
        $pdo=self::seConnecter();

        $query = $pdo->prepare("SELECT * 
                                FROM personne
                                INNER JOIN acteur ON personne.id_personne = acteur.id_personne
                                WHERE acteur.id_acteur = :actor_id");

        $query->execute(array(':actor_id'=> $actor_id));

        $actorRequete = $query->fetch(\PDO::FETCH_ASSOC);

        return $actorRequete;
        
    }

}

?>