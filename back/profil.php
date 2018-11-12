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
    



<div class="container margin" >
    
    <h1 class="mt-5">Profil</h1>
    <?php 
    if(internauteEstConnecteEtAdmin()) echo '<h1>Vous êtes un administrateur</h1>';
     ?>
    <hr>
    
    <div class="card" style="background:transparent" width="200">

      <img src="img/<?php echo $photo; ?>" alt="Setti" class="rounded-circle" style="width:100%">
      <h1><?php echo $prenom.'&nbsp;&nbsp;' .$nom; ?></h1>
      <p><i class="fas fa-map-marker-alt"></i> <?php echo $adresse; ?></p>
      <p><i class="fas fa-city"></i> <?php echo $ville.'&nbsp;-&nbsp;' .$code_postal; ?></p>
    
      <p><i class="fas fa-envelope"></i> <?php echo $email; ?></p>
      <a href="#"><i class="fa fa-dribbble"></i></a>
      <a href="#"><i class="fa fa-twitter"></i></a>
      <a href="#"><i class="fa fa-linkedin"></i></a>
      <a href="#"><i class="fa fa-facebook"></i></a>
      
    </div>
</div>





<?php

require_once 'inc/bas.inc.php'; // footer et fermeture des balises










