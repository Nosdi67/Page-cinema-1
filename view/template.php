<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="public/style/style.css?v=<?php echo time(); ?>">
    <link rel="script" href="script/script.js?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?php echo $title ?></title>
</head>
<body>
    <div id="wrapper">
        <header>
            <nav>
                    <div>
                        <a href="index.php?action=homePage"><img src="image/DOMOVIES croped.png" alt="Logo du site DOMOVIES"></a>
                    </div>

                    <ul>
                        <li><a href="index.php?action=allMovies">Movies</a></li>
                        <li><a href="">Genre</a></li>
                        <li><a href="index.php?action=actorsPage">Actors</a></li>
                        <li><a href="">Producers</a></li>
                    </ul>

                    <input id="searchBar" type="search" placeholder="Search for an actor, movie...">
                    <button class="searchBarbtn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </nav>
        </header>

        
        <?php if(isset($content)) {echo $content; }?>
       
        
        <footer>
                    <div id="footer">
                            <div id="footerImg">
                                <a href=""><img src="image/DOMOVIES croped.png" alt="Logo du site DOMOVIES"></a>
                            </div>
                            
                            <div id="followUs">
                                <h3 >Follow Us</h3>
                                        <div class="socialMedia">
                                    
                                            <div class="socialMediaItem">
                                                <a href=""><i class="fa-brands fa-facebook fa-xl"></i></a>
                                            </div>
                                            
                                            <div class="socialMediaItem">
                                                <a href=""><i class="fa-brands fa-twitter fa-xl"></i></a>
                                            </div>
                                        
                                            <div class="socialMediaItem">
                                                <a href=""><i class="fa-brands fa-instagram fa-xl"></i></a>
                                            </div>
                                        </div>
                        
                            </div>

                            <div id="SupportUs">
                                
                                <div>
                                    <h3>Support Us</h3>
                                </div>
                                
                                <div>
                                    <button class="GiftBtn">Make A Gift</button> 
                                </div>
                        
                            </div>

                            <div class="SiteLinks">                           
                                <h3 class="SiteLinksTitle">Site Links</h3>
                                    <div>
                                        <ul class="SiteLinksList">
                                            <li><a href="">About us</a></li>
                                            <li><a href="">Contact Us</a></li>
                                            <li><a href="">Blog</a></li>
                                            <li><a href="">FAQ</a></li>
                                            <li><a href="">Support</a></li>
                                        </ul>
                                    </div>
                            </div>
                    </div>
        </footer>
    </div>


</body>
</html>



