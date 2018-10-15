
<?php
require_once '../inc/init.inc.php';

// 1- On vérifie si l'utilisateur est admin :
if(!internauteEstConnecteEtAdmin()) {
        header('location:../connexion.php');   // si pas admin, on le redirige vers la page de connexion
        exit();
}

//********************TRI PAR ORDER CROISSANT ET DECROISSANT ************************* */

$order = '';
if(isset($_GET['order']) && isset($_GET['column'])){	// début de if(isset($_GET['order']))

	if($_GET['column'] == 'competence'){
		$order = ' ORDER BY competence';
	}

	elseif($_GET['column'] == 'niveau'){
		$order = ' ORDER BY niveau';
	}

	
	elseif($_GET['column'] == 'categorie'){
		$order = ' ORDER BY categorie';
    }
    
    if($_GET['order'] == 'asc'){
		$order.= ' ASC';
	}

	elseif($_GET['order'] == 'desc'){
		$order.= ' DESC';
	}


}	//  fin de if(isset($_GET['order']) && isset($_GET['column']))

//***************************************************************** */


// 4- Traitement de $_POST : enregistrement de la competence en BDD 
//debug($_POST);

if(!empty($_POST)) {
    // ICI il faudrait mettre les contrôles sur les champs du formulaire.

    // ICI le code de la photo à venir
    // $photo_bdd ='';  // par défaut la photo est vide en BDD

    // debug($_FILES);

    // if (!empty($_FILES['photo']['name'])) {  // s'il y a un nom de fichier dans la superglobale $_FILES, c"est que je suis en tyrain d'uploader un fichier. L'indice "photo" correspond au name du champ dans le formulaire.
    //     $nom_photo = $_POST['reference'] . '_' . $_FILES['photo']['name'];   // pour créer un nom de fichier unique, on concatène la référence du produit avec le nom du fichier en cour d'upload.

    //     $photo_bdd = 'photo/' . $nom_photo;  // chemin relatif de la photo enregistré dans la BDD correspondant au fichier physique uploadé dans le dossier/photo/ du site

    //     copy($_FILES['photo']['tmp_name'], '../' . $photo_bdd);  // on enregistre le fichier photo qui est tomporairement dans $_FILES['photo']['tmp_name'] dans le répertoire "../photo/nom_photo.jpg"

    // }


    // Insertion de la competence en BDD :
    executeRequete("REPLACE INTO t_competences VALUES (:id_competence, :competence, :niveau, :categorie, :id_utilisateur)", 
      array(':id_competence'   => $_POST['id_competence'],
            ':competence'    => $_POST['competence'],
            ':niveau'    => $_POST['niveau'],
            ':categorie'        => $_POST['categorie'],
            ':id_utilisateur'  => $_POST['id_utilisateur']
        ));
//REPLACE INTO se comporte comme un INSERT INTO quand l'id_competence n'existe pas en BDD : c'est le cas lors de la création d'une competence pour laquelle nous avons mis un id_competence à 0 par défaut dans le formulaire. REPLACE INTO se comporte comme un UPDATE quand l'id_competence existe en BDD : c'est le cas lors de la modification d'une experience existante.

$contenu .= '<div class="bg-success">La competence a bien été enregistré ! </div>';



}// fin du if (!empty($_POST))


//-----------------------------------------AFFICHAGE--------------------------------------------
require_once '../inc/haut.inc.php';
?>
    <h1 class="mt-4">Gestion competences</h1>

    <ul class="nav nav-tabs">
        <li><a class="nav-link" href="gestion_cv.php">Affichage de compétence</a></li>
        <li><a class="nav-link active" href="ajout_competence.php">Ajout d'un compétence</a></li>
        <li><a class="nav-link" href="modif_competence.php">Modifier une compétence</a></li>
    </ul>

<?php
echo $contenu;
?>

<!--  3- formulaire d'ajout de competence -->
<h2>Ajout d'une competence</h2>

<form action="ajout_competence.php" method="post">
    <input type="hidden" id="id_competence" name="id_competence" value="0">

        <div class="form-group">
            <label for="competence">Compétence :</label>
            <input type="text" name="competence" class="form-control" placeholder="Nouvelle compétence" required>
        </div>
        <div class="form-group">
            <label for="niveau">Niveau :</label>
            <input type="text" name="niveau" class="form-control" placeholder="Niveau en chiffre" required>
        </div>
        <div class="form-group">
            <label for="categorie">Catégorie</label>
            <select name="categorie" class="form-control">
                <option value="Back">Back</option>
                <option value="CMS">CMS</option>
                <option value="Front">Front</option>
                <option value="Frameworks">Frameworks</option>
            </select>
        </div>

    <div class="">
        <button class="btn btn-primary" type="submit">Insérer une expérience</button>
    </div>

</form>

   








<?php
require_once '../inc/bas.inc.php';
