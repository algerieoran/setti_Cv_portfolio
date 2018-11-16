<?php require_once 'back/inc/init.inc.php';
  //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
  $sql = $pdo->prepare(" SELECT * FROM t_competences WHERE id_utilisateur = 1 ");
  $sql->execute();

   //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
   $sql = $pdo->prepare(" SELECT * FROM t_experiences WHERE id_utilisateur =1 ");
   $sql->execute();
   $nbr_experiences = $sql->rowCount();
            
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

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Setti BELKACEM <br><span>Développeur Intégrateur Web Junior</span></a>
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
              <a class="nav-link js-scroll-trigger" href="#skills">Parcours</a>
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
          <h1 class="mx-auto my-0 text-uppercase glow">Setti BELKACEM</h1>
          <h2 class="text-white-50 mx-auto mt-2 mb-5">Développeur Web Intégrateur Junior, à la recherche d'un stage.</h2>
          <a href="#about" class="btn btn-primary js-scroll-trigger">Adoptez-moi !</a>
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
            <p class="text-white-50">Je me présente, Setti BELKACEM. Développeur Web Intégrateur Junior. <br>
              Actuellement, en formation de 10 mois labellisée Grande École du Numérique Techniques de développement web et mobile avec WebForce3. 
            Sociable, impliquée, à l'écoute des contraintes professionnelles et aux besoins du client, je suis à la recherche d'un stage non rémunéré d'une durée de 2 mois (Janv -Fév.).
          </div>
        </div>
        <img src="back/img/profil.jpg" class="img-fluid rounded-circle mb-5" width="250" heigth="250" alt="profil">
      </div>
    </section>
    <!-- fin About Section -->

    <!-- Section #skills-->
    <section id="skills" class="projects-section bg-light">
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
	                        echo '<span>
	                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis 
	                            natoque penatibus et magnis dis parturient montes,
	                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis 
	                            natoque.
	                        echo </span>';
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
                            echo '<span>
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis 
                                natoque penatibus et magnis dis parturient montes,
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis 
                                natoque.
                                </span>';
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
    

    
    <section><!-- Experiences -->
              
      <div class="container-fluid">
	      <div class="row">
	        <div id="timeline">
          <?php while ($ligne_experience = $sql->fetch()) { }
                    ?>
            <div class="row timeline-movement timeline-movement-top">
              <div class="timeline-badge timeline-future-movement">
                  <p>2018</p>
              </div>
            </div>
			      <div class="row timeline-movement">
				      <div class="timeline-badge center-left">
				      </div>

				      <div class="col-sm-6  timeline-item">
					      <div class="row">
						      <div class="col-sm-11">
							      <div class="timeline-panel credits  anim animate fadeInLeft">
								      <ul class="timeline-panel-ul">
                        <div class="lefting-wrap">
                          <li class="img-wraping"><a href="#"><img src="http://via.placeholder.com/250/000000" class="img-responsive" alt="user-image" /></a></li>
                        </div>
                        <div class="righting-wrap">
                          <li><a href="#" class="importo">Mussum ipsum cacilds</a></li>
                          <li><span class="causale" style="color:#000; font-weight: 600;">Developer </span> </li>
                          <li><span class="causale">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </span> </li>
                          <li><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 13/01/2018, 13:05"</small></p> </li>
                        </div>
									      <div class="clear"></div>
								      </ul>
							      </div>
						      </div>
					      </div>
				      </div>
			      </div>

			      <div class="row timeline-movement">
				      <div class="timeline-badge center-right">
				      </div>

				      <div class="offset-sm-6 col-sm-6  timeline-item">
                <div class="row">
                  <div class="offset-sm-1 col-sm-11">
                    <div class="timeline-panel debits  anim animate  fadeInRight">
                      <ul class="timeline-panel-ul">
                        <div class="lefting-wrap">
                          <li class="img-wraping"><a href="#"><img src="http://via.placeholder.com/250/000000" class="img-responsive" alt="user-image" /></a></li>
                        </div>
                        <div class="righting-wrap">
                          <li><a href="#" class="importo">Mussum ipsum cacilds</a></li>
                          <li><span class="causale" style="color:#000; font-weight: 600;">Web Designer </span> </li>
                          <li><span class="causale">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </span> </li>
                          <li><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 12/01/2018, 13:05"</small></p> </li>
                        </div>
									      <div class="clear"></div>
								      </ul>
							      </div>

						      </div>
					      </div>
				      </div>
			      </div>

			<div class="row timeline-movement">
				<div class="timeline-badge center-left">
					
				</div>
				<div class="col-sm-6  timeline-item">
					<div class="row">
						<div class="col-sm-11">
							<div class="timeline-panel credits  anim animate  fadeInLeft">
								<ul class="timeline-panel-ul">
									<div class="lefting-wrap">
										<li class="img-wraping"><a href="#"><img src="http://via.placeholder.com/250/000000" class="img-responsive" alt="user-image" /></a></li>
									</div>
									<div class="righting-wrap">
										<li><a href="#" class="importo">Mussum ipsum cacilds</a></li>
										<li><span class="causale" style="color:#000; font-weight: 600;">Engineer </span> </li>
										<li><span class="causale">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </span> </li>
										<li><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11/01/2018, 13:05"</small></p> </li>
									</div>
									<div class="clear"></div>
								</ul>
							</div>

						</div>
					</div>
				</div>
			</div>
			
			<div class="row timeline-movement timeline-movement-top">
				<div class="timeline-badge timeline-future-movement">
						<p>2017</p>
				</div>
			</div>
			
			
			<div class="row timeline-movement">
				<div class="timeline-badge center-right">
				
				</div>
				<div class="offset-sm-6 col-sm-6  timeline-item">
					<div class="row">
						<div class="offset-sm-1 col-sm-11">
							<div class="timeline-panel debits  anim animate  fadeInRight">
								<ul class="timeline-panel-ul">
									<div class="lefting-wrap">
										<li class="img-wraping"><a href="#"><img src="http://via.placeholder.com/250/000000" class="img-responsive" alt="user-image" /></a></li>
									</div>
									<div class="righting-wrap">
										<li><a href="#" class="importo">Mussum ipsum cacilds</a></li>
										<li><span class="causale" style="color:#000; font-weight: 600;">Web Designer </span> </li>
										<li><span class="causale">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </span> </li>
										<li><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 12/01/2018, 13:05"</small></p> </li>
									</div>
									<div class="clear"></div>
								</ul>
							</div>

						</div>
					</div>
				</div>
			</div>
			
			
			<div class="row timeline-movement">
				<div class="timeline-badge center-left">
					
				</div>
				<div class="col-sm-6  timeline-item">
					<div class="row">
						<div class="col-sm-11">
							<div class="timeline-panel credits  anim animate  fadeInLeft">
								<ul class="timeline-panel-ul">
									<div class="lefting-wrap">
										<li class="img-wraping"><a href="#"><img src="http://via.placeholder.com/250/000000" class="img-responsive" alt="user-image" /></a></li>
									</div>
									<div class="righting-wrap">
										<li><a href="#" class="importo">Mussum ipsum cacilds</a></li>
										<li><span class="causale" style="color:#000; font-weight: 600;">Engineer </span> </li>
										<li><span class="causale">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </span> </li>
										<li><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11/01/2018, 13:05"</small></p> </li>
									</div>
									<div class="clear"></div>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

    </section>

    <!-- Signup Section -->
    <section id="signup" class="signup-section">
      <div class="row" id="contatti">
