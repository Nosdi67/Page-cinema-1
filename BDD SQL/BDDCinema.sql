-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour cinema
CREATE DATABASE IF NOT EXISTS `cinema` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cinema`;

-- Listage de la structure de table cinema. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int NOT NULL AUTO_INCREMENT,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_acteur`),
  KEY `id_personne` (`id_personne`),
  CONSTRAINT `FK1_personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.acteur : ~12 rows (environ)
INSERT INTO `acteur` (`id_acteur`, `id_personne`) VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 4),
	(5, 5),
	(6, 6),
	(7, 8),
	(8, 9),
	(9, 10),
	(10, 12),
	(11, 13),
	(12, 14),
	(13, 15),
	(14, 16),
	(15, 17),
	(16, 18);

-- Listage de la structure de table cinema. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int NOT NULL AUTO_INCREMENT,
  `nom_film` varchar(50) DEFAULT NULL,
  `annee` date DEFAULT NULL,
  `duree` int DEFAULT NULL,
  `synopsis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `note_alloCine` float DEFAULT NULL,
  `note_imdb` float DEFAULT NULL,
  `id_realisateur` int DEFAULT NULL,
  `film_back_img` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `film_cover` varchar(250) DEFAULT NULL,
  `film_title_img` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_film`),
  KEY `id_realisateur` (`id_realisateur`),
  CONSTRAINT `FK1_realisateur` FOREIGN KEY (`id_realisateur`) REFERENCES `realisateur` (`id_realisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.film : ~6 rows (environ)
INSERT INTO `film` (`id_film`, `nom_film`, `annee`, `duree`, `synopsis`, `note_alloCine`, `note_imdb`, `id_realisateur`, `film_back_img`, `film_cover`, `film_title_img`) VALUES
	(1, 'Pattaya', '2016-02-24', 130, 'Franky (Gastambide) and Krimo (Malik Bentalha) dream of leaving their grim neighborhood for a trip to the famously sleazy Thai resort of Pattaya.', 2, 4.8, 1, 'image\\Image_film\\189131.webp', 'image\\image_cover\\pattaya.webp', 'image\\image_title\\Pattaya_(film).png'),
	(2, 'Batman', '2022-03-02', 180, 'The film sees Batman, who has been fighting crime in Gotham City for two years, uncover corruption while pursuing the Riddler (Dano), a serial killer who targets Gotham\'s corrupt elite.', 4.1, 7.8, 2, 'image\\Image_film\\push-batman-numero-magazine.webp', 'image\\image_cover\\batman.webp', 'image\\image_title\\The_Batman_(film,_logo).png'),
	(3, 'Le Seigneur des anneaux : Le Retour du roi', '2003-12-17', 180, 'Continuing the plot of the previous film, Frodo, Sam and Gollum make their final way toward Mount Doom to destroy the One Ring, unaware of Gollum\'s true intentions, while Merry, Pippin, Gandalf, Aragorn, Legolas, Gimli and their allies join forces against Sauron and his legions from Mordor.', 4.5, 9, 3, 'image\\Image_film\\MV5BMTI4NzU1NTgyMl5BMl5BanBnXkFtZTcwOTE3NDk2Mw@@._V1_.jpg', 'image\\image_cover\\lotr3.jpg', 'image\\image_title\\lotr3.png'),
	(4, 'Le Seigneur des anneaux: La Communauté de l\'anneau', '2001-12-19', 178, 'Sauron, the Dark Lord, has awakened and threatens to conquer Middle-earth. To stop this ancient evil once and for all, Frodo Baggins must destroy the One Ring in the fires of Mount Doom. Men, Hobbits, a wizard, an Elf, and a Dwarf form a fellowship to help him on his quest.', 4.5, 8.9, 3, 'image\\Image_film\\Dominic-Monaghan-Merry-scene-Elijah-Wood-Frodo.webp', 'image\\image_cover\\lotr1.jpg', 'image\\image_title\\thefellowshipofthering.png'),
	(5, 'Le Seigneur des anneaux : Les Deux Tours', '2002-12-10', 179, 'The surviving members of the Fellowship have split into three groups. Frodo and Sam face many perils on their continuing quest to save Middle-earth by destroying the One Ring in the fires of Mount Doom. Merry and Pippin escape from the Orcs and must convince the Ents to join the battle against evil.', 4.5, 8.8, 3, 'image\\Image_film\\314394.HR_.jpg', 'image\\image_cover\\lotr2.jpg', 'image\\image_title\\thetwotowers.png'),
	(6, 'Les Evadés', '1995-03-01', 142, 'Over the course of several years, two convicts form a friendship, seeking consolation and, eventually, redemption through basic compassion.', 4.5, 9.3, 4, 'image\\Image_film\\16437712.webp', 'image\\image_cover\\les_evades.webp', 'image\\image_title\\1200px-The_Shawshank_Redemption_movie_logo.png');

