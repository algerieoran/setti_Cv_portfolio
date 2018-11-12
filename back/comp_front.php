<?php

require_once 'inc/init.inc.php';

// 1- On vérifie si l'utilisateur est admin :

    if(!internauteEstConnecteEtAdmin()){
        header('location:connexion.php'); // si pas admin, on le redirige vers la page de connexion
        exit();
    }
    extract($_SESSION['t_competences']);


    // Supprimer une nom_front
    if (isset($_GET['id_competence'])) {
        $resultat = executeRequete("DELETE FROM t_competences WHERE id_competence = :id_competence", array(':id_competence' => $_GET['id_competence']));
        
        if ($resultat -> rowCount() == 1) { // si j'ai une ligne dans $resultat, j'ai supprimé un produit
        $contenu .= '<div class="alert alert-success" role="alert">La competence à bien été supprimé</div>';
        } else {
            $contenu .= '<div class="alert alert-danger" role="alert">Erreur lors de la suppression</div>';
        }
    }



// Update de nom_front pour chaque utilisateur
if (!empty($_POST)){ // Si le formulaire est soumis

    // Validation des champs du formulaire
    

    if (!isset($_POST['front']) || strlen($_POST['front']) < 3 || strlen($_POST['front']) > 20  ) $contenu .= '<div class="alert alert-danger" role="alert">Le nom doit contenir entre 5 et 20 caractères.</div>';

    if (!isset($_POST['niveau']) || strlen($_POST['niveau']) < 2 || strlen($_POST['niveau']) > 4  ) $contenu .= '<div class="alert alert-danger" role="alert">Le niveau doit contenir entre 2 et 4 caractères.</div>';


    $avatar_bdd = ''; // Par défaut la photo est vide en BDD
    // debug($_FILES);


    if (!empty($_FILES['avatar']['name'])){// 'il y a un nom de fichier dans la superglobale $_FILES, c'est que je suis en train d'uploader un fichier
        $nom_avatar = $_FILES['avatar']['name']; // Pour créer un nom de fichier unique, on concatène la référence du produit avec le nom du fichier en cours d'upload
    
        $avatar_bdd = $nom_avatar; // chemin relatif de la photo enregistré dans la BDD correspondant au fichier physique uploadé dans le dossier /photo/ du site 
        copy($_FILES['avatar']['tmp_name'], '../' .$avatar_bdd); // on enregistre le fichier avatar qui est temporairement dans $_FILES['photo]['tmp_name] dans le répértoire "../photo/nom_photo.jpg"
    
    }
    //-------------------------------
  
    // Insertion de nouvelles expériences en BDD :
    executeRequete("REPLACE INTO t_competences VALUES (:id_competence, :avatar, :front, :niveau, :id_user)", array( ':id_competence'   => $_POST['id_competence'],
                           ':avatar'   => $avatar_bdd ,
                           ':front'   => $_POST['front'],
                           ':niveau'   => $_POST['niveau'],
                           ':id_user'  => $id_user
                            ));

// REPLACE INTO se comporte comme un INSERT INTO quand l'id_experience n'existe pas en BDD : C'est le cas lors de la création d'une expérience pour lequel nous avons mis un id_expérience à 0 par défaut dans le formulaire (voir champ id_produit). REPLACE INTO se comporte comme un UPDATE quand l'id_experience existe en BDD : C'est le cas lors de la modification d'une expérience existante.

$contenu .= '<div class="alert alert-success" role="alert">La nom_front a bien été enregitré !</div>';

}/* fin if (!empty($_POST)) */




    // Affichage des nom_fronts pour un utilisateur

    $resultat = $pdo->query("SELECT f.id_competence, f.avatar, f.front, f.niveau, us.firstname
                             FROM t_competences f, t_competences us 
                             WHERE us.id_user = $id_user AND f.id_user = $id_user");




     
    // debug($membre);

  
// affichage des informations de chaque ligne $ligne :

    $contenu .='<table class="table table-hover">';
        $contenu .='<thead class="thead-dark">';
            $contenu .= '<tr>';
                $contenu .='<th scope="col">Avatar</th>';
                $contenu .='<th scope="col">Non front</th>';
                $contenu .='<th scope="col">Niveau</th>';
                $contenu .='<th scope="col">Utilisateur</th>';
                $contenu .= '<th colspan="1">Actions</th>';
            $contenu .= '</tr>';
        $contenu .= '</thead>'; 
        while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
        // debug($ligne);
            $contenu .= '<form method="post">' ;
                $contenu .= '<tr>';
                    foreach($ligne as $indice => $valeur){
                            if($indice != 'id_competence'){
                                $contenu .= '<td><input type="text" name="'. $indice .'" id="'. $indice .'" value="'. $valeur . '" ></td>'; 
                            }
                            // else{
                            //     $contenu .= '<td><input type="text" name="'. $indice .'" id="'. $indice .'" value="'. $valeur . '" >'. $valeur . '</td>'; 
                            // }
                        
                    }
                            $contenu .='<td><a href="?id_competence='. $ligne['id_competence'] .'"  onclick="return(confirm(\'Etes-vous certain de vouloir supprimer cette nom_front ? \' ))" ><i class="far fa-trash-alt"></i></a></td>';
                            // $contenu .='<td><a href=""><i class="far fa-edit"></i></a></td>';
    
                            // $contenu .= '<td><input type="submit" id="'.$ligne['id_nom_front'] .'" value="Modifier"  onclick="return(confirm(\'Etes-vous certain de vouloir Modifier cette nom_front ? \' ))" ></td>';
                $contenu .= '</tr>';
            $contenu .= '</form>';  
        }
        // $ligne['id_nom_front'] contien l'id de chaque nom_front à chaque tour de boucle while : ainsi le lien est dynamique, l'id passé en GET change selon le nom_front sur lequel je clique
    

