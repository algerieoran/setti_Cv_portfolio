<?php require_once 'inc/init.inc.php';

//pour le tri des colonnes par ordre croissant et decroissant
$ordre = ''; // on vide la variable 

if (isset($_GET['ordre']) && isset($_GET['colonne'])) {

  if ($_GET['colonne'] == 'titre_form') {
    $ordre = ' ORDER BY titre_form'; 

  } elseif ($_GET['colonne'] == 'stitre_form') {
    $ordre = ' ORDER BY stitre_form';

  } elseif ($_GET['colonne'] == 'dates_form') {
    $ordre = ' ORDER BY dates_form';

  } elseif ($_GET['colonne'] == 'description_form') {
    $ordre = ' ORDER BY descrition_form';
  }

  if ($_GET['ordre'] == 'asc') {
    $ordre .= ' ASC';
  } elseif ($_GET['ordre'] == 'desc') {
    $ordre .= ' DESC';
  }
}

// 4- Traitement de $_POST : enregistrement de la competence en BDD 
//debug($_POST);

if (!empty($_POST)) {
    // ICI il faudrait mettre les contrôles sur les champs du formulaire.

    // ICI le code de la photo à venir
    // $photo_bdd ='';  // par défaut la photo est vide en BDD

    // debug($_FILES);

    // if (!empty($_FILES['photo']['name'])) {  // s'il y a un nom de fichier dans la superglobale $_FILES, c"est que je suis en tyrain d'uploader un fichier. L'indice "photo" correspond au name du champ dans le formulaire.
    //     $nom_photo = $_POST['reference'] . '_' . $_FILES['photo']['name'];   // pour créer un nom de fichier unique, on concatène la référence du produit avec le nom du fichier en cour d'upload.

    //     $photo_bdd = 'photo/' . $nom_photo;  // chemin relatif de la photo enregistré dans la BDD correspondant au fichier physique uploadé dans le dossier/photo/ du site

    //     copy($_FILES['photo']['tmp_name'], '../' . $photo_bdd);  // on enregistre le fichier photo qui est tomporairement dans $_FILES['photo']['tmp_name'] dans le répertoire "../photo/nom_photo.jpg"

    // }


    // Insertion d'une formation en BDD :
    executeRequete(
        "REPLACE INTO t_formations VALUES (:id_formation, :icon, :dates_form, :titre_form, :stitre_form, description_form, :id_utilisateur)",
        array(
            ':id_formation' => $_POST['id_formation'],
            ':icon' => $_POST['icon'],
            ':dates_form' => $_POST['dates_form'],
            ':titre_form' => $_POST['titre_form'],
            ':stitre_form' => $_POST['stitre_form'],
            ':description_form' => $_POST['description_form'],
            ':id_utilisateur' => $_POST['id_utilisateur']
        )
    );
    //REPLACE INTO se comporte comme un INSERT INTO quand l'id_formation n'existe pas en BDD : c'est le cas lors de la création d'une formation pour laquelle nous avons mis un id_formation à 0 par défaut dans le formulaire. REPLACE INTO se comporte comme un UPDATE quand l'id_formation existe en BDD : c'est le cas lors de la modification d'une formation existante.

    $contenu .= '<div class="bg-success">La formation a bien été enregistrée ! </div>';

}// fin du if (!empty($_POST))

//suppression d'un élément de la BDD
if (isset($_GET['id_formation'])) {// on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_formation'];// je passe l'id dans une variable $efface

    $resultat = $pdo->query("DELETE FROM t_formations WHERE id_formation = '$efface' ");

    // header("location: ../back/formations.php");
}//ferme le if isset pour la suppression

//----------------------------- AFFICHAGE ---------------------
require_once 'inc/haut.inc.php';
?>

<div class="container margin">
    <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-8 col-xl-8">
            <?php
            //requête pour compter et chercher plusieurs enregistrements, on ne peut compter que si on a un prepare

            $sql = $pdo->prepare("SELECT * FROM t_formations" . $ordre);
            $sql->execute();
            $nbr_formations = $sql->rowCount();
            ?>

            <div class="table-responsive">
            <div class="card-header">
                La liste des compétences : <?php echo $nbr_formations; ?>
            </div>
            <table class="table table-striped table-sm">

                <thead class="thead-dark">
                    <tr>
                        <th>icon</th>
                        <th style="width:18%;">Dates<a href="formations.php?column=dates_forms&ordre=asc"> <i class="fas fa-sort-up"></i></a> |
                        <a href="formations.php?column=dates_forms&ordre=desc"> <i class="fas fa-sort-down"></i></a></th>
                        <th style="width:27%;">Titre formation</th>
                        <th style="width:25%;">Sous-titres</th>
                        <th style="width:25%;">Description</th>
                        <th>Modifier </th>
                        <th>Supprimer </th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while($line_formation=$sql ->fetch())
                    {
                    ?> 
                    <tr id="<?php echo $line_formation['id_formation']; ?>">
                        <td><?php echo $line_formation['icon']; ?></td>
                        <td><?php echo $line_formation['dates_form']; ?></td>
                        <td><?php echo $line_formation['titre_form']; ?></td>
                        <td><?php echo $line_formation['stitre_form']; ?></td>
                        <td><?php echo $line_formation['description_form']; ?></td>
                        <td><a href="modif_formation.php?id_formation=<?php echo $line_formation['id_formation']; ?>"><i class="fas fa-edit"></i></a></td> 
                        <td><a href="formations.php?id_formation=<?php echo $line_formation['id_formation']; ?>"><i class="fas fa-window-close"></i></a></td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
            </div>

            <p class="text-primary font-weight-bold text-center">La liste des formations : <?php echo $nbr_formations; ?></p>
        </div> <!-- fin col 1 -->
            
         <div class="col-xs-12 col-sm-12 col-md-3 col-xl-3">   
        <div class="card-header border border-dark text-center">AJOUTER</div>

            <form action="" method="post" class="text-dark border border-dark p-2">
                    
                <div class="form-group">
                    <label for="icon">icon</label>
                        <input class="icon" type="text" name="icon" id="icon" placeholder="" required>
                    </div>

                    <label for="dates_form">Dates</label>
                        <input class="form-control" type="text" name="dates_form" id="dates_form" placeholder="" required>
                    </div>
                        
                    <div class="form-group">
                        <label for="titre_form">Titre</label>
                        <input class="form-control" type="text" name="titre_form" id="titre_form" placeholder="" required>
                    </div>
                        
                    <div class="form-group">
                        <label for="stitre_form">Sous-titres</label>
                        <input class="form-control" type="text" name="stitre_form" id="stitre_form" placeholder="">
                    </div>
                        
                    <div class="form-group">
                        <label for="description_form">Description</label>
                        <input class="form-control" type="text" name="description_form" id="description_form" placeholder="">
                    </div>

                </div>   
                <button type="submit" class="btn btn-primary">Ajouter</button>  
            </form> 
        </div> <!-- fin col 2 -->
    </div> <!-- fin row -->
</div> <!-- fin container -->
    
<?php require_once 'inc/bas.inc.php';


