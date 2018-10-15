<?php// traitement pour la connexion à l'admin

if (isset($_POST['connexion'])) {
  $email = addslashes($_POST['email']);

  $mdp = addslashes($_POST['mdp']);    
  $sql = $pdoCV -> prepare ("SELECT * FROM t_utilisateurs WHERE email='$email' AND mdp='$mdp");

  // Ici, on vérifie email et mot de passe

  $sql -> execute();

  $nbr_utilisateur = $sql -> rowCount(); // on compte si il est dans la BDD ; le compte répond 0 si il n'y est pas et répond 1 si il y est    
  if ($nbr_utilisateur == 0) {

      echo $nbr_utilisateur;

  } else {
      echo $nbr_utilisateur;
  }
} // fin de if (isset($_POST['connexion']))
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CDN Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <!-- Lien Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- CSS maison -->
    <link rel="stylesheet" href="admin/css/style.css">

    <title>Admin : end</title>
</head>
<body class="text-center">
    <form class="form-signin">
      <img class="mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Authentification</h1>
      <label for="inputEmail" class="sr-only">Votre email :</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Votre mot de passe :</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Rester connecter
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  
    </form>
  </body>
</html>