$contenu .='</table>'; 


// affichage de utilisateur
$membre = executeRequete("SELECT  firstname, lastname, email FROM t_competences  WHERE id_user = $id_user");
     
// debug($membre);
$contenu2 .='<table class="table" border = "1">';
    $contenu2 .= '<thead class="thead-dark">';
        $contenu2 .='<tr>';
            
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
                        FROM t_competences
                        ");

while ($membre = $users->fetch(PDO::FETCH_ASSOC)){  
            $contenu1 .= '<option>' . $membre['id_user'] .  '</option>';    
}

    //------------------------AFFICHAGE---------------------------

require_once 'inc/haut.inc.php';
?>


<div class="container mt-5" style="min-width: 180vh">

    <div class="jumbotron mt-5">
        <h1 class="text-center mt-4 mb-4">Gestion des  CVs</h1>
        <h2 class="text-center lead"> Vous êtes un super admin.</h2>
        
    </div>
    <div class="row mb-4">
        <div class="col-lg-12 text-center">
            <h2>Suppression et modification de nom_front</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?php  echo $contenu;?>
        </div>
    </div>

        <div class="row m-5">
            <div class="col-lg-12  d-flex justify-content-center">
                <?php echo $contenu2 ;?>
            </div>
        </div>

    <div class="col-lg-12 ">
                    <h2 class="text-center m-5">Ajout d'une nom_front</h2>
        <form method ="post" action="" enctype="multipart/form-data"> 
            <input type="hidden" id="id_competence" name="id_competence" value="0"><!-- Ce champ caché est utile pour la modification d'un produit afin de l'identifier dans la requête SQL. La valeur 0 par défaut signifie que le produit n'existe pas en BDD, et qu'on est en train de le créer -->

            

            <div class="form-group">
                <label for="avatar">Avatar</label>
                <input type="file"  name="avatar" id="avatar">
            </div>
            <div class="form-group">
                <label for="front">Nom de la nom_front</label><br>
                <input type="text" class="form-control" name="front" id="front" value="">
            </div>

            <div class="form-group">
                <label for="niveau">Niveau nom_front</label><br>
                <input type="text" class="form-control" name="niveau" id="niveau" value="">
            </div>

            

            <div class="form-group">
                <input type="submit" class="form-control btn-success" name="valider" value="valider">
            </div>
        </form>
    </div> 
</div>




<?php

require_once 'inc/bas.inc.php';