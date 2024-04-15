<?php
$bddCinema=new PDO('mysql:host=localhost;dbname=cinema;charset=utf8','root','');
$query2=$bddCinema->query("SELECT nom_film,synopsis,film_cover
                            FROM filmavenir
                            ");
$query=$bddCinema->query("SELECT film.nom_film,film.annee,personne.prenom,personne.nom,film_back_img,synopsis,film_cover,film_title_img,id_film,
                        CONCAT(FLOOR(film.duree/ 60), ' Heures et ', MOD(film.duree, 60),'minutes') AS temps_convert
                        FROM film
                        INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
                        INNER JOIN personne ON personne.id_personne = realisateur.id_personne");
$query->execute();
$query2->execute();
$upcomingFilms=$query2->fetchAll(PDO::FETCH_ASSOC);
$films=$query->fetchAll(PDO::FETCH_ASSOC);
?>
