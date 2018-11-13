<?php
require_once 'inc/init.inc.php';

//pour le tri des colonnes par ordre croissant et decroissant
$ordre = ''; // on declare la variable 

if (isset($_GET['ordre']) && isset($_GET['colonne'])) {

    if ($_GET['colonne'] == 'competences') {
        $ordre = ' ORDER BY competence';

    } elseif ($_GET['colonne'] == 'niveau') {
        $ordre = ' ORDER BY niveau';

    } elseif ($_GET['colonne'] == 'categorie') {
        $ordre = ' ORDER BY categorie';
    }

    if ($_GET['ordre'] == 'asc') {
        $ordre .= ' ASC';
    } elseif ($_GET['ordre'] == 'desc') {
        $ordre .= ' DESC';
    }
}
extract($_SESSION['t_utilisateurs']);

/**************************************************************** */


// 4- Traitement de $_POST : enregistrement de la competence en BDD 
//debug($_POST);

if(!empty($_POST)) {
    // ICI il faudrait mettre les contrôles sur les champs du formulaire.

    // ICI le code de la photo à venir
    $photo_bdd ='';  // par défaut la photo est vide en BDD

    debug($_FILES);

    if (!empty($_FILES['photo']['name'])) {  // s'il y a un nom de fichier dans la superglobale $_FILES, c"est que je suis en tyrain d'uploader un fichier. L'indice "photo" correspond au name du champ dans le formulaire.
        $nom_photo = $_POST['reference'] . '_' . $_FILES['photo']['name'];   // pour créer un nom de fichier unique, on concatène la référence du produit avec le nom du fichier en cour d'upload.

        $photo_bdd = 'photo/' . $nom_photo;  // chemin relatif de la photo enregistré dans la BDD correspondant au fichier physique uploadé dans le dossier/photo/ du site

        copy($_FILES['photo']['tmp_name'], '../' . $photo_bdd);  // on enregistre le fichier photo qui est tomporairement dans $_FILES['photo']['tmp_name'] dans le répertoire "../photo/nom_photo.jpg"

    }

    // Insertion de la competence en BDD :
    executeRequete(" REPLACE INTO t_competences VALUES (NULL, :photo, :competence, :niveau, :categorie, $id_utilisateur)", 
      array(
            ':photo'    => $_POST['photo'],
            ':competence'    => $_POST['competence'],
            ':niveau'    => $_POST['niveau'],
            ':categorie'        => $_POST['categorie']
        )
    );
    //REPLACE INTO se comporte comme un INSERT INTO quand l'id_competence n'existe pas en BDD : c'est le cas lors de la création d'une competence pour laquelle nous avons mis un id_competence à 0 par défaut dans le formulaire. REPLACE INTO se comporte comme un UPDATE quand l'id_competence existe en BDD : c'est le cas lors de la modification d'une competence existante.

    $contenu .= '<div class="bg-success">La compétence a bien été enregistrée ! </div>';

}// fin du if (!empty($_POST))

//suppression d'un élément de la BDD
if (isset($_GET['id_competence'])) {// on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_competence'];// je passe l'id dans une variable $efface

    $resultat = $pdo->query(" DELETE FROM t_competences WHERE id_competence = '$efface' ");

     header("location: ../back/competences.php");

    $contenu .= '<div class="alert alert-success" role="alert">La competence à bien été supprimé</div>';
} else {
    $contenu .= '<div class="alert alert-danger" role="alert">Erreur lors de la suppression</div>';

}//ferme le if isset pour la suppression



//-----------------------------------------AFFICHAGE--------------------------------------------
require_once 'inc/haut.inc.php';
?>

<?php
echo $contenu;

?>

<div class="container margin">
    <div class="row">  
        <div class="col-sm-12 col-md-8 col-lg-8 bg-secondary">
            <?php 
                //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
                $sql = $pdo->prepare(" SELECT * FROM t_competences WHERE id_utilisateur = $id_utilisateur $ordre ");
                $sql->execute();
                $nbr_competences = $sql->rowCount();
            ?>

            <div class="table-responsive">
                <div class="card-header">
                    La liste des compétences : <?php echo $nbr_competences; ?>
                </div>
                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>Compétences  <a href="competences.php?colonne=competences&ordre=asc"><i class="fas fa-sort-alpha-down"></i></a> | <a href="competences.php?colonne=competences&ordre=desc"><i class="fas fa-sort-alpha-up"></i></a></th>
                            <th>Niveau</th>
                            <th>Catégorie</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody class="thead-light">
                    <?php while ($ligne_competence = $sql->fetch()) {

                        echo '<tr>';
                            echo '<td>' . $ligne_competence['icon'] . '</td>';
                            echo '<td>' . $ligne_competence['competence'] . '</td>';
                            echo '<td>' . $ligne_competence['niveau'] . '</td>';
                            echo '<td>' . $ligne_competence['categorie'] . '</td>';
                            echo '<td> <a href="modif_competence.php?id_competence=' . $ligne_competence['id_competence'] . '" onclick="return(confirm(\'Etes-vous certain de vouloir modifier cette competence?\'))"><i class="fas fa-edit"></i></a></td>';

                            echo '<td> <a href="?id_competence=' . $ligne_competence['id_competence'] . '" onclick="return(confirm(\'Etes-vous certain de vouloir supprimer cette competence?\'))" ><i class="far fa-trash-alt"></i></a></td>';
                        echo '</tr>';
                        }
                    ?>
                    </tbody>
                </table>
            </div><!-- fin resposive -->
        </div><!-- fin .col-lg-8 -->

        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    Insertion d'une nouvelle compétences :
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="competence">Compétence</label>
                            <input type="text" name="competence" class="form-control" placeholder="nouvelle compétence" required>
                        </div>
                        <div class="form-group">
                            <label for="photo">photo</label>
                            <input type="file" name="photo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="niveau">Niveau</label>
                            <input type="text" name="niveau" class="form-control" placeholder="niveau en chiffre" required>
                        </div>
                        <div class="form-group">
                            <label for="categorie">Catégorie</label>
                            <select name="categorie" class="form-control">
                                <option value="Back">Back</option>
                                <option value="CMS">CMS</option>
                                <option value="Frameworks">Frameworks</option>
                                <option value="Front">Front</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Insérer une compétence</button>
                        </div>
                    </form>
                </div><!-- fin div .card-body -->
            </div><!-- fin div .card -->
        </div><!-- fin div .col-sm-12 col-md-4 col-lg-4 -->
        
    </div><!-- fin .row -->
            
</div><!-- fin .container-->

<?php
require_once 'inc/bas.inc.php';