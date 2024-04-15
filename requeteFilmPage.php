<?php
$bddCinema = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', '');
$query = $bddCinema->prepare("SELECT film.nom_film, film.annee, personne.prenom, personne.nom, film_back_img, synopsis, film_cover, film_title_img, id_film,
                 CONCAT(FLOOR(film.duree/ 60), ' Heures et ', MOD(film.duree, 60),'minutes') AS temps_convert
                 FROM film
                 INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
                 INNER JOIN personne ON personne.id_personne = realisateur.id_personne
                 WHERE id_film = ?");
$query->execute([$film_id]);
$film = $query->fetch(PDO::FETCH_ASSOC);

$queryGenre= $bddCinema->prepare("SELECT nom_genre
                                FROM genre
                                INNER JOIN identifier ON identifier.id_genre = genre.id_genre
                                INNER JOIN film ON identifier.id_film = film.id_film
                                WHERE film.id_film= ?");
$queryGenre->execute([$film_id]);
$genre=$queryGenre->fetch(PDO::FETCH_ASSOC);
?>








