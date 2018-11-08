<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <title>Setti Belkacem | Développeur Intégrateur Web</title>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Free HTML5 Website Template by uicookies.com" />
  <meta name="keywords" content="free bootstrap 4, free bootstrap 4 template, free website templates, free html5, free template, free website template, html5, css3, mobile first, responsive" />
  
  <!-- Google font Montserrat et Open sans-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,600|Open+Sans:400,400i,600" rel="stylesheet"> 
<!-- Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<!-- Bootstrap CSS en local-->
    <link href="css/bootstrap-4.0.0.css" rel="stylesheet">
<!-- Bootstrap CSS en CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
<!-- Profil card -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Mes styles -->
    <link href="css/styleAdmin.css" rel="stylesheet" type="text/css">
<!-- Ck editor 4 -->
    <script src="ckeditor/ckeditor.js"></script>
  <!-- <style>
      @media print{
  
        #imprim{
            display: none;
        }
  }
   </style> -->
  </head>
  <body>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top mb-5">
      <div class="container-fluid">

        <!-- La marque -->
        <a class="navbar-brand" href="<?php echo RACINE_SITE ?>">Setti CV Portfolio</a>

        <!-- Le burger -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav1" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Le menu -->
        <div class="collapse navbar-collapse" id="nav1">
          <ul class="navbar-nav ml-auto">
            <?php

              // menu si internaute connecté et admin :
              if (internauteEstConnecteEtAdmin()) {
                echo '<li><a class="nav-link" href="'. RACINE_SITE .'profil.php">Profil</a></li>';
                echo '<li><a class="nav-link" href="'. RACINE_SITE .'competences.php">Compétences</a></li>';
                echo '<li><a class="nav-link" href="'. RACINE_SITE .'formations.php">Formations</a></li>';
                echo '<li><a class="nav-link" href="'. RACINE_SITE .'experiences.php">Expériences</a></li>';
                echo '<li><a class="nav-link" href="'. RACINE_SITE .'loisirs.php">Loisirs</a></li>';
                echo '<li><a class="nav-link" href="'. RACINE_SITE .'reseaux.php">Réseaux</a></li>';
                echo '<li><a class="nav-link" href="'. RACINE_SITE .'gestion_messages.php">Messages</a></li>';
              } 

              // // menu si internaute connecté :
              if (internauteEstConnecte()) {
                echo '<li><a class="nav-link" href="'. RACINE_SITE .'connexion.php?action=deconnexion">Se déconnecter</a></li>';             
              }   

            ?>
          </ul>
        </div> <!-- fin collapse.navbar-collapse -->
    </div> <!-- fin container-fluid -->
</nav><!-- fin navigation -->


        
   