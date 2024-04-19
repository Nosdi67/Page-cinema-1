<?php
session_start();
ob_start();
$title='DOMOVIES-Genres';
// var_dump($_POST);die;
?>
    <form action="index.php?action=addGenre" method="POST">
        <label for="nom_genre">Nom du genre:</label>
        <input type="text" name="nom_genre" id="nom_genre">
        <button type="submit">Ajouter le genre</button>
    </form>
<?php
$content=ob_get_clean();
require ("view/template.php");
?>