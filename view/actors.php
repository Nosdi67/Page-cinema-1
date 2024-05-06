<?php

 ob_start();
 $actors=$actorRequete->fetchAll();
 $title='DOMOVIES-Actors';
//  var_dump($actors);die;

?>

<main id="mainSection">
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
    <section id="actorsSection">
        <?php foreach($actors as $actor): ?>
        <div class="actorCard">
            <div class="actorCardImg">
                <img src="<?php echo $actor['img'] ?>" alt="image de <?php echo $actor['prenom']. ' '.$actor['nom']; ?>">
            </div>
            <p><?php echo $actor['prenom']. ' '.$actor['nom'];?></p>
            <div class="actorCardBtn">
                <a href="index.php?action=actorPage&id=<?php echo $actor['id_acteur']; ?>">See more</a>
            </div>
        </div>
        <?php endforeach; ?>
    </section>
    
</main>


<?php 
$content = ob_get_clean();
require("view/template.php");
?>