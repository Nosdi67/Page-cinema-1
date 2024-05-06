<?php

ob_start();
$title='DOMOVIES-Movies';
$filmInfos = $query->fetchAll();
?>

<main>
    <section>
        <header class="filmHeader">Movies</header>
        <div class="filmBar">
            <form action="">
                <ul>
                    <li>
                        <select name="select-genre" id="dropdownGenre">
                            <option>Genre</option>
                            <option value="Action">Action</option>
                            <option value="Adventure">Adventure</option>
                            <option value="Animation">Animation</option>
                            <option value="Drame">Drame</option>
                        </select>
                    </li>
                    <li>
                        <label for="start">Year</label><input type="date" id="start" name="dateSelector" value="2000-03-22" min="2000-03-22" max="2024-03-22" >-<input type="date" id="start" name="dateSelector" value="2024-03-22" min="2000-03-23" max="2024-03-22">
                    </li>
                    <li>
                            <div class="ratings1">
                                <label for="rating">Rating</label><input type="numbers" id="rating" min="1" max="10" placeholder="Up to 10"><img class="alloCineFilmBar" src="image/640px-Allociné_Logo_(2019).svg.png" alt="">
                            </div>
                    </li>
                    <li>
                        <div class="ratings2">
                            <label for="rating">Rating</label><input type="numbers" id="rating" min="1" max="10" placeholder="Up to 5"><img class="imdbFilmBar" src="image/IMDB_Logo_2016.svg.png" alt="">
                        </div>
                    </li>
                    <li>
                        <div class="searchProducer">
                            <label for="producer">Producer</label><input type="search" id="producer" placeholder="Name">
                        </div>
                    </li>
                    <li>
                        <div class="searchBtn"> 
                            <input type="submit" name="Submit button" id="submit" value=" "><i class="fa-solid fa-magnifying-glass fa-xl"></i>
                        </div>
                    </li>
                </ul>
            </form>
        </div>
    </section>
    
    <section>
   <div id="movieBlock">
      <?php foreach ($filmInfos as $filmInfo):?>
      <div id="movieCard">
            <div class="movieCardOverlay">
                <p class="cardSynopsis"><?php echo $filmInfo['synopsis'] ?></p>
            </div>
            <div class="MovieCardImg">
               <img  src="<?php echo $filmInfo['film_cover']; ?>" alt="image du film <?php echo $filmInfo['nom_film']; ?>">
            </div>
         <div id="raiting">
            <div class="raitingInfo">
               <div class="raitingTxt">
                  <p ><?php echo $filmInfo['note_alloCine'] ?> <i class="fa-solid fa-star" style="color: #ffd700;"></i></p>
                  <img class="IMdbLogo" src="./image/640px-Allociné_Logo_(2019).svg.png" alt="logo alloCiné" >
               </div>
               <div class="raitingTxt">
                  <p ><?php echo $filmInfo['note_imdb'] ?><i class="fa-solid fa-star" style="color: #ffd700;"></i></p>
                  <img class="alloCineLogo" src="./image/IMDB_Logo_2016.svg.png" alt="logo IMdb" >
               </div>
               <div class="seeMore">
                  <a href="index.php?action=filmPage&id=<?php echo $filmInfo['id_film'] ?>">See more</a>
               </div>
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