<div class="container mt-5" >

    <div class="row" style="height:550px;">
      <div class="col-md-6 maps" >
         <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11880.492291371422!2d12.4922309!3d41.8902102!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x28f1c82e908503c4!2sColosseo!5e0!3m2!1sit!2sit!4v1524815927977" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
      <div class="col-md-6">
        <h2 class="text-uppercase mt-3 font-weight-bold text-white">CONTATTACI</h2>
        <form action="">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <input type="text" class="form-control mt-2" placeholder="Nome/Società" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <input type="text" class="form-control mt-2" placeholder="Oggetto" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <input type="email" class="form-control mt-2" placeholder="Email" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <input type="number" class="form-control mt-2" placeholder="Telefono" required>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Inserisci testo" rows="3" required></textarea>
              </div>
            </div>
            <div class="col-12">
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                <label class="form-check-label" for="invalidCheck2">
                  Accetta le condizioni
                </label>
              </div>
            </div>
            </div>
            <div class="col-12">
              <button class="btn btn-light" type="submit">Invia</button>
            </div>
          </div>
        </form>
        <div class="text-white">
        <h2 class="text-uppercase mt-4 font-weight-bold">dove siamo</h2>

        <i class="fas fa-phone mt-3"></i> <a href="tel:+">(+39) 123456</a><br>
        <i class="fas fa-phone mt-3"></i> <a href="tel:+">(+39) 123456</a><br>
        <i class="fa fa-envelope mt-3"></i> <a href="">info@test.it</a><br>
        <i class="fas fa-globe mt-3"></i> Piazza del Colosseo, 1, 00184 Roma<br>
        <i class="fas fa-globe mt-3"></i> Piazza del Colosseo, 1, 00184 Roma<br>
        <div class="my-4">
        <a href=""><i class="fab fa-facebook fa-3x pr-4"></i></a>
        <a href=""><i class="fab fa-linkedin fa-3x"></i></a>
        </div>
        </div>
      </div>

    </div>
