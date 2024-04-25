<?php
session_start();
ob_start();
$title = 'DOMOVIES-';
$genres = $queryGenre->fetchAll(PDO::FETCH_ASSOC);
$filmDetails = $query->fetch(PDO::FETCH_ASSOC);
$actors=$actorInfo->fetchALL(PDO::FETCH_ASSOC);
$actorsSelects=$actorsSelect->fetchAll(PDO::FETCH_ASSOC);
$roleList=$roleSelect->fetchAll(PDO::FETCH_ASSOC);
$films=$film->fetchAll(PDO::FETCH_ASSOC);
$castingList=$filmCasting->fetchAll(PDO::FETCH_ASSOC);
// var_dump($genres);
// var_dump($actors);die;
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
               <div class="genreBtn">
                  <p><?php echo $genre['nom_genre'];?></p>
               </div>
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
            <div class="navBtn"><a href=""><i class="fa-regular fa-heart"></i></div>
            </a>
            <div class="navBtn"><a href=""><i class="fa-solid fa-share-nodes"></i></div>
            </a>
            <div class="navBtn"><a href=""><i class="fa-solid fa-film"></i></div>
            </a>
         </div>
         <?php } else { ?>
         <p>Aucun détail de film trouvé.</p>
         <?php } ?>
      </div>
   </section>
   <section>
      <form method="POST" action="index.php?action=deleteFilm">
         <input type="hidden" name="id_film" value="<?php echo $filmDetails['id_film']; ?>">
         <input type="submit" value="Supprimer Le film <?php echo $filmDetails['nom_film'];?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce film ?');">
      </form>
   </section>
   <section>
      <div class="actorsDiv">
         <header class="actorDivHeader"></header>
         <?php foreach ($actors as $actor): ?>      
         <div class="actorCard">
            <div class="actorCardImg">
               <img src="<?php echo $actor['img']; ?>" alt="image de <?php echo $actor['prenom']. ' '.$actor['nom']; ?>"/>
            </div>
            <div class="actorSeeMore">
               <a href="index.php?action=actorPage&id=<?php echo $actor['id_acteur'] ?>">See more</a>
            </div>
            <div class="deleteBtn">
               <form action="index.php?action=deleteActorFromCasting" method="post">
                  <input type="hidden" name="id_acteur" value="<?php echo $actor['id_acteur'] ?>">
                  <input type="hidden" name="id_film" value="<?php echo $actor['id_film'] ?>">
                  <button type="submit"><i class="fa-solid fa-trash"></i></button>
               </form>
            </div>
         </div>
         <?php endforeach; ?>
      </div>
   </section>
   <section id="formSection">
      <button id=addActorbtn>Ajouter un Acteur au casting</button>  
      <div id="addActor" style="display: none;">
         <form method="post" action="index.php?action=addCastingActor">
            <label for="film">Choisir un film:</label>
            <select name="id_film" id="film">
               <?php foreach ($films as $film): ?>
               <option value="<?php echo htmlspecialchars($film['id_film']);?>">
                  <?php echo  htmlspecialchars($film['nom_film']); ?>
               </option>
               <?php endforeach; ?>
            </select>
            <label for="acteur">Choisir des acteurs:</label>
            <select name="id_acteur" id="acteur" required>
               <?php foreach ($actorsSelects as $actorsSelect): ?>
               <option value="<?php echo htmlspecialchars($actorsSelect['id_acteur']);?>">
                  <?php echo  htmlspecialchars($actorsSelect['prenom'].' '.$actorsSelect['nom']); ?>
               </option>
               <?php endforeach; ?>            
            </select>
            <label for="role">Choisir le role:</label>
            <select name="id_role" id="role" required>
               <?php foreach ($roleList as $role): ?>
               <option value="<?php echo htmlspecialchars($role['id_role']);?>">
                  <?php echo htmlspecialchars($role['nom_role']);?>
               </option>
               <?php endforeach ; ?>
            </select>
            <button type="submit">Ajouter au casting</button>
         </form>
      </div>
   </section>
</main>

<script>
document.getElementById('addActorbtn').addEventListener('click', function(){

        if(document.getElementById('addActor').style.display === 'none'){
            document.getElementById('addActor').style.display = 'block';
        } else {
            document.getElementById('addActor').style.display = 'none';
        }
}); 

</script>

<?php
$content = ob_get_clean();
require("view/template.php");
?>
