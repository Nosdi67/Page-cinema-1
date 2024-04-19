<?php
   session_start();
   ob_start();
   $films = $query->fetchAll();
   $upcomingFilms = $query2->fetchAll();
   $title='DOMOVIES';
   
   ?>
<main id="mainSection">
   <section>
   <?php 
      foreach ($films as $film):
      ?>
   <div class="slide-container">
      <div class="custom-slider fade slideRight">
         <div class="slide-img-cover-div">
            <img class="slide-img-cover" src="<?php echo $film['film_cover']; ?>">
         </div>
         <div class="slide-img-div">
            <div class="seeMoreBtnDiv">
               <a class="seeMoreBtn" href="index.php?action=filmPage&id=<?php echo $film['id_film']; ?>">See More</a>
            </div>
            <img class="slide-img" src="<?php echo $film['film_back_img']; ?>">
            <img class="slide-title-img" src="<?php echo $film['film_title_img']; ?>">
            <div class="overlay">
               <div>
                  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                  <a class="next" onclick="plusSlides(1)">&#10095;</a>
               </div>
            </div>
         </div>
         <div class="slide-text"><?php echo $film['synopsis']?>
         </div>
      </div>
      <?php endforeach; ?>
   </div>
   <br>
   <div class="slide-dot">
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      <span class="dot" onclick="currentSlide(3)"></span>
      <span class="dot" onclick="currentSlide(4)"></span>
      <span class="dot" onclick="currentSlide(5)"></span>
      <span class="dot" onclick="currentSlide(6)"></span>
   </div>
   <div id="UpcomingMovies">
      <h2>Upcoming Movies</h2>
      <div class="slideshow">
         <?php foreach ($upcomingFilms as $index => $upcomingFilm): ?>
         <div class="slide 
            <?php echo ($index === 0) ? 'main-slide' : ($index === 1 ? 'prev-slide' : 'next-slide'); ?>">
            <img src="
               <?php echo $upcomingFilm['film_cover']; ?>" alt="
               <?php echo $upcomingFilm['nom_film']; ?>">
            <h3>
               <?php echo $upcomingFilm['nom_film']; ?>
            </h3>
            <p>
               <?php echo $upcomingFilm['synopsis']; ?>
            </p>
         </div>
         <?php endforeach; ?>
         <div>
            <a class="prev2" onclick="plusUpcomingSlides(-1)">&#10094;</a>
            <a class="next2" onclick="plusUpcomingSlides(1)">&#10095;</a>
         </div>
      </div>
   </div>
</main>
<script>//Slides JS
   let slideIndex = 0; // Initialisation de l'index de slide à 0
   
   showSlides();
   
   function plusSlides(n) {// Fonction qui permet d'incrémenter ou décrémenter l'index des slides
   if (n === 1) {// Si on clique sur la flèche droite
     showSlides(slideIndex += n, 'slideRight');// On incrémente l'index et on applique l'animation slide
   } else {// Si on clique sur la flèche gauche
     showSlides(slideIndex += n, 'slideLeft');// On décrémente l'index et on applique l'animation slideLeft
   }
   }
   
   function showSlides(n, animation) {// Fonction qui affiche la slide sélectionnée
   let i;
   let slides = document.getElementsByClassName("custom-slider");
   let dots = document.getElementsByClassName("dot");
   
   if (n >= slides.length) {slideIndex = 0;}// Si l'index est supérieur au nombre de slides, on repart du début
   if (n < 0) {slideIndex = slides.length - 1;}// Si l'index est inférieur à 0, on va au dernier slide
   
   for (i = 0; i < slides.length; i++) {// On parcourt tous les slides
     slides[i].classList.remove("fade", "slideRight", "slideLeft");// On supprime les classes d'animation
     slides[i].style.display = "none";// On cache toutes les slides sauf celle sélectionnée
   }
   
   for (i = 0; i < dots.length; i++) {// On parcourt tous les points
     dots[i].className = dots[i].className.replace(" active", "");// On enlève la classe active de tous les points
   }
   dots[slideIndex].className += " active";// On ajoute la classe active au point sélectionné
   
   slides[slideIndex].style.display = "block";// On affiche la slide sélectionnée
   
   slides[slideIndex].classList.add("fade", animation);// On ajoute les classes d'animation à la slide
   // slides[slideIndex].classList.remove("slideRight", "slideLeft","fade");// On supprime les classes d'animation de slideLeft et slideRight
   }
   function currentSlide(n){
     // Fonction qui affiche la slide correspondante lorsque on click 
     showSlides(slideIndex = n-1);// On passe l'index de la slide cliquée
   }
</script>
<script>//Background JS
   function extractDominantColor(imageURL) {
       var img = new Image();
       img.crossOrigin = "Anonymous";
   
       img.onload = function() {
           var canvas = document.createElement('canvas');
           canvas.width = 1;
           canvas.height = 1;
           var ctx = canvas.getContext('2d');
           ctx.drawImage(img, 0, 0, 1, 1);
   
           var pixelData = ctx.getImageData(0, 0, 1, 1).data;
           var color = 'rgb(' + pixelData[0] + ', ' + pixelData[1] + ', ' + pixelData[2] + ')';
           
           // Définir le dégradé linéaire avec la couleur dominante
           var gradientBg = "linear-gradient(to bottom, " + color + ", #000000)";
           
           // Appliquer le dégradé linéaire à l'arrière-plan de l'élément parent avec l'ID "wrapper"
           document.querySelector('#wrapper').style.background = gradientBg;//gradientBg sert au dégradé linéaire
       };
   
       img.src = imageURL;
       
   }
   // <?php foreach ($films as $film): ?>
   // Appeler la fonction avec l'URL de l'image de fond depuis PHP
   extractDominantColor("<?php echo $film['film_back_img']; ?>");// faut explode ici et rajouter "\" au chemin.
   // <?php endforeach; ?>
</script>
<script>//Upcoming Movies Slides JS
   function plusUpcomingSlides(n) {
       // Récupérer toutes les diapositives de la section "Upcoming Movies"
       var slides = document.getElementById("UpcomingMovies").getElementsByClassName("slide");
   
       // Récupérer l'index de la diapositive principale
       var currentIndex = -1;
       for (var i = 0; i < slides.length; i++) {
           if (slides[i].classList.contains("main-slide")) {
               currentIndex = i;
               break;
           }
       }
   
       // Cacher toutes les diapositives
       for (var i = 0; i < slides.length; i++) {
           slides[i].classList.remove("main-slide", "prev-slide", "next-slide");
       }
   
       // Calculer le nouvel index
       var newIndex = (currentIndex + n + slides.length) % slides.length;//% permet de boucler sur les indices
       /*Exemple de fonctionnement
       currentIndex = 2
       n = 2 (avancer de 2 diapositives)
       slides.length = 5
   
       newIndex = (2 + 2 + 5) % 5
       = 9 % 5
       = 4*/
   
   
       // Afficher la nouvelle diapositive principale
       slides[newIndex].classList.add("main-slide");
   
       // Déterminer les indices des diapositives précédente et suivante
       var prevIndex = (newIndex - 1 + slides.length) % slides.length;
       var nextIndex = (newIndex + 1) % slides.length;
   
       // Afficher les diapositives précédente et suivante
       slides[prevIndex].classList.add("prev-slide");
       slides[nextIndex].classList.add("next-slide");
   }
</script>
<?php
   $content=ob_get_clean();
   require("view/template.php");
   ?>