</div>
</div>

<div class="row text-center bg-success text-white" id="author">
  <div class="col-12 mt-4 h3 ">
  <a href="#">by P. Fattoruso</a>
</div>
<div class="col-12 my-2">
<a href="https://www.linkedin.com/in/paolofattoruso/" target="_blank"><i class="fab fa-linkedin fa-3x"></i></a>
</div>
</div>

    </section>
    <!-- Contact Section -->
    <section class="contact-section">
      <div class="container">

        <div class="row">

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Address</h4>
                <hr class="my-4">
                <div class="small text-black-50">4923 Market Street, Orlando FL</div>
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
                  <a href="#">hello@yourdomain.com</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Phone</h4>
                <hr class="my-4">
                <div class="small text-black-50">+1 (555) 902-8832</div>
              </div>
            </div>
          </div>
        </div>

        <div class="social d-flex justify-content-center">
          <a href="#" class="mx-2">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="mx-2">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="mx-2">
            <i class="fab fa-github"></i>
          </a>
        </div>

      </div>
    </section>
    <!-- fin Contact Section -->
    
    
    <!-- Footer -->
    <footer class="section footer-classic context-dark bg-image" style="background: #2d3246;">
        <div class="container">
          <div class="row row-30">
            <div class="col-md-4 col-xl-5">
              <div class="pr-xl-4"><a class="brand" href="index.html"><img class="brand-logo-light" src="images/agency/logo-inverse-140x37.png" alt="" width="140" height="37" srcset="images/agency/logo-retina-inverse-280x74.png 2x"></a>
                <p>We are an award-winning creative agency, dedicated to the best result in web design, promotion, business consulting, and marketing.</p>
                <!-- Rights-->
                <p class="rights"><span>©  </span><span class="copyright-year">2018</span><span> </span><span>Waves</span><span>. </span><span>All Rights Reserved.</span></p>
              </div>
            </div>
            <div class="col-md-4">
              <h5>Contacts</h5>
              <dl class="contact-list">
                <dt>Address:</dt>
                <dd>798 South Park Avenue, Jaipur, Raj</dd>
              </dl>
              <dl class="contact-list">
                <dt>email:</dt>
                <dd><a href="mailto:#">dkstudioin@gmail.com</a></dd>
              </dl>
              <dl class="contact-list">
                <dt>phones:</dt>
                <dd><a href="tel:#">+91 7568543012</a> <span>or</span> <a href="tel:#">+91 9571195353</a>
                </dd>
              </dl>
            </div>
            <div class="col-md-4 col-xl-3">
              <h5>Links</h5>
              <ul class="nav-list">
                <li><a href="#">About</a></li>
                <li><a href="#">Projects</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contacts</a></li>
                <li><a href="#">Pricing</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row no-gutters social-container">
          <div class="col"><a class="social-inner" href="#"><span class="icon mdi mdi-facebook"></span><span>Facebook</span></a></div>
          <div class="col"><a class="social-inner" href="#"><span class="icon mdi mdi-instagram"></span><span>instagram</span></a></div>
          <div class="col"><a class="social-inner" href="#"><span class="icon mdi mdi-twitter"></span><span>twitter</span></a></div>
          <div class="col"><a class="social-inner" href="#"><span class="icon mdi mdi-youtube-play"></span><span>google</span></a></div>
        </div>
      </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="back/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="back/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="back/js/grayscale.min.js"></script>
    <script src="back/js/script.js"></script>
    


         
  </body>

</html>
