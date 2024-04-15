<?php
session_start();
ob_start();
$title='DOMOVIES-Movies';
$filmInfos = $query->fetchAll();
?>

<main>
    <section>
        <div id="movieBlock">
            <?php foreach ($filmInfos as $filmInfo):?>
            <div id="movieCard">
                <div class="MovieCardImg">
                    <img  src="<?php echo $filmInfo['film_cover']; ?>" alt="image du film <?php echo $filmInfo['nom_film']; ?>">
                </div>
                <div id="raiting">
                    <div class="raitingInfo">
                        <div class="raitingTxt">
                    <p ><?php echo $filmInfo['note_alloCine'] ?></p>
                        </div>
                    <img class="IMdbLogo" src="./image/640px-Allociné_Logo_(2019).svg.png" alt="logo alloCiné" >
                        <div class="raitingTxt">
                    <p ><?php echo $filmInfo['note_imdb'] ?></p>
                        </div> 
                    <img class="alloCineLogo" src="./image/IMDB_Logo_2016.svg.png" alt="logo IMdb" >
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>














<?php
$content=ob_get_clean();
require("view/template.php");
?>