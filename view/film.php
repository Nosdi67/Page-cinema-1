<?php
session_start();
ob_start();
$title = 'DOMOVIES-';
$genres = $queryGenre->fetchAll(PDO::FETCH_ASSOC);
$filmDetails = $query->fetch(PDO::FETCH_ASSOC);
// var_dump($genres);
// var_dump($filmDetails);die;
?>
<main>
    <section>
        <div class="film-page">
            <?php if ($filmDetails) { ?>
            <div class="film-page-img">
                <img src="<?php echo $filmDetails['film_cover'];?>" alt="Image de couverture du film">
            </div>
            <div class="film-page-img-back">
                <img src="<?php echo $filmDetails['film_back_img'];?>" alt="">
                <div class="overlay-back-img"></div>
            </div>
            <div class="title-img">
                <img src="<?php echo $filmDetails['film_title_img'];?>" alt="">
            </div>
            <div class="genre-container">
                <div class="genre">
                    <?php foreach ($genres as $genre): ?>
                    <div class="genreBtn"><p><?php echo $genre['nom_genre'];?></p></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="film-page-img-text">
                <p>
                    <?php echo $filmDetails['synopsis'];?>
                </p>
                <p>
                    <?php echo $filmDetails['temps_convert'];?>
                </p>
                <p>
                    <?php echo $filmDetails['annee'];?>
                </p>
            </div>
            <div class="threeNav">
                <div class="navBtn"><a href=""><i class="fa-regular fa-heart"></i></div></a>
                <div class="navBtn"><a href=""><i class="fa-solid fa-share-nodes"></i></div></a>
                <div class="navBtn"><a href=""><i class="fa-solid fa-film"></i></div></a>
            </div>
            <?php } else { ?>
            <p>Aucun détail de film trouvé.</p>
            <?php } ?>
        </div>
    </section>
</main>

<?php
$content = ob_get_clean();
require("view/template.php");
?>
