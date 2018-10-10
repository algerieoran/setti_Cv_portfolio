<?php
require_once '../inc/init.inc.php';
// require_once '../inc/requet.php';

if(!internauteEstConnecte()){ // si le membre n'est pas connecté, il ne doit pas avoir accès à la page profil
    header('location:connexion.php'); // nous l'invitons à se connecter
    exit();
}
// require_once '../inc/requet.php';



extract($_SESSION['t_users']);// Extrait tous les indices de l'array sous forme de variables auxquelles on 

//suppression de l'esxpérience
if (isset($_GET['id_experience']))  {
    $resultat = executeRequete("DELETE FROM t_experiences WHERE id_experience = :id_experience", array(':id_experience' => $_GET['id_experience']));
    
    if ($resultat -> rowCount() == 1) { // si j'ai une ligne dans $resultat, j'ai supprimé un produit
    $contenu .= '<div class="alert alert-success" role="alert">L\expérience à bien été supprimé</div>';
    } else {
        $contenu .= '<div class="alert alert-danger" role="alert">Erreur lors de la suppression</div>';
    }
}


//-------------------
if (!empty($_POST)) {

    $resultat = executeRequete("UPDATE t_loisirs 
                                SET id_loisir = :id_loisir, type= :type, date_debut= :date_debut, dep_service= :dep_service, entreprise= :entreprise, date_fin =:date_fin, id_user= :id_user
                                WHERE id_loisir = :id_loisir",
                               array(':id_loisir' => $_POST['id_loisir'],
                                    ':type' => $_POST['type'],
                                    ':date_debut' => $_POST['date_debut'],                             
                                    ':dep_service' => $_POST['dep_service'],
                                    ':entreprise' => $_POST['entreprise'],
                                   
                                    ':date_fin' => $_POST['date_fin'],
                                    ':id_user' => $_POST['id_user']
                                    ));
    if ($resultat -> rowCount() == 1) { // si j'ai une ligne dans $resultat, j'ai modifié un user
    $contenu .= '<div class="alert alert-success" role="alert">Loisir à bien été bien modifier</div>';
    } else {
        $contenu .= '<div class="alert alert-danger" role="alert">Erreur lors de la modification</div>';
    }
}



if (!empty($_POST)){ // Si le formulaire est soumis

    // Validation des champs du formulaire
    

    if (!isset($_POST['type']) || strlen($_POST['type']) < 4 || strlen($_POST['type']) > 50  ) $contenu .= '<div class="alert alert-danger" role="alert">Le type doit contenir entre 8 et 20 caractères.</div>';
    if (!isset($_POST['entreprise']) || strlen($_POST['entreprise']) < 4 || strlen($_POST['entreprise']) > 50  ) $contenu .= '<div class="alert alert-danger" role="alert">Le type doit contenir entre 8 et 20 caractères.</div>';
    if (!isset($_POST['duree']) || strlen($_POST['duree']) < 5 || strlen($_POST['duree']) > 10  ) $contenu .= '<div class="alert alert-danger" role="alert">La durée doit contenir entre 8 et 20 caractères.</div>';
    
    if (!isset($_POST['type']) || strlen($_POST['type']) < 4 || strlen($_POST['type']) > 35  ) $contenu .= '<div class="alert alert-danger" role="alert">L\'entreprise doit contenir entre 8 et 35 caractères.</div>';

    if (!isset($_POST['date_debut']) || !validateDate($_POST['date_debut'], 'Y')) $contenu .= '<div>La date n\'est pas valide .</div>'; // On entre dans la condition si l'indice "date_embauche" n'existe pas OU que la fonction validateDate() ne retourne false (attention à la présence du "!")

    if (!isset($_POST['date_fin']) || !validateDate($_POST['date_fin'], 'Y')) $contenu .= '<div class="alert alert-danger" role="alert">La date n\'est pas valide .</div>'; // On entre dans la condition si l'indice "date_embauche" n'existe pas OU que la fonction validateDate() ne retourne false (attention à la présence du "!")

    // if (!isset($_POST['date_fin']) || $_POST['date_fin'] > date('Y')) $contenu .= '<p class="rouge">La date est incorect.</p>';// a retenir (a utilisé)

    if (!isset($_POST['dep_service']) || !ctype_digit($_POST['dep_service'])  || strlen($_POST['dep_service']) != 2  ) $contenu .= '<div class="alert alert-danger" role="alert">Le département  est incorrect.</div>'; // la fonction ctype_digit() permet de vérifier qu'un string contient un nombre entier (utilisé pour les formulaires qui ne retournent que des string avec le type "text")

    //-------------------------------
  
    // Insertion de nouvelles expériences en BDD :
    executeRequete("REPLACE INTO t_experiences VALUES (:id_experience, :type, :date_debut, :duree, :entreprise, :dep_service, :id_user, :date_fin)", array(
                            ':id_experience'  => $_POST['id_experience'],
                           ':type'   => $_POST['type'],
                           ':date_debut'   => $_POST['date_debut'],
                           ':duree'   => $_POST['duree'],
                           ':date_fin'       => $_POST['date_fin'],
                           ':dep_service' => $_POST['dep_service'],
                           ':id_user'  => $_POST['id_user'],
                           ':entreprise'     => $_POST['entreprise']
                            ));

// REPLACE INTO se comporte comme un INSERT INTO quand l'id_experience n'existe pas en BDD : C'est le cas lors de la création d'une expérience pour lequel nous avons mis un id_expérience à 0 par défaut dans le formulaire (voir champ id_produit). REPLACE INTO se comporte comme un UPDATE quand l'id_experience existe en BDD : C'est le cas lors de la modification d'une expérience existante.

$contenu .= '<div class="alert alert-success" role="alert">L\'expétience a bien été enregitré !</div>';

}/* fin if (!empty($_POST)) */
    

