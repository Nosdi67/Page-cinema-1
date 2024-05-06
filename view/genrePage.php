<?php
 
 ob_start();
 $genres=$genreRequete->fetchAll();
 $title='DOMOVIES-Genres';
 ?>
 <div class="addgenreBtn">
    <a href="index.php?action=addGenreForm">ADD Genre</a>
 </div>


<div class="genreContainer">
    <div class="genre">
        <?php foreach ($genres as $genre): ?>
        <div class="genreBtn"><p><?php echo $genre['nom_genre'];?></p></div>
        <?php endforeach; ?>
    </div>
</div>


<?php
$content = ob_get_clean();
require("view/template.php");
?>