<?php
require_once 'inc/init.inc.php';

$inscription = false;  //  pour s'avoir si l'internaute vient de s'inscrire (on mettra la variable à true) et ne plus afficher le formulaire d'inscription

//
var_dump ($_POST);

// traitement du formulaire :
    if(!empty($_POST)) { //si formulaire est soumis

        // Validation des champs du formulaire :
            if (!isset($_POST['pseudo']) || strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 20) $contenu .= '<div class="bg-danger">le pseudo doit contenir entre 4 et 20 caractères.</div>';

            if (!isset($_POST['mdp']) || strlen($_POST['mdp']) < 4 || strlen($_POST['mdp']) > 20) $contenu .= '<div class="bg-danger">le mot de passe doit contenir entre 4 et 20 caractères.</div>';

            if (!isset($_POST['nom']) || strlen($_POST['nom']) < 4 || strlen($_POST['nom']) > 20) $contenu .= '<div class="bg-danger">le nom doit contenir entre 4 et 20 caractères.</div>';

            if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 4 || strlen($_POST['prenom']) > 20) $contenu .= '<div class="bg-danger">le prenom doit contenir entre 4 et 20 caractères.</div>';

            if (!isset($_POST['ville']) || strlen($_POST['ville']) < 4 || strlen($_POST['ville']) > 20) $contenu .= '<div class="bg-danger">le ville doit contenir entre 4 et 20 caractères.</div>';

            if (!isset($_POST['civilite']) || ($_POST['civilite'] != 'M' && $_POST['civilite'] != 'Mme')) $contenu .= '<div class="bg-danger">la civilité est incorrecte.</div>';
            if (!isset($_POST['genre']) || ($_POST['genre'] != 'F' && $_POST['genre'] != 'H')) $contenu .= '<div class="bg-danger">la civilité est incorrecte.</div>';

            
            if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $contenu .= '<div class="bg-danger">le Email est incorrecte.</div>';   // filter_var() avec l'argument FILTER_VALIDATE_EMAIL valide que $_POST['email'] est bien de format d'un email. Notez que cela marche aussi pour valider les URL avec FILTER_VALIDATE_URL
            
            if (!isset($_POST['code_postal']) || !ctype_digit($_POST['code_postal']) || strlen($_POST['code_postal']) != 5) $contenu .= '<div class="bg-danger">le code_postal est incorrecte.</div>';   // ctype_digit() permet de vérifier qu'un string contient un nombre entier (utilisé pour les formulaires qui ne retournent que des strings avec le type "text")
            
            if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 4 || strlen($_POST['adresse']) > 50) $contenu .= '<div class="bg-danger">l\'adresse  doit contenir entre 4 et 50 caractères.</div>';



        // ----------------------------------
        // Si pas d'erreur sur le formulaire, on vérifie que le pseudo est disponible dans la BDD :
            if(empty($contenu)) {  // si $contenu est vide, c'est qu'il n'y a pas d'erreur

                // Vérification de pseudo :
                    $user = executeRequete("SELECT * FROM t_utilisateurs WHERE  pseudo = :pseudo", array(':pseudo'=> $_POST['pseudo']));    // on séléction la base les eventuels membre dont le pseudo correspond au pseudo donné par l'internaute lors de l'inscription

                    if ($user->rowCount() > 0) {  // si la requete retourne 1 ou plusieyurs résultas  c'est que le pseudo existe en BDD 
                        $contenu .= '<div class="bg-danger">le pseudo est indisponible. Veuillez en choisir un autre.</div>';

                    } else {
                        // sinon, le pseudo étant indisponible, on enregistre le utilisateur en BDD :
                        executeRequete("INSERT INTO t_utilisateurs (pseudo, mdp, prenom, nom, email, civilite, ville, code_postal, adresse, tel,  age, anniversaire, genre, pays, commentaire, statut) VALUES (:pseudo, :mdp, :prenom, :nom, :email, :civilite, :ville, :code_postal, :adresse, :tel, :age, :anniversaire, :genre, :pays, :commentaire, 0)", 
                        array(':pseudo' =>$_POST['pseudo'],
                                ':mdp' =>$_POST['mdp'],
                                ':prenom' =>$_POST['prenom'],
                                ':nom' =>$_POST['nom'],
                                ':email' =>$_POST['email'],
                                ':civilite' =>$_POST['civilite'],
                                ':ville' =>$_POST['ville'],
                                ':code_postal' =>$_POST['code_postal'],
                                ':adresse' =>$_POST['adresse'],
                                ':tel' =>$_POST['tel'],
                                ':age' =>$_POST['age'],
                                ':anniversaire' =>$_POST['anniversaire'],
                                ':genre' =>$_POST['genre'],
                                ':pays' =>$_POST['pays'],
                                ':commentaire' =>$_POST['commentaire']
                               
                        ));
                    $contenu .= '<div class="bg-success">Vous êtes inscrit à mon site.<a href="connexion.php">Cliquez ici pour vous connecter.</a></div>'; 
                    $inscription = true;   // pour ne plus afficher le formulaire sur la page.

                    }// fin du else

            } // fin de if(empty($contenu))

    }  // fin du if(!empty($_POST))




