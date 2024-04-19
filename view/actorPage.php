<?php 
 session_start();
 ob_start();
 $actorFilms=$actorAndFilm->fetchAll();
 $actors=$actorInfo->fetchAll();
 $title='DOMOVIES';
//  var_dump($actorFilms);die; 
?>
<main>
    <section id="actorBioSection">
        <?php foreach ($actors as $actor): ?>
        <div class="actorBio">
            <div class="actorBioImg">
                <img src="<?php echo $actor['img'];?>" alt="Image de <?php echo $actor['prenom']. ' '.$actor['nom']; ?>"/>
            </div>
            <p><?php echo $actor['prenom'].' '.$actor['nom']; ?></p>
            <p>Nee le <?php echo $actor['naissance']; ?></p>
        </div>
        <div class="actorLorem">
            <h2>Biographie</h2>
            <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugiat deleniti tempora ab sit. Incidunt ullam, magni voluptatibus magnam alias necessitatibus doloribus culpa tempora adipisci dignissimos repudiandae dicta ex veritatis. Expedita enim libero temporibus facilis laudantium quis aliquid cupiditate deleniti odit nostrum, aliquam consequuntur facere! Hic eos, rem cupiditate ut minima dolores deserunt eius commodi molestias, aliquam aliquid dolorem soluta quam tempora vitae harum quo aperiam enim. Dolores quisquam et vitae doloribus ad necessitatibus, architecto dolorem amet dolore laudantium tenetur, consectetur ratione repudiandae quidem nemo tempora ducimus. Veritatis molestias quia molestiae quaerat hic excepturi ducimus et sit, eius incidunt officia odio.
            </p>
        </div>
        <?php endforeach ?>
    </section>
    <section id="actorFilmSection">
        <header>Les films de <?php echo $actorFilm['prenom']. ' '.$actorFilm['nom']; ?></header>
        <?php foreach ($actorFilms as $actorFilm): ?>
        <div class="actorMovieCards">
            <div class="MovieCardImg">
               <img  src="<?php echo $actorFilm['film_cover']; ?>" alt="image du film <?php echo $actorFilm['nom_film']; ?>">
            </div>
            <div class="actorFilmseeMore">
                <a href="index.php?action=filmPage&id=<?php echo $actorFilm['id_film'] ?>">See more</a>
            </div>
      </div>
      <?php endforeach; ?>
    </section>
</main>




<?php
$content = ob_get_clean();
require("view/template.php");
?>