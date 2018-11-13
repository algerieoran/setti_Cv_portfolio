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
    <!------ Include the above in your HEAD tag ---------->

    <title>Site CVportfolio Setti Belkacem</title>

    <!-- Bootstrap core CSS -->
    <link href="back/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="back/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="back/css/grayscale.min.css" rel="stylesheet">
    <!-- style maison -->
    <link rel="stylesheet" href="back/css/style.css">

  </head>

  <body id="page-top" class="bg-secondary">

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
          <div class="col-lg-8 mx-auto">
            <h2 class="text-white mb-4">A propos de moi </h2>
            <p class="text-white-50">Je me présente, Setti BELKACEM. Développeur Web Intégrateur Junior. <br>
              Actuellement, en formation de 10 mois labellisée Grande École du Numérique Techniques de développement web et mobile avec WebForce3. 
            Sociable, impliquée, à l'écoute des contraintes professionnelles et aux besoins du client, je suis à la recherche d'un stage non rémunéré d'une durée de 2 mois (Janv -Fév.).
          </div>
        </div>
        <img src="back/img/profil.jpg" class="img-fluid rounded-circle mb-5" width="250" heigth="250" alt="profil">
      </div>
    </section>
    <!-- Project Two Row -->
    
    <section id="skills" class="projects-section bg-light">
    <div class="container">
            <h4>Timeline Style : Demo-12</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-timeline12">
                        <div class="col-md-2 col-sm-4 timeline">
                            <span class="timeline-icon">
                                <i class="fa fa-key"></i>
                            </span>
                            <div class="border"></div>
                            <div class="timeline-content">
                                <h4 class="title">Williamson</h4>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur.</p>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 timeline">
                            <div class="timeline-content">
                                <h4 class="title">Kristiana</h4>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur.</p>
                            </div>
                            <div class="border"></div>
                                <span class="timeline-icon">
                                    <i class="fa fa-key"></i>
                                </span>
                        </div>
                        <div class="col-md-2 col-sm-4 timeline">
                            <span class="timeline-icon">
                                <i class="fa fa-key"></i>
                            </span>
                            <div class="border"></div>
                            <div class="timeline-content">
                                <h4 class="title">Steve thomas</h4>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur.</p>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 timeline">
                            <div class="timeline-content">
                                <h4 class="title">Miranda joy</h4>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur.</p>
                            </div>
                            <div class="border"></div>
                            <span class="timeline-icon">
                                <i class="fa fa-key"></i>
                            </span>
                        </div>
                        <div class="col-md-2 col-sm-4 timeline">
                            <span class="timeline-icon">
                                <i class="fa fa-key"></i>
                            </span>
                            <div class="border"></div>
                            <div class="timeline-content">
                                <h4 class="title">Williamson</h4>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur.</p>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 timeline">
                            <div class="timeline-content">
                                <h4 class="title">Kristiana</h4>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur.</p>
                            </div>
                            <div class="border"></div>
                            <span class="timeline-icon">
                                <i class="fa fa-key"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
    <!-- Projects Section -->
    <div class="container bg-white">
          <h2 class="text-black mb-4">Parcours </h2>
            <h4>FORMATIONS </h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-timeline">
                        <a href="#" class="timeline">
                            <div class="timeline-icon"><i class="fa fa-globe"></i></div>
                            <div class="timeline-content">
                            
                                <h3 class="title">FORMATION INTÉGRATEUR DÉVELOPPEUR WEB</h3>
                                <strong> Webforce 3 et LePoleS - depuis mai 2018 </strong>
                                <p class="description">
                                Formation de 10 mois labellisée Grande École du Numérique Techniques de développement web et mobile
                                </p>
                            </div>
                        </a>
                        <a href="#" class="timeline">
                            <div class="timeline-icon"><i class="fa fa-rocket"></i></div>
                            <div class="timeline-content">
                                <h3 class="title">PARCOURS NUMÉRIQUE</h3>
                                <strong>Association Colombbus - Mars 2018</strong>
                                <p class="description">
                                Initiation au développement, à la programmation et à la maintenance informatique

                                </p>
                            </div>
                        </a>
                        <a href="#" class="timeline">
                            <div class="timeline-icon"><i class="fa fa-briefcase"></i></div>
                            <div class="timeline-content">
                                <h3 class="title"> PASSAGE DU PASSEPORT NUMÉRIQUE MULTIMÉDIA</h3>
                                <strong>Association emmauS - Avril 2017 </strong>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate ducimus officiis quod! Aperiam eveniet nam nostrum odit quasi ullam voluptatum.
                                </p>
                            </div>
                        </a>
                        <a href="#" class="timeline">
                            <div class="timeline-icon"><i class="fa fa-mobile"></i></div>
                            <div class="timeline-content">
                                <h3 class="title">LICENCE D'ENSEIGNEMENT EN ANGLAIS </h3>
                                <strong></strong>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate ducimus officiis quod! Aperiam eveniet nam nostrum odit quasi ullam voluptatum.
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

          
        <!-- Project One Row -->
       
        <!-- Projects Section -->
    
            <div class="container">
            <h4>EXPÉRIENCES PROFESSIONNELLES</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-timeline3">
                        <div class="timeline">
                            <a href="#" class="timeline-content">
                                <span class="year">2018</span>
                                <h3 class="title">Web Designer</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer malesuada tellus lorem, et condimentum neque commodo quis.
                                </p>
                            </a>
                        </div>
                        <div class="timeline">
                            <a href="#" class="timeline-content">
                                <span class="year">2017</span>
                                <h3 class="title">Web Developer</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer malesuada tellus lorem, et condimentum neque commodo quis.
                                </p>
                            </a>
                        </div>
                        <div class="timeline">
                            <a href="#" class="timeline-content">
                                <span class="year">2016</span>
                                <h3 class="title">Web Designer</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer malesuada tellus lorem, et condimentum neque commodo quis.
                                </p>
                            </a>
                        </div>
                        <div class="timeline">
                            <a href="#" class="timeline-content">
                                <span class="year">2015</span>
                                <h3 class="title">Web Developer</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer malesuada tellus lorem, et condimentum neque commodo quis.
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Project Two Row -->
        

      </div>
    </section>

    <!-- Signup Section -->
    <section id="signup" class="signup-section">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-lg-8 mx-auto text-center">

            <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
            <h2 class="text-white mb-5">Subscribe to receive updates!</h2>

            <form class="form-inline d-flex">
              <input type="email" class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" id="inputEmail" placeholder="Enter email address...">
              <button type="submit" class="btn btn-primary mx-auto">Subscribe</button>
            </form>

          </div>
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

    <!-- Footer -->
    <footer class="bg-black small text-center text-white-50">
      <div class="container">
        Copyright &copy; Your Website 2018
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/grayscale.min.js"></script>


        <!-- timeline script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
  </body>

</html>
