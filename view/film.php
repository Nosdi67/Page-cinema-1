<?php

session_start();
ob_start();
$title='DOMOVIES';

// Vérifier si l'ID du film est défini dans l'URL
if (isset($_GET['id'])) {
    // Récupérer l'ID du film depuis l'URL
    $film_id = $_GET['id'];
    
require ("requeteFilmPage.php");
}








if (isset($_GET['id'])) {
    // Récupérer l'ID du film depuis l'URL
    $film_id = $_GET['id'];
?>
<main>
	<section>
		<div class="film-page">
			<?php if ($film) { ?>
			<div class="film-page-img">
				<img src="<?php echo $film['film_cover'];?>" alt="Image de couverture du film">
            </div>
				<div class="film-page-img-back">
					<img src="<?php echo $film['film_back_img'];?>" alt="">
					<div class="overlay-back-img"></div>
				</div>
				<div class="title-img">
					<img src="<?php echo $film['film_title_img'];?>" alt="">
				</div>
                <div class="genre-container">
                    <div class="genre">
                        <?php foreach ($genres as $genre): ?>
                        <div class="genreBtn"><?php echo $genre['nom_genre'];?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
				<div class="film-page-img-text">
					<p>
						<?php echo $film['synopsis'];?>
					</p>
					<p>
						<?php echo $film['temps_convert'];?>
					</p>
					<p>
						<?php echo $film['annee'];?>
					</p>
				</div>
			</div>
			<?php } ?>
		</div>
	</section>

    <section>
</main>
<?php } ?>


<?php
$filmPage=ob_get_clean();
require ("template.php"); 
?>
