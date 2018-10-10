<?php
require_once 'inc/init.inc.php';

// 2- Déconnexion de l'internaute :
if(isset($_GET['action']) && $_GET['action'] == 'deconnexion') {// si l'internaute a cliqué sur "se déconnecter"
    session_destroy();  // on suprime toute la session du membre. Rappel : cette instruction ne s'exécute qu'en fin des script

}


// 3- On vérifie si l'internaute est déjà connecté :
    if(internauteEstConnecte()) { // s'il est connecté on le renvoie vers don profil :
    header('location:profil.php');
    exit();  // pour quitter le script
}












//debug($_POST);

// 1- traitement du formulaire :
if(!empty($_POST)) {  //SI LE FORMULAIRE est sumis

    // Validation des champ :
    if (!isset($_POST['pseudo']) || empty($_POST['pseudo'])) $contenu .= '<div class="bg-danger">le pseudo est requis.</div>';
    if (!isset($_POST['mdp']) || empty($_POST['mdp'])) $contenu .= '<div class="bg-danger">le mot de passe est requis.</div>';
    
    if (empty($contenu)) {  // s'il n'y a pas d'erreur sur le formulaire
        $membre = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo AND mdp = :mdp", array(':pseudo' => $_POST['pseudo'], ':mdp' => $_POST['mdp']));

         if ($membre->rowCount() > 0) {  // si la requete retourne est superieur à 0, alors le login et le mdp existent ensemble en BDD 
            // on crée une session avec les informations du membre :
                $informations = $membre->fetch(PDO::FETCH_ASSOC);  // on fait un fetch pour transformer l'objet $membre en un array associatif qui contient en indices le nom de tous les champs de la requête
                debug($informations);

                $_SESSION ['membre'] = $informations;   // nous créons une session avec les infod du membre qui proviennent de la BDD.

                header('location:profil.php');
                exit();   // on redirige l'internaute vers sa page de profile,  et on quitte ce script avec la fonction exit().                
        } else {
            // sinon c'est qu'il y a erreur sur les identifiants (ils n'existent pas ou pour le même membre)
            $contenu .= '<div class="bg-danger">Erreur sur les identifiants !</div>';
        }

    } // fin du if (empty($contenu)) 

} // fin du if(!empty($_POST))







//------------------------------------------------------------------------AFFICHAGE : --------------------------------------------------------------------
require_once 'inc/haut.inc.php';  // doctype, header, nav
?>
    <h1 class="mt-4">Connexion</h1>
    <?php echo $contenu; ?>
    <form action="" method="post">

    <label for="pseudo">Pseudo</label><br>
    <input type="text" name="pseudo" id="pseudo" value=""><br><br>

    <label for="mdp">Mot de passe</label><br>
    <input type="password" name="mdp" id="mdp" value=""><br><br>

     <input type="submit" value="se connecter" class="btn">

     </form>



<?php

require_once 'inc/bas.inc.php'; // footer et fermeture des balises