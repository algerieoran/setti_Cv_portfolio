<?php require_once 'inc/init.inc.php';

// 2 - Déconnexion de l'internaute :

if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {  // si l'internaute a cliqué sur "se déconnecter"
    session_destroy();  // on supprime toute la session du l'utilisateur.
                        // Rappel : cette instruction ne s'exécute qu'en fin de script
}



// 3 -  On vérifie si l'internaute est déjà connecté :

if (internauteEstConnecte()) {  // s'il est connecté, on le renvoie vers son index :
        header('location:index.php');
        exit();  // pour quitter le script
    }

// debug($_POST);

// 1- traitement du formulaire :
    if (!empty($_POST)) {  // si le formulaire est soumis 
        // Validation des champs du formulaire :
    if (!isset($_POST['email']) || empty($_POST['email'])) $contenu .= '<div class="text-danger">Entrez un email valide !</div>';
    if (!isset($_POST['mdp']) || empty($_POST['mdp'])) $contenu .= '<div class="text-danger">Veuillez entrer votre mot de passe !</div>';
    if (empty($contenu)) {  // s'il n'a pas d'erreur sur le formulaire

        // Vérification du pseudo :

            $t_utilisateurs = executeRequete("SELECT * FROM t_utilisateurs WHERE email = :email AND mdp = :mdp", array(':email' => $_POST['email'], ':mdp' => $_POST['mdp']));  // on sélectionne en base les éventuels membres dont le pseudo correspond au pseudo donné par l'internaute lors de l'inscription

    if ($t_utilisateurs->rowCount() > 0) {  // si le nombre de ligne est supérieur à 0, alors le login et le mot de passe existent ensemble en BDD
            // on crée une session avec les informations du membre :

            $informations = $t_utilisateurs->fetch(PDO::FETCH_ASSOC);  // on fait un fetch pour transformer l'objet $membre en un array associatif qui contient en indices le nom de tous les champs de la requête

            debug($informations);

            $_SESSION['t_utilisateurs'] = $informations;  // nous créons une session avec les infos du membre qui proviennent de la BDD​
            header('location:index.php');
            exit();  // on redirige l'internaute vers sa page de index, et on quitte ce script avec la fonction exit()

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
        <title>Document</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
        <!-- My CSS style -->
        <link rel="stylesheet" href="css/styleAdmin.css">
    </head>

    <body>
        <!-- La marque -->
        <a class="navbar-brand" href="<?php echo RACINE_SITE . 'index.php' ?>"><i class="fas fa-home"></i></a>

        <form class="login-content" method="post" action="connexion.php">
            <div class="imgcontainer">
                <img src="img/login.png" alt="login" class="avatar">
            </div>

            <div class="container margin margine">
                <div class="col-50">
                    <label for="email"><i class="fa fa-envelope icon"></i></label>
                    <input type="text" class="input-field" placeholder="Votre Email" style="background-color:transparent;color:#fff" name="email" required>
                </div>

                <div class="col-50">
                    <label for="mdp"><i class="fa fa-key icon"></i></label>
                    <input type="password" class="input-field" placeholder="Mot de passe"  name="mdp"style="background-color:transparent;color:#fff" required>
                </div>
            </div>

            <div class="row">
                <button type="submit" class="btn" style="background-color:#f1f1f1;opacity:0.5">Connexion</button>
            </div>

           
        </form>

        
    <?php include 'inc/bas.inc.php'; ?>


    
    
    

    

    


    









    



