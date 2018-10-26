<?php require_once 'inc/init.inc.php';

// 2 - Déconnexion de l'internaute :

if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {  // si l'internaute a cliqué sur "se déconnecter"
    session_destroy();  // on supprime toute la session du membre. Rappel : cette instruction ne s'exécute qu'en fin de script
}

// GET = ? dans les url ;  (?action=....)

// 3 -  On vérifie si l'internaute est déjà connecté :

if (internauteEstConnecte()) {  // s'il est connecté, on le renvoie vers son profil :
        header('location:profil.php');
        exit();  // pour quitter le script
    }

// debug($_POST);

// 1- traitement du formulaire :
    if (!empty($_POST)) {  // si le formulaire est soumis 
        // Validation des champs du formulaire :
    if (!isset($_POST['email']) || empty($_POST['email'])) $contenu .= '<div class="text-danger">Entrez un email valide.</div>';
    if (!isset($_POST['mdp']) || empty($_POST['mdp'])) $contenu .= '<div class="text-danger">Veuillez entrer votre mot de passe.</div>';
    if (empty($contenu)) {  // s'il n'a pas d'erreur sur le formulaire

        // Vérification du pseudo :

            $t_utilisateurs = executeRequete("SELECT * FROM t_utilisateurs WHERE email = :email AND mdp = :mdp", array(':email' => $_POST['email'], ':mdp' => $_POST['mdp']));  // on sélectionne en base les éventuels membres dont le pseudo correspond au pseudo donné par l'internaute lors de l'inscription

    if ($t_utilisateurs->rowCount() > 0) {  // si le nombre de ligne est supérieur à 0, alors le login et le mot de passe existent ensemble en BDD
            // on crée une session avec les informations du membre :

            $informations = $t_utilisateurs->fetch(PDO::FETCH_ASSOC);  // on fait un fetch pour transformer l'objet $membre en un array associatif qui contient en indices le nom de tous les champs de la requête

            debug($informations);

            $_SESSION['t_utilisateurs'] = $informations;  // nous créons une session avec les infos du membre qui proviennent de la BDD​
            header('location:profil.php');
            exit();  // on redirige l'internaute vers sa page de profil, et on quitte ce script avec la fonction exit()

        } else {
            // sinon c'est qu'il y a une erreur sur les identifiants (ils n'existent pas ou pas pour le même membre)
            $contenu.= '<div class="text-danger">Identifiants incorrects</div>';
        }
    }  // fin du if (empty($contenu))
}  // fin du if (!empty($_POST))

//------------------------------ AFFICHAGE -----------------------

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Setti Dev' Intégrateur Web</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <?php
require_once 'inc/init.inc.php';


// 2 - Déconnexion de l'internaute :
if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {  // si l'internaute a cliqué sur "se déconnecter"
    session_destroy();  // on supprime toute la session du membre. Rappel : cette instruction ne s'exécute qu'en fin de script
}

// GET = ? dans les url ;  (?action=....)

// 3 -  On vérifie si l'internaute est déjà connecté :
if (internauteEstConnecte()) {  // s'il est connecté, on le renvoie vers son profil :
        header('location:profilAdmin.php');
        exit();  // pour quitter le script
    }

// debug($_POST);

// 1- traitement du formulaire :
    if (!empty($_POST)) {  // si le formulaire est soumis 
    
        // Validation des champs du formulaire :

    if (!isset($_POST['email']) || empty($_POST['email'])) $contenu .= '<div class="text-danger">Entrez un email valide.</div>';

    if (!isset($_POST['password']) || empty($_POST['password'])) $contenu .= '<div class="text-danger">Veuillez entrer votre mot de passe.</div>';

    if (empty($contenu)) {  // s'il n'a pas d'erreur sur le formulaire
        // Vérification du pseudo :
            $t_users = executeRequete("SELECT * FROM t_users WHERE email = :email AND password = :password", array(':email' => $_POST['email'], ':password' => $_POST['password']));  // on sélectionne en base les éventuels membres dont le pseudo correspond au pseudo donné par l'internaute lors de l'inscription

    if ($t_users->rowCount() > 0) {  // si le nombre de ligne est supérieur à 0, alors le login et le mot de passe existent ensemble en BDD
            // on crée une session avec les informations du membre :
            $informations = $t_users->fetch(PDO::FETCH_ASSOC);  // on fait un fetch pour transformer l'objet $membre en un array associatif qui contient en indices le nom de tous les champs de la requête
            debug($informations);

            $_SESSION['t_users'] = $informations;  // nous créons une session avec les infos du membre qui proviennent de la BDD

            header('location:profilAdmin.php');
            exit();  // on redirige l'internaute vers sa page de profil, et on quitte ce script avec la fonction exit()


        } else {
            // sinon c'est qu'il y a une erreur sur les identifiants (ils n'existent pas ou pas pour le même membre)
            $contenu.= '<div class="text-danger">Identifiants incorrects. Recommencez !</div>';
        }

    }  // fin du if (empty($contenu))

}  // fin du if (!empty($_POST))




//------------------------------ AFFICHAGE -----------------------

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Setti Dev' Intégrateur Web</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

    <!-- My CSS style -->
    <link rel="stylesheet" href="css/style.css">

    
</head>
<body>
    


 <!-- Page Content -->
 
        <!-- ici nous aurons le contenu spécifique de notre page -->
        
<div class="container-fluid">

 <!-- La marque -->
 <a class="navbar-brand" href="<?php echo RACINE_SITE ?>"><i class="fas fa-home"></i></a>
 <?php echo $contenu ?>


<form action="connexion.php" method="POST" class="card-body">
    
    <div class="form-group">
        <input type="email" id="email" name="email" class="form-control text-dark" style="background-color:transparent" placeholder="@" value="">
    </div>
    
    <div class="form-group">
        <input type="password" id="mdp" name="mdp" class="form-control text-dark" placeholder="Mot de passe" style="background-color:transparent" value="">
    </div>
    
        <button type="submit" name="connexion" class="btn border-dark"  value="se connecter">Connexion</button>
    
</form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>





    



