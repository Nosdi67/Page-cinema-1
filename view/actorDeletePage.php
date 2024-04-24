<?php	
session_start();
ob_start();
$title = 'DOMOVIES';
?>

<main>
    <section class="filmSupprime">
        <header class="filmSupprimeHeader">acteur Supprimé</header>
        <a class="revenirHomeBtn" href="index.php?action=homePage">Revenir a la page d'acceuil</a>
    </section>
</main>

<?php
$content = ob_get_clean();
require("view/template.php");
?>
