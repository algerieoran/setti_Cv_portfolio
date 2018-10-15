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

	if($_GET['column'] == 'titre_exp'){
		$order = ' ORDER BY titre_exp';
	}

	elseif($_GET['column'] == 'stitre_exp'){
		$order = ' ORDER BY stitre_exp';
	}

	elseif($_GET['column'] == 'dates_exp'){
		$order = ' ORDER BY dates_exp';
    }

    elseif($_GET['column'] == 'description_exp'){
		$order = ' ORDER BY description_exp';
    }
    
    if($_GET['order'] == 'asc'){
		$order.= ' ASC';
	}

	elseif($_GET['order'] == 'desc'){
		$order.= ' DESC';
	}


}	//  fin de if(isset($_GET['order']) && isset($_GET['column']))

//**************************************************************** */

// 4- Traitement du $_POST : enregistrement d'une experience en BDD

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

  

    // Insertion d'une experience en BDD :
    executeRequete("REPLACE INTO t_experiences VALUES (:id_experience, :titre_exp, :stitre_exp, :dates_exp, :description_exp, :id_utilisateur)", array(
                            ':id_experience'  => $_POST['id_experience'],
                           ':titre_exp'   => $_POST['titre_exp'],
                           ':stitre_exp'   => $_POST['stitre_exp'],
                           ':dates_exp'   => $_POST['dates_exp'],
                           ':description_exp'   => $_POST['description_exp'],
                           ':id_utilisateur'   => $_POST['id_utilisateur']
                            ));

// REPLACE INTO se comporte comme un INSERT INTO quand l'id_experience n'existe pas en BDD : C'est le cas lors de la création d'une experience pour lequel nous avons mis un id_experience à 0 par défaut dans le formulaire (voir champ id_experience). REPLACE INTO se comporte comme un UPDATE quand l'id_experience existe en BDD : C'est le cas lors de la modification d'une experience existant.

$contenu .= '<div class="bg-success">L\'experience a bien été enregitré !</div>';

}/* fin if (!empty($_POST)) */

//------------------------AFFICHAGE---------------------------

require_once '../inc/haut.inc.php';
?>

    <h1 class="mt-4">Gestion de l'expérience :</h1>

    <ul class="nav nav-tabs">
        <li><a class= "nav-link" href="gestion_cv.php">Affichage de expériences</a></li>
        <li><a class="nav-link active" href="ajout_experience.php">Ajout d'une expérience</a></li>
        <li><a class="nav-link" href="modif_experience.php">Modifier une expérience</a></li>
    </ul>

<?php
 echo $contenu;
?>

 <!-- 3- formulaire d'ajout de l'experience -->
<h2>Ajout d'une experience :</h2>

<form method ="post" action="ajout_experience.php"> 
<input type="hidden" id="id_experience" name="id_experience" value="0">

<div>
    <label for="titre_exp">Le titre de l'expérience :</label><br>
    <input type="text" name="titre_exp" id="titre_exp" value ="" class="form-control" placeholder="Le titre de l'expérience" required>
</div>
<div>
    <label for="stitre_exp">Le sous titre :</label><br>
    <input type="text" name="stitre_exp" id="stitre_exp" value ="" class="form-control" placeholder="Le sous titre de l'expérience">
</div>
<div>
    <label for="dates_form">La date de l'expérience :</label><br>
    <input type="text" name="dates_form" id="dates_form" value ="" class="form-control" placeholder="La date de l'expérience">
</div>
<div>
    <label for="description_exp">Description :</label><br>
    <textarea name="description_exp" id="description_exp" cols="30" rows="10" class="form-control" placeholder="La déscription"></textarea>
</div>


<div class="">
            <button class="btn btn-primary" type="submit">Insérer une expérience</button>
        </div>
</form>

 <?php

require_once '../inc/bas.inc.php';