$resultat1 = $pdo->query("SELECT  ex.id_experience, ex.type, ex.date_debut, duree,                                                        ex.entreprise, dep_service, us.id_user, ex.date_fin
                             FROM t_experiences ex, t_users us");



// affichage des informations de chaque ligne $ligne :

$contenu .='<table class="table table-hover">';
    $contenu .='<thead class="thead-dark">';
        $contenu .= '<tr>';
            $contenu .='<th scope="col">Identifiant</th>';
            $contenu .='<th scope="col">Type</th>';
            $contenu .='<th scope="col">Date du début</th>';
            $contenu .='<th scope="col">Duée</th>';
            $contenu .='<th scope="col">Entreprise</th>';
            $contenu .='<th scope="col">département</th>';
            $contenu .='<th scope="col">Utilisateur</th>';
            $contenu .='<th scope="col">Date de fin</th>';
            $contenu .= '<th colspan="2">Action</th>';

            // $contenu .= '<th colspan="3">Actions</th>';
        $contenu .= '</tr>';
    $contenu .= '</thead>'; 
        while($ligne = $resultat1->fetch(PDO::FETCH_ASSOC)) {
        // debug($ligne);
           
                $contenu .= '<tr>';
                    foreach($ligne as $indice => $valeur){                            
                        $contenu .= '<td>' . $valeur . '</td>';
                    }
                    $contenu .='<td><a href="?id_experience='. $ligne['id_experience'] .'"  onclick="return(confirm(\'Etes-vous certain de vouloir supprimer cette experience ? \' ))" ><i class="far fa-trash-alt"></i></a></td>';
                    // $contenu .='<td><a href="?id_experience='. $ligne['id_experience'] .'" onclick="return(confirm(\'Etes-vous certain de vouloir modifier cette experience ? \' ))"><i class="far fa-edit"></i></a></td>';
                $contenu .= '</tr>';
          
        }
        // $ligne['id_user'] contien l'id de chaque produit à chaque tour de boucle while : ainsi le lien est dynamique, l'id passé en GET change selon le produit sur lequel je clique
$contenu .='</table'; 


// affichage des utilisateur
$membre = executeRequete("SELECT id_user, firstname, lastname, email FROM t_users");
     
// debug($membre);
$contenu2 .='<table class="table" border = "1">';
    $contenu2 .= '<thead class="thead-dark">';
        $contenu2 .='<tr>';
            $contenu2 .= '<th>N° User</th>' ;
            $contenu2 .= '<th>nom</th>' ;
            $contenu2 .= '<th>prenom</th>' ;
            $contenu2 .= '<th>email</th>' ;
        $contenu2 .='</tr>';
    $contenu2 .= '</thead>';

while ($inscrit = $membre->fetch(PDO::FETCH_ASSOC)){
    $contenu2 .= '<tr>';
        foreach ($inscrit as $indice => $info) {
            // Affichage de chaque ligne à chaque tour de boucle sauf "mdp"
        if ($indice != 'psw'){

            $contenu2 .= '<td>' . $info . '</td>';
        }
            
        }
    $contenu2 .='</tr>';
}
$contenu2 .='</table>';



// affichage des options

$users = $pdo -> query("SELECT id_user, firstname
                        FROM t_users
                        ");

while ($membre = $users->fetch(PDO::FETCH_ASSOC)){  
            $contenu1 .= '<option>' . $membre['id_user'] .  '</option>';    
}

































//------------------------AFFICHAGE---------------------------

require_once '../inc/haut.inc.php';
?>
<div class="row">
    <div class="col-lg-12 text-center">
        <h1 class="mt-4 mb-4">Gestion des  CVs </h1>
    </div>
</div>

<ul class="nav nav-tabs mb-5">
    <li>
        <a class= "nav-link active" href="update_exper.php">Mise à jour de l'expérience </a>
    </li>
    <li><a class="nav-link" href="update_langue.php">Mise à jour de langue</a></li>
    <li><a class="nav-link" href="update_hobbies.php">Mise à jour de hobbies</a></li>
    <li><a class="nav-link" href="update_formation.php">Mise à jour de formation</a></li>
    <li><a class="nav-link" href="update_reseau.php">Mise à jour de reseau social</a></li>
    <li><a class="nav-link" href="update_profil.php">Mise à jour de reseau profil</a></li>
</ul>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <h2>Suppression et Modification de l'Expérience</h2>
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-lg-12 m-3">
            <?php echo  $contenu ;?>
        </div>
    </div>
    

   
       
    <div class="row m-5">
        <div class="col-lg-12  d-flex justify-content-center">
            <?php echo $contenu2 ;?>
        </div>
    </div>
            
     
   
       
            <div class="col-lg-12 ">
                <h2 class="text-center m-5">Ajout d'une expérience</h2>
                <form method ="post" action=""> 
                    <input type="hidden" id="id_experience" name="id_experience" value="0"><!-- Ce champ caché est utile pour la modification d'un produit afin de l'identifier dans la requête SQL. La valeur 0 par défaut signifie que le produit n'existe pas en BDD, et qu'on est en train de le créer -->
        
                    <div class="form-group">
                        <label for="id_user">Choix de l'utilisateur :</label>
                        <select type="text" class="form-control" name="id_user" id="id_user" value ="">
                                <?php echo $contenu1 ;?>
                        </select>
                    </div>
        
                    <div class="form-group">
                        <label for="type">Type</label><br>
                        <input type="text" class="form-control" name="type" id="type" value="">
                    </div>
        
                    <div class="form-group">
                        <label for="date_debut">date du debut</label><br>
                        <input type="text" class="form-control" name="date_debut" id="date_debut" value="">
                    </div>
        
                    <div class="form-group">
                        <label for="duree">Durée</label><br>
                        <input type="text" class="form-control" name="duree" id="duree" value="">
                    </div>
        
                    <div class="form-group">
                        <label for="dep_service">Département :</label>
                        <input type="text" class="form-control" name="dep_service" id="dep_service" value ="">
                    </div>       
        
                    <div class="form-group">
                        <label for="entreprise">Entreprise :</label>
                        <input type="text" class="form-control" name="entreprise" id="entreprise" value ="">
                    </div>              
        
                    <div class="form-group">
                        <label for="date_fin">Date de fin</label><br>
                        <input type="text" class="form-control" name="date_fin" id="date_fin" value="">
                    </div>
        
                    <div class="form-group">
                        <input type="submit" class="form-control btn-success" name="valider" value="valider">
                    </div>
                </form>
            </div> 

      
        
 

</div>






















<?php
require_once '../inc/bas.inc.php';