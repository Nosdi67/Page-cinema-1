<?php
session_start();
ob_start();
$title='DOMOVIES-Genres';
$genres = $genreList->fetchAll();
$realisateurs = $realisateurList->fetchAll();
// var_dump($realisateurs);die;
?>

<main>
   <section>
      <header>Choose your action</header>
      <button id="btnActeur">Personne</button>
      <button id="btnFilm">Film</button>
      <button id=btnGenre>Genre</button>
   </section>
   <!-- ------------------Acteur Form--------------------- -->
   <section>
      <div class="acteurForm" style="display: none;">
         <form action="index.php?action=adminPageActorPost" method="POST">
            <fieldset>
               <legend>Informations de l'Acteur</legend>

               <label for="role">Rôle:</label>
                <select name="role" id="role" required>
                <option value="acteur">Acteur</option>
                <option value="realisateur">Producteur</option>
                </select><br><br>
               
               <label for="nom">Nom:</label>
               <input type="text" id="nom" name="nom" required><br><br>
               
               <label for="prenom">Prénom:</label>
               <input type="text" id="prenom" name="prenom" required><br><br>
               
               <label for="sexe">Sexe:</label>
               <select id="sexe" name="sexe" required> 
                  <option value="Homme">Homme</option>
                  <option value="Femme">Femme</option>
               </select><br><br>
               
               <label for="naissance">Date de Naissance:</label>
               <input type="date" id="naissance" name="naissance" required><br><br>
               
               <label for="img">Image:</label>
               <input type="file" id="img" name="img"><br><br>
               
               <button type="submit">Valider</button>
            
            </fieldset>
         </form>
      </div>
   </section>
   <!---------------------------- Film Form ------------------------->
   <section>
      <div class="filmForm" style="display: none;">
        <form action="index.php?action=adminPageFilmPost" method="POST">
         <fieldset>
            <legend>Films et Rôles</legend>
               
               <label for="nom_film">Nom du Film*:</label>
               <input type="text" id="nom_film" name="nom_film" required><br><br>
               
               <label for="id_realisateur">Id du réalisateur*:</label>
                    <select id="id_realisateur" name="id_realisateur" required>
                            <?php foreach ($realisateurs as $realisateur): ?>
                            <option value="<?php echo htmlspecialchars($realisateur['id_realisateur']);?>">
                            <?php echo htmlspecialchars($realisateur['prenom']).' '. htmlspecialchars($realisateur['nom']);?>
                            </option>
                            <?php endforeach; ?>
                    </select><br><br>

                <label for="id_genre">Genre du Film*:</label>
                <select id="id_genre" name="id_genre" required>
                    <?php foreach ($genres as $genre): ?>
                        <option value="<?php echo htmlspecialchars($genre['id_genre']);?>">
                        <?php echo htmlspecialchars($genre['nom_genre']);?>
                        </option>
                        <?php endforeach; ?>
                        </select><br><br>
               
               <label for="film_cover">Affiche du Film:</label>
               <input type="file" id="film_cover" name="film_cover"><br><br>
               
               <label for="duree">Durée du Film*:</label>
               <input type="number" id="duree" name="duree" required><br><br>

                <label for="annee">Année de sortie*:</label>
                <input type="date" id="annee" name="annee" required><br><br>
               
               <label for="film_back_img">Background du Film:</label>
               <input type="file" id="film_back_img" name="film_back_img"><br><br>
               
               <label for="synopsis">Synopsis:</label>
               <input type="text" id="synopsis" name="synopsis"><br><br>
               
               <label for="note_alloCine">Note Allo Ciné*:</label> 
               <input type="number" min="1" max="5" id="note_alloCine" name="note_alloCine" required><br><br>

               <label for="note_imdb">Note IMDB*:</label>
               <input type="number" min="1" max="5" id="note_imdb" name="note_imdb" required><br><br>

               <label for="film_title_img">Image du titre:</label>
               <input type="file" id="film_title_img" name="film_title_img"><br><br>
            
               <input type="submit" id="submitBtn" value="Valider">
            </fieldset>
         </form>
      </div>
   </section>
   <!---------------------------- Genre Form ------------------------->
   <section>
    <div class="genreForm" style="display: none;">
    <form action="index.php?action=adminPageGenrePost" method="POST">
        <fieldset>

            <legend>Genre</legend>
        <label for="nom_genre">Nom du genre:</label>
        <input type="text" name="nom_genre" id="nom_genre">
        <button type="submit">Ajouter le genre</button>
        
        </fieldset>
    </form>
    </div>
    </section>
</main>


<script>
document.getElementById('btnActeur').addEventListener('click', function() {
    document.querySelector('.acteurForm').style.display = 'block';
    document.querySelector('.filmForm').style.display = 'none';
    document.querySelector('.genreForm').style.display = 'none';
});

document.getElementById('btnFilm').addEventListener('click', function() {
    document.querySelector('.acteurForm').style.display = 'none';
    document.querySelector('.filmForm').style.display = 'block';
    document.querySelector('.genreForm').style.display = 'none';

});

document.getElementById('btnGenre').addEventListener('click', function() {
    document.querySelector('.acteurForm').style.display = 'none';
    document.querySelector('.filmForm').style.display = 'none';
    document.querySelector('.genreForm').style.display = 'block';
});
</script>



<?php
$content=ob_get_clean();
require ("view/template.php");
?>