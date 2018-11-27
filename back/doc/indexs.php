<?php require_once 'back/inc/init.inc.php';  

extract($_SESSION['t_utilisateurs']); 

//requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
$sql = $pdo->prepare(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = 1 ");
$sql->execute();
?>


<!DOCTYPE html>
<html lang="fr">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Setti Belkacem">
    <title>Site CVportfolio Setti Belkacem</title>

    <!-- Bootstrap core CSS---------------->
    <link href="back/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- fonts du template -->
    <link href="back/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- CDN BOOTSTRAP -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- styles du template -->
    <link href="back/css/grayscale.min.css" rel="stylesheet">
    <!-- ----------------------------------------------- -->

    <!-- style maison -->
    <link rel="stylesheet" href="back/css/style.css">

    <!-- CDN section skills -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ fin CDN section skills ---------->
    <!------ CDN section parcour ---------->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ fin https:CDn section parcour ---------->
    <!------ fin CDN footer ---------->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <!-- imprimez mon CV -->
    <!-- <style>
    @media print{

            #nav1, #jumbotron, #navgeneral, #footer, #imprim{
                display: none;
            }
    }
    </style> -->

  </head>


  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">&nbsp;&nbsp;<?php echo $prenom .'&nbsp;&nbsp;'.$nom; ?><br><span>Développeur Intégrateur Web Junior</span></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">Apropos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#skills">Competence</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#course">Parcours</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#signup">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
      <div class="container d-flex h-100 align-items-center">
      <div class="bg-image"></div>
        <div class="mx-auto text-center bg-text">
          <h1 class="mx-auto my-0 text-uppercase glow">&nbsp;&nbsp;<?php echo $prenom .'&nbsp;&nbsp;'.$nom; ?></h1>
          <h2 class="text-white-50 mx-auto mt-2 mb-5">Développeur Web Intégrateur Junior, à la recherche d'un stage conventionné (Jan - Fév).</h2>
          <a href="#about" class="btn btn-primary js-scroll-trigger">Adoptez-moi !</a>
          <!-- <a class="btn btn-outline-secondary" id="imprim" onclick="myFunction();"><i class="fas fa-print"> Imprimer cette page</i></a> -->
        </div>
      </div>
    </header>

    <!-- About Section -->
    <section id="about" class="about-section text-center">
      <div class="container">
        <div class="row">
        <div class="col-lg-2 mx-auto">
        <div class="box">
              <div class="heart">
                
              </div>
            </div>
        </div>
          <div class="col-lg-8 mx-auto">
            <h2 class="text-white mb-4">Developpeuse, <span>par passion !</span></h2>
            <span class="text-white-50">Je me présente, Setti BELKACEM. Développeur Web Intégrateur Junior. <br>
              Actuellement, en formation de 10 mois labellisée Grande École du Numérique Techniques de développement web et mobile avec WebForce3. 
            Sociable, impliquée, à l'écoute des contraintes professionnelles et aux besoins du client, je suis à la recherche d'un stage non rémunéré d'une durée de 2 mois (Janv -Fév.).
          </div>
        </div>
        <img src="back/img/profil.jpg" class="img-fluid rounded-circle mb-5" width="250" heigth="250" alt="profil">
      </div>
    </section>
    <!-- fin About Section -->

    <!-- Section #skills-->
    <section id="skills" class="projects-section bg-skills">
      <?php
      //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
      $sql = $pdo->prepare(" SELECT * FROM t_competences WHERE id_utilisateur = 1 ");
      $sql->execute();
      ?>
        <h1 class="text-center">Competences</h1>
	    <div class="container">
	        <div class="row">
            <?php
             while ($ligne_competence = $sql->fetch()) 
             { 
                 if ($ligne_competence['id_competence'] % 2 == 1) 
                {
            ?>
                <!--team-1-->
            <?php   
	            echo '<div class="col-lg-4">';
	                echo '<div class="our-team-main">';
                        
	                    echo '<div class="team-front">';
                          echo '<img src="http://placehold.it/110x110/336699/fff?text=' . $ligne_competence['competence'] . ' " class="img-fluid" style="width:250;height:250"/>';
	                        echo '<h3>' . $ligne_competence['competence'] . '</h3>';
                          echo '<div class="progress-outer">';
                            echo '<div class="progress">';
                              echo '<div class="progress-bar progress-bar-info progress-bar-striped active" style="width:' . $ligne_competence['niveau'] . '; box-shadow:-1px 10px 10px rgba(91, 192, 222, 0.7);"></div>';
                              echo '<div class="progress-value">' . $ligne_competence['niveau'] . '%</div>';
                            echo '</div>';
                          echo '</div>';
	                    echo '</div>';
	
	                    echo '<div class="team-back">';
	                        echo '<img src="back/img/' . $ligne_competence['icon'] . '" alt="' . $ligne_competence['competence'] . '" style="width:100%" >';
	                            
	                    echo '</div><!-- fin div .team-back -->';
	
	                echo '</div><!-- fin div .our-team-main -->';
                echo '</div><!-- fin div .col-lg-4 -->';
                } else {
            ?>
                <!--fin team-1-->
                

                <!--team-2-->
            <?php 
	            echo '<div class="col-lg-4">';
	                echo '<div class="our-team-main">';
	
	                    echo '<div class="team-front">';
                            echo '<img src="http://placehold.it/110x110/9c27b0/fff?text=' . $ligne_competence['competence'] . ' " class="img-fluid" style="width:250;height:250"/>';
                            echo '<h3>' . $ligne_competence['competence'] . '</h3>';
                            echo '<div class="progress-outer">';
                                    echo '<div class="progress">';
                                        echo '<div class="progress-bar progress-bar-success progress-bar-striped active" style="width:' . $ligne_competence['niveau'] . '; box-shadow:-1px 10px 10px rgba(116, 195, 116,0.7);"></div>';
                                        echo '<div class="progress-value">' . $ligne_competence['niveau'] . '</div>';
                                    echo '</div>';
                                echo '</div>';
	                    echo '</div><!-- fin div .team-front -->';
	
	                    echo '<div class="team-back">';
                      echo '<img src="back/img/' . $ligne_competence['icon'] . '" alt="' . $ligne_competence['competence'] . '" style="width:100%" >';
	                    echo '</div><!-- fin div .team-back -->';
	
	                echo '</div><!-- fin div .our-team-main -->';
                echo '</div><!-- fin div .col-lg-4 -->';
                }

              }
            ?>
	            <!--fin team-2-->
	        </div><!-- fin div .row -->
	    </div><!-- fin div .container -->

    </section><!-- fin section #skills --> 
    

    
    <section id="course" class="projects-section"><!-- Experiences -->
              
      <div class="container-fluid">
        <?php
        //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
          $sql = $pdo->prepare(" SELECT * FROM t_experiences WHERE id_utilisateur =1 ");
          $sql->execute();
        
        ?>
	      <div class="row">
	        <div id="timeline">
                  <div class="row timeline-movement timeline-movement-top">
                    <div class="timeline-badge timeline-future-movement" style="width:10%;">
                        <p>Expériences</p>
                    </div>
                  </div>
                  <?php
                  while ($ligne_experience = $sql->fetch()) 
                            { 
                                if ($ligne_experience['id_experience'] % 2 == 1) 
                                {
                  
                  echo '<div class="row timeline-movement">
                          <div class="timeline-badge center-left">
                        </div>';

                  echo '<div class="col-sm-6  timeline-item">';
                    echo '<div class="row">';
                      echo '<div class="col-sm-11">';
                        echo '<div class="timeline-panel credits  anim animate fadeInLeft">';
                          echo '<ul class="timeline-panel-ul">';
                          
                            echo '<div class="lefting-wrap">';
                              echo '<li class="img-wraping"><a href="#"><img src="http://via.placeholder.com/250/000000" class="img-responsive" alt="user-image" /></a></li>';
                            echo '</div>';

                            echo '<div class="righting-wrap">';

                              echo '<li><a href="#" class="importo">' . $ligne_experience['titre_exp'] . '</a></li>';
                              echo '<li><span class="causale" style="color:#000; font-weight: 600;">' . $ligne_experience['stitre_exp'] . '</span> </li>';
                              echo '<li><span class="causale">' . $ligne_experience['description_exp'] . '</span> </li>';
                              echo '<li><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>' . $ligne_experience['dates_exp'] . '</small></p> </li>';

                            echo '</div>';
                            echo '<div class="clear"></div>';
                          echo '</ul>';
                        echo '</div>';
                      echo '</div>';
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
                } else {
                  ?>
                      <!--fin team-1-->
                      

                      <!--team-2-->
                      <?php 
                echo '<div class="row timeline-movement">';
                  echo '<div class="timeline-badge center-right"></div>';
                  echo '<div class="offset-sm-6 col-sm-6  timeline-item">';
                    echo '<div class="row">';
                      echo '<div class="offset-sm-1 col-sm-11">';
                        echo '<div class="timeline-panel debits  anim animate  fadeInRight">';
                          echo '<ul class="timeline-panel-ul">';

                            echo '<div class="lefting-wrap">';
                              echo '<li class="img-wraping"><a href="#"><img src="http://via.placeholder.com/250/000000" class="img-responsive" alt="user-image" /></a></li>';
                            echo '</div>';

                            echo '<div class="righting-wrap">';
                              echo '<li><a href="#" class="importo"></a></li>';
                              echo '<li><span class="causale" style="color:#000; font-weight: 600;">' . $ligne_experience['stitre_exp'] . '</span> </li>';
                              echo '<li><span class="causale">' . $ligne_experience['description_exp'] . '</span> </li>';
                              echo '<li><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>' . $ligne_experience['dates_exp'] . '</small></p> </li>';
                            echo '</div>';

                            echo '<div class="clear"></div>';
                            
                          echo '</ul>';
                        echo '</div>';
                      echo '</div>';
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
                }

              }
            ?>
          </div><!-- div .timeligne -->
        </div><!-- div .row -->
      </div><!-- div .container-fluid -->


      
      <div class="container-fluid">
        <?php
        //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
          $sql = $pdo->prepare(" SELECT * FROM t_formations WHERE id_utilisateur =1 ");
          $sql->execute();
        
        ?>
	      <div class="row">
	        <div id="timeline">
                  <div class="row timeline-movement timeline-movement-top">
                    <div class="timeline-badge timeline-future-movement" style="width:10%;">
                        <p>Expériences</p>
                    </div>
                  </div>
                  <?php
                  while ($ligne_formation = $sql->fetch()) 
                            { 
                                if ($ligne_formation['id_formation'] % 2 == 1) 
                                {
                  
                  echo '<div class="row timeline-movement">
                          <div class="timeline-badge center-left">
                        </div>';

                  echo '<div class="col-sm-6  timeline-item">';
                    echo '<div class="row">';
                      echo '<div class="col-sm-11">';
                        echo '<div class="timeline-panel credits  anim animate fadeInLeft">';
                          echo '<ul class="timeline-panel-ul">';
                          
                            echo '<div class="lefting-wrap">';
                              echo '<li class="img-wraping"><a href="#"><img src="http://via.placeholder.com/250/000000" class="img-responsive" alt="user-image" /></a></li>';
                            echo '</div>';

                            echo '<div class="righting-wrap">';

                              echo '<li><a href="#" class="importo">' . $ligne_formation['formation'] . '</a></li>';
                              echo '<li><span class="causale" style="color:#000; font-weight: 600;">' . $ligne_formation['stitre_form'] . '</span> </li>';
                              echo '<li><span class="causale">' . $ligne_formation['description_form'] . '</span> </li>';
                              echo '<li><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>' . $ligne_formation['dates_form'] . '</small></p> </li>';

                            echo '</div>';
                            echo '<div class="clear"></div>';
                          echo '</ul>';
                        echo '</div>';
                      echo '</div>';
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
                } else {
                  ?>
                      <!--fin team-1-->
                      

                      <!--team-2-->
                      <?php 
                echo '<div class="row timeline-movement">';
                  echo '<div class="timeline-badge center-right"></div>';
                  echo '<div class="offset-sm-6 col-sm-6  timeline-item">';
                    echo '<div class="row">';
                      echo '<div class="offset-sm-1 col-sm-11">';
                        echo '<div class="timeline-panel debits  anim animate  fadeInRight">';
                          echo '<ul class="timeline-panel-ul">';

                            echo '<div class="lefting-wrap">';
                              echo '<li class="img-wraping"><a href="#"><img src="http://via.placeholder.com/250/000000" class="img-responsive" alt="user-image" /></a></li>';
                            echo '</div>';

                            echo '<div class="righting-wrap">';
                              echo '<li><a href="#" class="importo"></a></li>';
                              echo '<li><span class="causale" style="color:#000; font-weight: 600;">' . $ligne_formation['stitre_form'] . '</span> </li>';
                              echo '<li><span class="causale">' . $ligne_formation['description_form'] . '</span> </li>';
                              echo '<li><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>' . $ligne_formation['dates_form'] . '</small></p> </li>';
                            echo '</div>';

                            echo '<div class="clear"></div>';
                            
                          echo '</ul>';
                        echo '</div>';
                      echo '</div>';
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
                }

              }
            ?>
          </div><!-- div .timeligne -->
        </div><!-- div .row -->
      </div><!-- div .container-fluid -->
    </section>

    <!-- Signup Section -->
    
    <!-- Contact Section -->
    <section class="contact-section">
      <div class="container m-auto">
      
	      <div class="row mt-5 mb-4 d-flex">
		      <div class="col-lg-6 col-md-6 col-sm-12 m-auto">
            <div class="card m-auto" style="width: 27rem;">
                   
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2623.9022860024365!2d2.4185197159740266!3d48.87913927928956!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66d0c19846e85%3A0xb1780260bf3b093c!2s96+Rue+Romain+Rolland%2C+93260+Les+Lilas!5e0!3m2!1sfr!2sfr!4v1541777980639" width="430vh" height="450vh" frameborder="0" style="border:0" allowfullscreen></iframe>
              <div class="card-body m-auto">
                <h5 class="card-title">Mon adresse :</h5>
                <address>96 rue romainn rolland</address>
                <address>les lilas 93260</address>
                <a href="tel:+33762445374" class="btn btn-primary"><i class="fas fa-mobile-alt">&nbsp;&nbsp;07 62 44 53 74 </i></a>
              </div>
            </div>
          </div>

          <!--Form with header-->
          <div class="col-lg-6 col-md-6 col-sm-12  m-auto">
            <form action="mail.php" method="post">
                <div class="card border-primary rounded-0">
                    <div class="card-header p-0">
                        <div class="bg-info text-white text-center py-2">
                            <h3><i class="fa fa-envelope"></i> ME CONTACTER</h3>
                            <p class="m-0" style="text-align: center;">
                            Laissez-moi un mail en me laissant vos coordonnées. Je reviendrai vers vous avec plaisir.</p>
                        </div>
                    </div>
                    <div class="card-body p-3">  <!--div de formulaire-->
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                </div>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                </div>
                                <input type="email" class="form-control" id="nom" name="email" placeholder="exemple@gmail.com" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                                </div>
                                <textarea class="form-control" placeholder="Dite moi tout.." required></textarea>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="submit" value="Envoyer" class="btn btn-info btn-block rounded-0 py-2">
                        </div>
                    </div>

                </div>
            </form><!--Form with header-->
          </div>
        </div>
      </div>
    </div>  
  </section>
    <!-- fin Contact Section -->
    
    
    <!-- Footer -->
    

/* imprimer mon CV */
<!-- <script>
    function myFunction(){
        window.print();
       	 return false;
    	}
	</script> -->
         
  </body>

</html>
