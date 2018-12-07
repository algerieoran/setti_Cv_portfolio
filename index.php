<?php require_once 'back/inc/init.inc.php';
  //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
  $sql = $pdo->prepare(" SELECT * FROM t_competences WHERE id_utilisateur = 1 ");
  $sql->execute();          
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="back/css/style.css">
        
    </head>
    <body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navigation">
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
    <header>
      <div class="container d-flex h-100 align-items-center">
        <div class="bg-image"></div>
        <div class="mx-auto text-center bg-text">
          <h1 class="mx-auto my-0 text-uppercase glow">Setti BELKACEM</h1>
          <h2 class="text-white-50 mx-auto mt-2 mb-5">Développeur Web Intégrateur Junior, à la recherche d'un stage.</h2>
          <p><a class="btn btn-primary btn-lg" href="back/doc/cvbelkacem.pdf" download="cvbelkacem.pdf"><i class="fa fa-file-pdf-o"></i> Télécharger mon CV</a></p>
        </div><!-- fin div .mx-auto text-center bg-text -->
      </div><!-- fin div .container d-flex h-100 align-items-center -->
    </header>
    <!-- fin Header -->

        <section id="apropos" class="about-section text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2 class="text-dark mb-4">A propos de moi </h2>
            <p class="text-dark-50">Je me présente, Setti BELKACEM. Développeur Web Intégrateur Junior. <br>
              Actuellement, en formation de 10 mois labellisée Grande École du Numérique Techniques de développement web et mobile avec WebForce3. 
            Sociable, impliquée, à l'écoute des contraintes professionnelles et aux besoins du client, je suis à la recherche d'un stage non rémunéré d'une durée de 2 mois (Janv -Fév.).</p>
          </div><!-- fin div .col-lg-8 mx-auto-->
        </div><!-- fin div .row -->
        <img src="back/img/profil.jpg" class="img-fluid rounded-circle mb-5" width="250" heigth="250" alt="profil">
      </div><!-- fin div .container -->
    </section>
    <!-- fin section #apropos-->
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
                <div class="timeline-badge timeline-future-movement" >
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
                        // echo '<li><a href="#" class="importo"></a></li>';
                        // echo '<li><span class="causale" style="color:#000; font-weight: 600;">' . $ligne_experience['stitre_exp'] . '</span> </li>';
                        // echo '<li><span class="causale">' . $ligne_experience['description_exp'] . '</span> </li>';
                        // echo '<li><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>' . $ligne_experience['dates_exp'] . '</small></p> </li>';
                        echo '<li><a href="#" class="importo">' . $ligne_experience['titre_exp'] . '</a></li>';
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
    
    

    </body>
</html>