//--------------------------------------------AFFICHAGE------------------------------------------------------------------
require_once 'inc/haut.inc.php';  // doctype, header, nav
echo $contenu;  // pour afficher les messages à l'internaute
?>
    <h1 class="mt-4">Inscription</h1>
<?php
if (!$inscription) :   // nous entrons dans la condition si $inscription vaut false. Syntaxe en if (condition) : ...endif;
?>

    <p>Vueillez renseigner le formulaire pour s'inscrire :</p>
    <form method="post" action="">

    <div>
        <label for="pseudo">Pseudo :</label><br>
        <input type="text" name="pseudo" id="pseudo" value=""><br><br>
    </div>

    <div>
        <label for="mdp">Mot de passe :</label><br>
        <input type="password" name="mdp" id="mdp" value=""><br><br>

    </div>   
   <div>
        <label for="prenom">Prenom :</label><br>
        <input type="text" name="prenom" id="prenom" value=""><br><br>
   </div>

   <div>
        <label for="nom">Nom :</label><br>
        <input type="text" name="nom" id="nom" value=""><br><br>
   </div>

    <div>
        <label for="email">Email :</label><br>
        <input type="text" name="email" id="email" value=""><br><br>
    </div>

    <div>
        <label>Civilité :</label><br>
        <input type="radio" name="civilite" value="M" checked>M
        <input type="radio" name="civilite" value="Mme">Mme <br><br>
    </div>

    <div>
        <label for="ville">Ville :</label><br>
        <input type="text" name="ville" id="ville" value=""> <br><br>

    </div>  
   <div>
        <label for="code_postal">Code postal :</label><br>
        <input type="text" name="code_postal" id="code_postal" value=""> <br><br>
   </div>

    <div>
        <label for="adresse">Adresse :</label><br>
        <textarea name="adresse" id="adresse"></textarea><br><br>
    </div>

    <div>
        <label for="tel">Téléphone :</label><br>
        <input type="text" name="tel" id="tel" value=""> <br><br>

    </div>  

    <div>
        <label for="age">Age :</label><br>
        <input type="text" name="age" id="age" value=""> <br><br>

    </div>  

    <div>
        <label for="anniversaire">Anniversaire :</label><br>
        <input type="text" name="anniversaire" id="anniversaire" value=""> <br><br>

    </div>

    <div>
        <label>Genre :</label><br>
        <input type="radio" name="genre" value="H" checked>Homme
        <input type="radio" name="genre" value="F">Femme <br><br>
    </div>

    <div>
        <label for="pays">Pays :</label><br>
        <input type="text" name="pays" id="pays" value=""> <br><br>

    </div>  

   

    <div>
        <label for="commentaire">Commentaire :</label><br>
        <textarea name="commentaire" id="commentaire"></textarea><br><br>
    </div>
    <input type="submit" name="inscription" value="s'inscrire" class="btn">

    </form>

<?php
endif;



require_once 'inc/bas.inc.php'; // footer et fermeture des balises