-- Listage de la structure de table cinema. filmavenir
CREATE TABLE IF NOT EXISTS `filmavenir` (
  `nom_film` varchar(50) DEFAULT NULL,
  `synopsis` varchar(50) DEFAULT NULL,
  `id_film_avenir` int NOT NULL AUTO_INCREMENT,
  `film_cover` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_film_avenir`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.filmavenir : ~0 rows (environ)
INSERT INTO `filmavenir` (`nom_film`, `synopsis`, `id_film_avenir`, `film_cover`) VALUES
	('Gladiator 2', NULL, 1, 'image\\upcoming_movies\\MV5BYTNmMzliMmYtNjEyZS00NGM3LWEzYWEtNmI3MGJjMTIzZjI4XkEyXkFqcGdeQXVyMTI3NjAxODc0._V1_.jpg'),
	('Deadpool3 ', NULL, 2, 'image\\upcoming_movies\\dejb9n5-50b9c823-3018-4d7e-8622-158f2f00ef6b.jpg');

-- Listage de la structure de table cinema. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL AUTO_INCREMENT,
  `nom_genre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.genre : ~6 rows (environ)
INSERT INTO `genre` (`id_genre`, `nom_genre`) VALUES
	(1, 'Comedie'),
	(2, 'Drame'),
	(3, 'Action'),
	(4, 'Crime'),
	(5, 'Fantasy'),
	(6, 'Aventure');

-- Listage de la structure de table cinema. identifier
CREATE TABLE IF NOT EXISTS `identifier` (
  `id_film` int DEFAULT NULL,
  `id_genre` int DEFAULT NULL,
  KEY `id_film` (`id_film`),
  KEY `id_genre` (`id_genre`),
  CONSTRAINT `FK1_id_film2` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `FK2_id_genre2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.identifier : ~8 rows (environ)
INSERT INTO `identifier` (`id_film`, `id_genre`) VALUES
	(1, 1),
	(1, 2),
	(2, 3),
	(2, 4),
	(3, 5),
	(3, 6),
	(4, 5),
	(4, 6),
	(5, 5),
	(5, 6),
	(6, 2);

-- Listage de la structure de table cinema. jouer
CREATE TABLE IF NOT EXISTS `jouer` (
  `id_film` int DEFAULT NULL,
  `id_acteur` int DEFAULT NULL,
  `id_role` int DEFAULT NULL,
  KEY `id_film` (`id_film`),
  KEY `id_acteur` (`id_acteur`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `FK1_id_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `FK2_id_acteur` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`),
  CONSTRAINT `FK3_id_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.jouer : ~21 rows (environ)
INSERT INTO `jouer` (`id_film`, `id_acteur`, `id_role`) VALUES
	(1, 1, 1),
	(1, 2, 2),
	(1, 3, 3),
	(2, 4, 4),
	(2, 5, 5),
	(2, 6, 6),
	(3, 7, 7),
	(3, 9, 8),
	(3, 8, 8),
	(4, 10, 10),
	(4, 12, 12),
	(1, 12, 12),
	(4, 11, 11),
	(4, 13, 13),
	(5, 7, 7),
	(5, 9, 8),
	(5, 9, 8),
	(5, 11, 11),
	(5, 12, 12),
	(6, 14, 14),
	(6, 15, 15),
	(6, 16, 16);

-- Listage de la structure de table cinema. personne
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `sexe` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `naissance` date DEFAULT NULL,
  `img` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.personne : ~19 rows (environ)
INSERT INTO `personne` (`id_personne`, `nom`, `prenom`, `sexe`, `naissance`, `img`) VALUES
	(1, 'Gastambide', 'Franck', 'M', '1978-10-31', 'image\\image_acteur\\franck_gstambide.jpg'),
	(2, 'Toubali', 'Anouar', 'M', '1987-02-19', 'C:\\laragon\\www\\Page Cinema\\image\\image_acteur\\Toubali.jpg'),
	(3, 'Bentalha', 'Malik', 'M', '1989-03-01', 'image\\image_acteur\\Bentalha.jpg'),
	(4, 'Pattinson', 'Robert', 'M', '1986-05-13', 'image\\image_acteur\\Robert_pattinson.jpg'),
	(5, 'Kravitz', 'Zoe', 'F', '1988-12-01', 'image\\image_acteur\\zoe_kravitz.jpg'),
	(6, 'Sarkis', 'Andy', 'M', '1964-04-20', 'image\\image_acteur\\andy_sarkis.jpg'),
	(7, 'Reeves', 'Matt', 'M', '1966-04-27', 'image\\image_acteur\\matt_reeves.jpg'),
	(8, 'Mortensen', 'Viggo', 'M', '1958-10-20', 'image\\image_acteur\\viggo_mortinson.jpg'),
	(9, 'McKellen', 'Ian', 'M', '1939-05-25', 'image\\image_acteur\\ian_mckalen.jpg'),
	(10, 'Lee', 'Christopher', 'M', '1922-05-27', 'image\\image_acteur\\christopher_lee.jpg'),
	(11, 'Jakson', 'Peter', 'M', '1961-10-31', 'image\\image_acteur\\peter jakson.jpg'),
	(12, 'Wood', 'Elijah', 'M', '1981-01-28', 'image\\image_acteur\\elijah wood.jpg'),
	(13, 'Astin', 'Sean', 'M', '1971-02-25', 'image\\image_acteur\\sean_astin.jpg'),
	(14, 'Bloom', 'Orlando', 'M', '1977-02-13', 'image\\image_acteur\\orlando_bloom.jpg'),
	(15, 'Bean', 'Sean', 'M', '1959-04-17', 'image\\image_acteur\\sean_bean.jpg'),
	(16, 'Freeman', 'Morgan', 'M', '1937-06-01', 'image\\image_acteur\\morgan freemna.jpg'),
	(17, 'Brown', 'Clancy', 'M', '1959-01-05', 'image\\image_acteur\\clancy_brown.jpg'),
	(18, 'Robbins', 'Tim', 'M', '1958-10-16', 'image\\image_acteur\\tim_Robbinson.jpg'),
	(19, 'Darabont', 'Frank', 'M', '1959-01-28', 'image\\image_acteur\\darabont_frank.jpg');

-- Listage de la structure de table cinema. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_realisateur` int NOT NULL AUTO_INCREMENT,
  `id_personne` int DEFAULT NULL,
  PRIMARY KEY (`id_realisateur`),
  KEY `id_personne` (`id_personne`),
  CONSTRAINT `FK1_personne2` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.realisateur : ~0 rows (environ)
INSERT INTO `realisateur` (`id_realisateur`, `id_personne`) VALUES
	(1, 1),
	(2, 7),
	(3, 11),
	(4, 19);

-- Listage de la structure de table cinema. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `nom_role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.role : ~12 rows (environ)
INSERT INTO `role` (`id_role`, `nom_role`) VALUES
	(1, 'Franky'),
	(2, 'Karim'),
	(3, 'Krimo'),
	(4, 'Batman'),
	(5, 'Cat Woman'),
	(6, 'Alfred'),
	(7, 'Aragorn'),
	(8, 'Saroumane'),
	(9, 'Gendalf'),
	(10, 'Frodon'),
	(11, 'Sam'),
	(12, 'Legolas'),
	(13, 'Boromir'),
	(14, 'Ellis Boyd \'Red\' Redding'),
	(15, 'Capitain Hadley'),
	(16, 'Andy Dufresne');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
