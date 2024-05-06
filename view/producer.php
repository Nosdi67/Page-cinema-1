<?php
ob_start();
$producers=$producersInfo->fetch();
$actorFilms=$producersInfo2->fetchAll();
$title='DOMOVIES';
// var_dump($actorFilms);die;

$img = !empty($producers['img']) ? $producers['img'] :"image\image utilisteur.png";
?>

<main>
    <section id="actorBioSection">
        <div class="actorBio">
            <div class="actorBioImg">
                <img src="<?php echo $img;?>" alt="Image de <?php echo $producers['prenom']. ' '.$producers['nom']; ?>"/>
            </div>
            <p><?php echo $producers['prenom'].' '.$producers['nom']; ?></p>
            <p>Nee le <?php echo $producers['naissance']; ?></p>
        </div>
        <div class="actorLorem">
            <h2>Biographie</h2>
            <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugiat deleniti tempora ab sit. Incidunt ullam, magni voluptatibus magnam alias necessitatibus doloribus culpa tempora adipisci dignissimos repudiandae dicta ex veritatis. Expedita enim libero temporibus facilis laudantium quis aliquid cupiditate deleniti odit nostrum, aliquam consequuntur facere! Hic eos, rem cupiditate ut minima dolores deserunt eius commodi molestias, aliquam aliquid dolorem soluta quam tempora vitae harum quo aperiam enim. Dolores quisquam et vitae doloribus ad necessitatibus, architecto dolorem amet dolore laudantium tenetur, consectetur ratione repudiandae quidem nemo tempora ducimus. Veritatis molestias quia molestiae quaerat hic excepturi ducimus et sit, eius incidunt officia odio.
            </p>
        </div>
    </section>
    <section id="actorFilmSection">
        <header class="filmSectionHeader">Les films realisés par <?php echo $producers['prenom'].' '.$producers['nom']; ?></header>
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

    <section>
            <div class="deleteForm">
            <form  method="POST" action="index.php?action=deleteProducer">
                <input type="hidden" name="id_realisateur" value="<?php echo $producers['id_realisateur']; ?>">
                <input type="submit" value="Delete producer <?php echo $producers['prenom'].' '.$producers['nom'];?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet acteur ?');">
            </form>
            </div>
    </section>
</main>

<?php
$content = ob_get_clean();
require("view/template.php");
?>