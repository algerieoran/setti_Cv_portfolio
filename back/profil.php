<?php
require_once 'inc/init.inc.php';


//1- redirection si l'internaute n'est pas connecté :
if(!internauteEstConnecte()) {  // si l'utilisateur n'est pas connecté il ne doit pas avoir accés à la page profil
    header('location:connexion.php');  // nous l'invitons à se connecter
    exit();
}

// 2- préparation du profil à afficher :
//debug($_SESSION);
extract($_SESSION['t_utilisateurs']);   // extrait tous les indices de l'array sous forme de variable auxquelles on affecte la valeur dans l'array. Exemple : $_SESSION['membre']['pseudo']  devient $pseudo = $_SESSION['membre']['pseudo'];

//-----------------------------------------------------------AFFICHAGE---------------------------------------------
require_once 'inc/haut.inc.php';
?>
    
<div class="container">
    <h1 class="mt-5">Profil</h1>

    <div class="card">
        <img src="img/<?php echo $photo; ?>" alt="" style="width:100%">
        <h2>Bonjour <strong><?php echo $prenom; ?></strong></h2>
        
        <?php 
            if (internauteEstConnecteEtAdmin()) echo '<p class="title">Vous êtes un administrateur</p>';
        ?>
        <hr>
        <p>Harvard University</p>
        <a href="#"><i class="fa fa-dribbble"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-facebook"></i></a>
            <p><button>Contact</button></p>
    </div>
</div>




<?php

require_once 'inc/bas.inc.php'; // footer et fermeture des balises










