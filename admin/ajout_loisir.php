<?php
require_once '../inc/init.inc.php';

// 1- On vérifie si l'utilisateur est admin :

    if(!internauteEstConnecteEtAdmin()){
        header('location:../connexion.php'); // si pas admin, on le redirige vers la page de connexion
        exit();
    }


//********************TRI PAR ORDER CROISSANT ET DECROISSANT ************************* */

$order = '';
if(isset($_GET['order']) && isset($_GET['column'])){	// début de if(isset($_GET['order']))

	if($_GET['column'] == 'loisir'){
		$order = ' ORDER BY loisir';
	}
    
    if($_GET['order'] == 'asc'){
		$order.= ' ASC';
	}

	elseif($_GET['order'] == 'desc'){
		$order.= ' DESC';
	}


}	//  fin de if(isset($_GET['order']) && isset($_GET['column']))

//************************************************************************************ */

// 4- Traitement du $_POST : enregistrement du loisir en BDD

// debug($_POST);

if (!empty($_POST)){
    // ICI il faudrait mettre les contrôles sur les champs du formulaire.

    // Ici le code de la photo à venir
    // $photo_bdd = ''; // Par défaut la photo est vide en BDD
    // debug($_FILES);
    // if (!empty($_FILES['photo']['name'])){// 'il y a un nom de fichier dans la superglobale $_FILES, c'est que je suis en train d'uploader un fichier
    //     $nom_photo = $_POST['reference'] . '_' . $_FILES['photo']['name']; // Pour créer un nom de fichier unique, on concatène la référence du produit avec le nom du fichier en cours d'upload

    //     $photo_bdd = 'photo/'. $nom_photo; // chemin relatif de la photo enregistré dans la BDD correspondant au fichier physique uploadé dans le dossier /photo/ du site 
    //     copy($_FILES['photo']['tmp_name'], '../' .$photo_bdd); // on enregistre le fichier photo qui est temporairement dans $_FILES['photo]['tmp_name] dans le répértoire "../photo/nom_photo.jpg"

    // }

  

    // Insertion du loisir en BDD :
    executeRequete("REPLACE INTO t_loisirs VALUES (:id_loisir, :loisir, :id_utilisateur)", array(
                            ':id_loisir'  => $_POST['id_loisir'],
                           ':loisir'   => $_POST['loisir'],
                           ':id_utilisateur'   => $_POST['id_utilisateur']
                            ));

// REPLACE INTO se comporte comme un INSERT INTO quand l'id_loisir n'existe pas en BDD : C'est le cas lors de la création d'un loisir pour lequel nous avons mis un id_loisir à 0 par défaut dans le formulaire (voir champ id_loisir). REPLACE INTO se comporte comme un UPDATE quand l'id_loisir existe en BDD : C'est le cas lors de la modification d'un loisir existant.

$contenu .= '<div class="bg-success">Le loisir a bien été enregitré !</div>';

}/* fin if (!empty($_POST)) */


//------------------------AFFICHAGE---------------------------

require_once '../inc/haut.inc.php';
?>

    <h1 class="mt-4">Gestion loisirs :</h1>

    <ul class="nav nav-tabs">
        <li><a class= "nav-link" href="gestion_cv.php">Affichage de loisirs</a></li>
        <li><a class="nav-link active" href="ajout_loisir.php">Ajout d'un loisir</a></li>
        <li><a class="nav-link" href="modif_loisir.php">Modifier un loisir</a></li>
    </ul>
<?php
 echo $contenu;
 ?>
 <!-- 3- formulaire d'ajout de loisir -->
<h2>Ajout d'un loisir :</h2>

<form method ="post" action="ajout_loisir.php" enctype="multipart/form-data"> 
<input type="hidden" id="id_loisir" name="id_loisir" value="0"><!-- Ce champ caché est utile pour la modification d'un loisir afin de l'identifier dans la requête SQL. La valeur 0 par défaut signifie que le loisir n'existe pas en BDD, et qu'on est en train de le créer -->

<div>
    <label for="loisir">Loisir</label><br>
    <input type="text" name="loisir" id="loisir" value ="">
</div>

<div class="">
    <button class="btn btn-primary" type="submit">Insérer un loisir</button>
</div>
</form>

 <?php

require_once '../inc/bas.inc.php';