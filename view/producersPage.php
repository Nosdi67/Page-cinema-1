<?php 
session_start();
ob_start();
$producers=$producersInfo->fetchAll();
$title='DOMOVIES';
?>
<main>
    <section id="actorsNav">
            <header id="actorNavHeader"><strong>Actors</strong></header>
            <div id="actorNav">
            <form action="">
                <ul>
                    <li>
                        <select name="select-gender" id="dropdownGender" control-id="ControlID-1">
                            <option>Genre</option>
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                        </select>
                    </li>
                    <li>
                        <div class="searchProducer">
                            <label for="producer">Actor</label><input type="search" id="producer" placeholder="Name" control-id="ControlID-6">
                        </div>
                    </li>
                    <li>
                        <label for="start">Year</label><input type="date" id="start" name="dateSelector" value="2000-03-22" min="2000-03-22" max="2024-03-22" control-id="ControlID-2">-<input type="date" id="start" name="dateSelector" value="2024-03-22" min="2000-03-23" max="2024-03-22" control-id="ControlID-3">
                    </li>
                </ul>
            </form>
        </div>     
    </section>
    <section class="producersSection">
        <?php foreach($producers as $producer): ?>
            <div class="producerCard">
                <div class="producerCardImg">
                    <img src="<?php echo $producer['img'] ?>" alt="image de <?php echo $producer['prenom']. ' '.$producer['nom']; ?>">
                </div>
                <p><?php echo $producer['prenom']. ' '.$producer['nom']; ?></p>
                <div class="producerCardBtn">
                    <a href="index.php?action=producerPage&id=<?php echo $producer['id_realisateur']; ?>">See more</a>
                </div>
            </div>
            <?php endforeach; ?>
    </section>
</main>



<?php
$content = ob_get_clean();
require("view/template.php");
?>