<?php require_once 'back/inc/init.inc.php';
  //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
  $sql = $pdo->prepare(" SELECT * FROM t_competences WHERE id_utilisateur = 1 ");
  $sql->execute();          
?>
<!DOCTYPE html>
<html lang="fr">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Setti Belkacem">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- timeline -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>   

    <!------ Include the above in your HEAD tag ---------->

    <title>Site CVportfolio Setti Belkacem</title>

    <!-- Bootstrap core CSS -->
    <link href="back/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="back/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- loisir -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
    
    


    <!-- Custom styles for this template -->
    <link href="back/css/grayscale.min.css" rel="stylesheet">
    <!-- style maison -->
    <link rel="stylesheet" href="back/css/style.css">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container"><!-- logo -->
        <div class="demo">
          <div class="row">
            <div class="col-md-12">
              <div class="loader">
                <div class="box-1">
                  <div class="box-2">
                    <div class="box-3">
                      <div class="box-4">
                        <div class="box-5">
                          <div class="box-6"></div><!-- fin div .box-6 -->
                        </div><!-- fin div .box-5 -->
                      </div><!-- fin div .box-4 -->
                    </div><!-- fin div .box-3 -->
                  </div><!-- fin div .box-2 -->
                </div><!-- fin div .box-1 -->
                <span class="loader-inner">SB</span>
              </div><!-- fin div .loader -->
            </div><!-- fin div .col-md-12 -->
          </div><!-- fin div .row -->
        </div><!-- fin div .demo--> <!-- fin logo  -->
     
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Setti BELKACEM <br><span>Créative et impliquée</span></a>
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
              <a class="nav-link js-scroll-trigger" href="#skills">Compétences</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#exp">Experiences</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#form">Formations</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#loisir">loisir</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#signup">Contact</a>
            </li>
          </ul>
        </div><!-- fin div #navbarResponsive -->
      </div><!-- fin div .container  -->
    </nav>
    <!-- fin navigation -->

    <!-- Header -->
    <header class="masthead">
      <div class="container d-flex h-100 align-items-center">
        <div class="bg-image"></div>
        <div class="mx-auto text-center bg-text">
          <h1 class="mx-auto my-0 text-uppercase glow">Setti BELKACEM</h1>
          <h2 class="text-white-50 mx-auto mt-2 mb-5">Développeur Web Intégrateur Junior, à la recherche d'un stage.</h2>
          <!-- <a href="#about" class="btn btn-primary js-scroll-trigger">Adoptez-moi !</a> -->
          <p><a class="btn btn-primary btn-lg" href="back/doc/cvbelkacem.pdf" download="cvbelkacem.pdf"><i class="fa fa-file-pdf-o"></i> Télécharger mon CV</a></p>
        </div><!-- fin div .mx-auto text-center bg-text -->
      </div><!-- fin div .container d-flex h-100 align-items-center -->
    </header>
    <!-- fin Header -->

    <!-- Section #about-->
    <section id="about" class="about-section text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2 class="text-white mb-4">A propos de moi </h2>
            <p class="text-white-50">Je me présente, Setti BELKACEM. Développeur Web Intégrateur Junior. <br>
              Actuellement, en formation de 10 mois labellisée Grande École du Numérique Techniques de développement web et mobile avec WebForce3. 
            Sociable, impliquée, à l'écoute des contraintes professionnelles et aux besoins du client, je suis à la recherche d'un stage non rémunéré d'une durée de 2 mois (Janv -Fév.).
          </div><!-- fin div .col-lg-8 mx-auto-->
        </div><!-- fin div .row -->
        <img src="back/img/profil.jpg" class="img-fluid rounded-circle mb-5" width="250" heigth="250" alt="profil">
      </div><!-- fin div .container -->
    </section>
    <!-- fin section #about-->
    
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

                echo '<div class="team-front bg-info">';

                  echo '<img src="http://placehold.it/110x110/336699/fff?text=' . $ligne_competence['competence'] . ' " class="img-fluid" style="width:250;height:250"/>';
                  echo '<h3>' . $ligne_competence['competence'] . '</h3>';

                  echo '<div class="progress-outer">';
                    echo '<div class="progress">';

                      echo '<div class="progress-bar progress-bar-info progress-bar-striped active" style="width:' . $ligne_competence['niveau'] . '; box-shadow:-1px 10px 10px rgba(91, 192, 222, 0.7);"></div>';/* fin div .progress-bar progress-bar-info progress-bar-striped active */
                      echo '<div class="progress-value">' . $ligne_competence['niveau'] . '%</div>';/* fin div .progress-value*/

                    echo '</div>';/* fin div .progress */
                  echo '</div>';/* fin div .progress-outer */

                echo '</div><!-- fin div .team-front -->';

                echo '<div class="team-back">';
                  echo '<img src="back/img/' . $ligne_competence['icon'] . '" alt="' . $ligne_competence['competence'] . '" style="width:100%" >';          
                echo '</div><!-- fin div .team-back -->';

              echo '</div><!-- fin div .our-team-main -->';

            echo '</div><!-- fin div .col-lg-4 -->';
          } 
          else {
          ?>
          <!--fin team-1-->
                
          <!--team-2-->
          <?php 
            echo '<div class="col-lg-4">';
              echo '<div class="our-team-main">';

                echo '<div class="team-front bg-warning">';
                  echo '<img src="http://placehold.it/110x110/9c27b0/fff?text=' . $ligne_competence['competence'] . ' " class="img-fluid" style="width:250;height:250"/>';
                  echo '<h3>' . $ligne_competence['competence'] . '</h3>';
                  echo '<div class="progress-outer">';
                    echo '<div class="progress">';
                        echo '<div class="progress-bar progress-bar-success progress-bar-striped active" style="width:' . $ligne_competence['niveau'] . '; box-shadow:-1px 10px 10px rgba(116, 195, 116,0.7);"></div>';/* fin div .progress-bar progress-bar-success progress-bar-striped active */
                        echo '<div class="progress-value">' . $ligne_competence['niveau'] . '</div>';/* fin div .progress-value */
                    echo '</div>';/* fin div .progress-outer */
                  echo '</div>';/* fin div .progress-outer */
                echo '</div>'; /* fin div .team-front */

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
    </section>
    <!-- fin section #skills --> 
    

    <!-- Section #exp -->
    <section id="exp" class="projects-section">  
      <div class="container-fluid">
        <!-- 1 - Experiences -->
        <?php
        //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
        $sql = $pdo->prepare(" SELECT * FROM t_experiences WHERE id_utilisateur =1 ");
        $sql->execute();
        
        ?>
        <div class="row">
          <div id="timeline">
            <div class="row timeline-movement timeline-movement-top">
                <div class="timeline-badge timeline-future-movement" style="width:10%;text-overflow: fade clip;">
                    <p id="margin_l">Expériences</p>
                </div>
            </div>
            <?php
            while ($ligne_experience = $sql->fetch()) 
            { 
              if ($ligne_experience['id_experience'] % 2 == 1) 
              {
          
              echo '<div class="row timeline-movement">
                      <div class="timeline-badge center-left">
                    </div>';/* fin div .row timeline-movement */

              echo '<div class="col-sm-6  timeline-item">';
                echo '<div class="row">';
                  echo '<div class="col-sm-11">';
                    echo '<div class="timeline-panel credits  anim animate fadeInLeft bg-transparent">';
                      echo '<ul class="timeline-panel-ul">';

                        // echo '<div class="lefting-wrap">';
                        //   echo '<li class="img-wraping"><a href="#"><img src="back/img/biblio.jpg" class="img-responsive" alt="user-image" /></a></li>';
                        // echo '</div>';/* fin div .lefting-wrap */

                        echo '<div class="righting-wrap">';
                          echo '<li><a href="#" class="importo">' . $ligne_experience['titre_exp'] . '</a></li>';
                          echo '<li><span class="causale" style="color:#000; font-weight: 600;">' . $ligne_experience['stitre_exp'] . '</span> </li>';
                          echo '<li><span class="causale">' . $ligne_experience['description_exp'] . '</span> </li>';
                          echo '<li><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>' . $ligne_experience['dates_exp'] . '</small></p> </li>';
                        echo '</div>';/* fin div .righting-wrap */

                        echo '<div class="clear"></div>';/* div pour casser le float */

                      echo '</ul>';/* fin ul */
                    echo '</div>';/* fin div .timeline-panel credits  anim animate fadeInLeft */
                  echo '</div>';/* fin div .col-sm-11 */
                echo '</div>';/* fin div .row */
              echo '</div>';/* fin div .col-sm-6  timeline-item */
            } 
            else {
            ?>
          </div><!-- fin div #timeline  -->
          <!--fin team-1-->
                
          <!--team-2-->
          <?php 
          echo '<div class="row timeline-movement">';
                echo '<div class="timeline-badge center-right">
                </div>';/* fin div .row timeline-movement */

          echo '<div class="offset-sm-6 col-sm-6  timeline-item">';
            echo '<div class="row">';
              echo '<div class="offset-sm-1 col-sm-11">';
                echo '<div class="timeline-panel debits  anim animate  fadeInRight bg-transparent">';
                  echo '<ul class="timeline-panel-ul">';

                    // echo '<div class="lefting-wrap">';
                    //     echo '<li class="img-wraping"><a href="#"><img src="http://via.placeholder.com/250/000000" class="img-responsive" alt="user-image" /></a></li>';
                    // echo '</div>';/* fin div .lefting-wrap */

                    echo '<div class="righting-wrap">';
                        echo '<li><a href="#" class="importo"></a></li>';
                        echo '<li><span class="causale" style="color:#000; font-weight: 600;">' . $ligne_experience['stitre_exp'] . '</span> </li>';
                        echo '<li><span class="causale">' . $ligne_experience['description_exp'] . '</span> </li>';
                        echo '<li><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>' . $ligne_experience['dates_exp'] . '</small></p> </li>';
                    echo '</div>';/* fin div .righting-wrap */
                    
                    echo '<div class="clear"></div>';/* div pour casser le float */

                  echo '</ul>';/* fin ul .timeline-panel-ul */
                echo '</div>';/* fin div .timeline-panel debits  anim animate  fadeInRight */
              echo '</div>';/* fin div .offset-sm-1 col-sm-11 */
            echo '</div>';/* fin div .row */
          echo '</div>';/* fin div .offset-sm-6 col-sm-6  timeline-item */
          echo '</div>';/*  fin div .row  */ 
          }//fermeture du if ($ligne_experience['id_experience'] % 2 == 1)

          }/* fermeture du while ($ligne_experience = $sql->fetch()) */
          ?>
        
      </div><!-- fin div .container-fluid -->     
    </section><!-- fin section #exp --> 

    <!-- Section #form -->
    <section id="form" class="projects-section">  
      <div class="container-fluid">
        <!-- 1 - Experiences -->
        <?php
        //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
        $sql = $pdo->prepare(" SELECT * FROM t_formations WHERE id_utilisateur =1 ");
        $sql->execute();
        
        ?>
        <div class="row">
          <div id="timeline">
            <div class="row timeline-movement timeline-movement-top">
                <div class="timeline-badge timeline-future-movement" style="width:10%;text-overflow: fade clip;">
                    <p>Formations</p>
                </div>
            </div>
            <?php
            while ($ligne_formation = $sql->fetch()) 
            { 
              if ($ligne_formation['id_formation'] % 2 == 1) 
              {
          
              echo '<div class="row timeline-movement">
                      <div class="timeline-badge center-left">
                    </div>';/* fin div .row timeline-movement */

              echo '<div class="col-sm-6  timeline-item">';
                echo '<div class="row">';
                  echo '<div class="col-sm-11">';
                    echo '<div class="timeline-panel credits  anim animate fadeInLeft">';
                      echo '<ul class="timeline-panel-ul">';

                        // echo '<div class="lefting-wrap">';
                        //   echo '<li class="img-wraping"><a href="#"><img src="back/img/biblio.jpg" class="img-responsive" alt="user-image" /></a></li>';
                        // echo '</div>';/* fin div .lefting-wrap */

                        echo '<div class="righting-wrap">';
                          echo '<li><a href="#" class="importo">' . $ligne_formation['formation'] . '</a></li>';
                          echo '<li><span class="causale" style="color:#000; font-weight: 600;">' . $ligne_formation['stitre_form'] . '</span> </li>';
                          echo '<li><span class="causale">' . $ligne_formation['description_form'] . '</span> </li>';
                          echo '<li><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>' . $ligne_formation['dates_form'] . '</small></p> </li>';
                        echo '</div>';/* fin div .righting-wrap */

                        echo '<div class="clear"></div>';/* div pour casser le float */

                      echo '</ul>';/* fin ul */
                    echo '</div>';/* fin div .timeline-panel credits  anim animate fadeInLeft */
                  echo '</div>';/* fin div .col-sm-11 */
                echo '</div>';/* fin div .row */
              echo '</div>';/* fin div .col-sm-6  timeline-item */
            } 
            else {
            ?>
          </div><!-- fin div #timeline  -->
          <!--fin team-1-->
                
          <!--team-2-->
          <?php 
          echo '<div class="row timeline-movement">';
                echo '<div class="timeline-badge center-right">
                </div>';/* fin div .row timeline-movement */

          echo '<div class="offset-sm-6 col-sm-6  timeline-item">';
            echo '<div class="row">';
              echo '<div class="offset-sm-1 col-sm-11">';
                echo '<div class="timeline-panel debits  anim animate  fadeInRight">';
                  echo '<ul class="timeline-panel-ul">';

                    // echo '<div class="lefting-wrap">';
                    //     echo '<li class="img-wraping"><a href="#"><img src="http://via.placeholder.com/250/000000" class="img-responsive" alt="user-image" /></a></li>';
                    // echo '</div>';/* fin div .lefting-wrap */

                    echo '<div class="righting-wrap">';
                        echo '<li><a href="#" class="importo"></a></li>';
                        echo '<li><span class="causale" style="color:#000; font-weight: 600;">' . $ligne_formation['stitre_form'] . '</span> </li>';
                        echo '<li><span class="causale">' . $ligne_formation['description_form'] . '</span> </li>';
                        echo '<li><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>' . $ligne_formation['dates_form'] . '</small></p> </li>';
                    echo '</div>';/* fin div .righting-wrap */
                    
                    echo '<div class="clear"></div>';/* div pour casser le float */

                  echo '</ul>';/* fin ul .timeline-panel-ul */
                echo '</div>';/* fin div .timeline-panel debits  anim animate  fadeInRight */
              echo '</div>';/* fin div .offset-sm-1 col-sm-11 */
            echo '</div>';/* fin div .row */
          echo '</div>';/* fin div .offset-sm-6 col-sm-6  timeline-item */
          echo '</div>';/*  fin div .row  */ 
          }//fermeture du if ($ligne_experience['id_experience'] % 2 == 1)

          }/* fermeture du while ($ligne_experience = $sql->fetch()) */
          ?>
        
      </div><!-- fin div .container-fluid -->     
    </section><!-- fin section #form --> 

    
   
    <section id="loisir" class="projects-section">  <!-- 3 - loisirs -->
      <div class="container bg-transparent">
        <?php
        //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
        $sql = $pdo->prepare(" SELECT * FROM t_loisirs WHERE id_utilisateur =1 ");
        $sql->execute(); 
        ?>

        <div id="demo" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ul class="carousel-indicators mb-0 pb-0">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
          </ul>

          <?php
          $ligne_loisir = $sql->fetchAll(); 
          ?>

          <!-- The slideshow -->
          <div class="carousel-inner no-padding my-5">

            <div class="carousel-item active">

              <div class="col-xs-4 col-sm-4 col-md-4">
                <a href="#" onclick=abc(this) class="slider_info">
                  <img class="img-fluid card-img-top" src="back/img/<?php echo $ligne_loisir[0]['photo']; ?>">
                </a>
                <p clas="text-center bg-text"><?php echo $ligne_loisir[0]['loisir']; ?></p>
              </div><!-- fin div .col-xs-4 col-sm-4 col-md-4 -->

              <div class="col-xs-4 col-sm-4 col-md-4">
                <a href="#" onclick=abc(this) class="slider_info">
                  <img class="img-fluid card-img-top rounded-bottom" src="back/img/<?php echo $ligne_loisir[1]['photo']; ?>">
                </a>
                <p clas="text-center bg-text"><?php echo $ligne_loisir[1]['loisir']; ?></p>
              </div><!--fin div .col-xs-4 col-sm-4 col-md-4 -->

              <div class="col-xs-4 col-sm-4 col-md-4">
                <a href="#" onclick=abc(this) class="slider_info">
                  <img class="img-fluid card-img-top rounded-bottom" src="back/img/<?php echo $ligne_loisir[2]['photo']; ?>">
                </a>
                <p clas="text-center bg-text"><?php echo $ligne_loisir[2]['loisir']; ?></p>
              </div>

            </div><!-- fin div .carousel-item active -->     <!-- carousel-inner no-padding my-5 -->
            <div class="carousel-item">

              <div class="col-xs-4 col-sm-4 col-md-4">
                <a href="#" onclick=abc(this) class="slider_info">
                  <img class="img-fluid card-img-top" src="back/img/<?php echo $ligne_loisir[3]['photo']; ?>">
                  <!-- <div class="card-img-overlay t_img">
                    <span class="float-left text-uppercase">article</span>
                    <span class="float-right text-uppercase">2345 views</span>
                  </div> -->
                </a>
                <p clas="text-center bg-text"><?php echo $ligne_loisir[3]['loisir']; ?></p>
              </div>

              <div class="col-xs-4 col-sm-4 col-md-4">
                <a href="#" onclick=abc(this) class="slider_info">
                  <img class="img-fluid card-img-top" src="back/img/<?php echo $ligne_loisir[4]['photo']; ?>">
                  <!-- <div class="card-img-overlay t_img">
                    <span class="float-left text-uppercase">article</span>
                    <span class="float-right text-uppercase">2345 views</span>
                  </div> -->
                </a>
                <p clas="text-center bg-text"><?php echo $ligne_loisir[4]['loisir']; ?></p>
              </div>

              <div class="col-xs-4 col-sm-4 col-md-4">
                <a href="#" onclick=abc(this) class="slider_info">
                  <img class="img-fluid card-img-top" src="back/img/<?php echo $ligne_loisir[5]['photo']; ?>">
                  <!-- <div class="card-img-overlay t_img">
                    <span class="float-left text-uppercase">article</span>
                    <span class="float-right text-uppercase">2345 views</span>
                  </div> -->
                </a>
                <p clas="text-center bg-text"><?php echo $ligne_loisir[5]['loisir']; ?></p>
              </div>

            </div><!-- fin div .carousel-item -->
          </div><!-- fin div .carousel-inner no-padding my-5-->

          <!-- Left and right controls -->
          <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon sp"></span>
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon sp"></span>
          </a>
        </div><!-- fin div #demo -->
      </div><!-- fin div .container bg-info -->    
    </section><!-- fin section #loisir -->


    <!-- Signup Section -->
    <section id="signup" class="signup-section">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-lg-6 mx-auto text-center">
            <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
            <h2 class="text-white mb-5">Contacter moi !</h2>
            <form method="post" action="/back/gestion_messages.php" enctype="multipart/form-data">
              <div class="form-group m-2">
                <label for="email"></label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Votre  email">
              </div>
              <div class="form-group m-2">
                <label for="nom"></label>
                <input type="text" id="nom" name="nom" class="form-control" placeholder="Votre  nom">
              </div>
              <div class="form-group m-2">
                <input type="hidden" name="id_message" id="id_message">
                <input type="hidden" name="id_utilisateur" id="id_utilisateur" value="1">
                <label for="message"></label>
                <textarea  type="text" class="form-control" name="message" id="message" rows="3" placeholder="dite-moi tous..."></textarea>  
              </div>
                <!-- <a href="/back/gestion_messages.php"><input type="submit" class="form-control btn-success" id="'.$ligne['id_message'] .'" value="Envoyer"  onclick="return(confirm(\'Etes-vous certain de vouloir enregistrer votre commentaire? \' ))" ></a> -->
            </form>
          </div><!-- fin div .col-md-10 col-lg-6 mx-auto text-center -->
        </div><!-- div .row -->
      </div><!-- div .container -->
    </section><!-- fin section #signup -->
    
    <!--Section .contact-section-->
    <section class="contact-section">
      <div class="container">

        <div class="row">

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">localisation :</h4>
                <hr class="my-4">
                <div class="small text-black-50">96 Rue Romain Rolland. Les Lilas - 93260</div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-envelope text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Email</h4>
                <hr class="my-4">
                <div class="small text-black-50">
                  <a href="#">settibelkacem313 @ gmail.com</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">téléphone :</h4>
                <hr class="my-4">
                <div class="small text-black-50">+33 7 62 44 53 74 </div>
              </div>
            </div>
          </div>
        </div>

        <div class="social d-flex justify-content-center">
          <a href="https://www.linkedin.com/in/setti-belkacem-4931b016a/" class="mx-2">
            <i class="fab fa-linkedin-in"></i>
          </a>
          <!-- <a href="#" class="mx-2">
            <i class="fab fa-facebook-f"></i>
          </a> -->
          <a href="https://www.linkedin.com/in/setti-belkacem-4931b016a/" class="mx-2">
            <i class="fab fa-github"></i>
          </a>
        </div>

      </div>
    </section><!--fin section .contact-section-->

    <!-- Footer -->
    <footer class="bg-black small text-center text-white-50">
      <div class="container">
        Copyright &copy; Setti BELKACEM Site-CV 2018
      </div>
    </footer>
    <!-- fin Footer -->

    <!-- Bootstrap core JavaScript -->
    <script src="back/vendor/jquery/jquery.min.js"></script>
    <script src="back/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="back/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="back/js/grayscale.min.js"></script>
    <script src="back/js/script.js"></script>
    <script src="back/js/grayscale.js"></script>


    <!-- timeline script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <!-- loisirs -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  </body>

</html>
