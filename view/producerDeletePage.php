<?php

ob_start();
$title = 'DOMOVIES';
?>

<main>
    <section class="filmSupprime">
        <header class="filmSupprimeHeader">Producer Deleted Successfully!</header>
        <a class="revenirHomeBtn" href="index.php?action=homePage">Back to Home Page</a>
    </section>
</main>

<?php
$content = ob_get_clean();
require("view/template.php");
?>

?>