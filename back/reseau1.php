<?php
require_once 'inc/init.inc.php';

//pour le tri des colonnes par ordre croissant et decroissant
$ordre = ''; // on declare la variable  

if (isset($_GET['ordre']) && isset($_GET['colonne'])) {

    if ($_GET['colonne'] == 'urls') {
        $ordre = ' ORDER BY url';
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

    // Insertion de la competence en BDD :
    executeRequete(
        " REPLACE INTO t_reseaux VALUES (:id_reseau, :url, :id_utilisateur)",
        array(
            ':id_reseau' => $_POST['id_reseau'],
            ':url' => $_POST['url'],
            ':id_utilisateur' => $_POST['id_utilisateur']
        )
    );
    //REPLACE INTO se comporte comme un INSERT INTO quand l'id_experience n'existe pas en BDD : c'est le cas lors de la création d'une experience pour laquelle nous avons mis un id_experience à 0 par défaut dans le formulaire. REPLACE INTO se comporte comme un UPDATE quand l'id_experience existe en BDD : c'est le cas lors de la modification d'une experience existante.

    $contenu .= '<div class="bg-success">Le reseau a bien été enregistrée ! </div>';

}// fin du if (!empty($_POST))



//suppression d'un élément de la BDD
if (isset($_GET['id_reseau'])) {// on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_reseau'];// je passe l'id dans une variable $efface

    $resultat = $pdo->query(" DELETE FROM t_reseaux WHERE id_reseau = '$efface' ");

    header("location: ../back/reseaux.php");

    $contenu .= '<div class="alert alert-success" role="alert">Le reseau à bien été supprimé</div>';
} else {
    $contenu .= '<div class="alert alert-danger" role="alert">Erreur lors de la suppression</div>';

}//ferme le if isset pour la suppression



//-----------------------------------------AFFICHAGE--------------------------------------------
require_once 'inc/haut.inc.php';

//echo $contenu;
?>

<div class="container margin">
    <div class="row">  
        <div class="col-sm-12 col-md-8 col-lg-8 bg-secondary">
            <?php 
                //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
            $sql = $pdo->prepare(" SELECT * FROM t_reseaux " . $ordre);
            $sql->execute();
            $nbr_reseaux = $sql->rowCount();
            ?>

            <div class="table-responsive">
                <div class="card-header">
                    La liste des reseaux : <?php echo $nbr_reseaux; ?>
                </div>
                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>Reseau  <a href="reseaux.php?colonne=urls&ordre=asc"><i class="fas fa-sort-alpha-down"></i></a> | <a href="reseaux.php?colonne=urls&ordre=desc"><i class="fas fa-sort-alpha-up"></i></a></th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody class="thead-light">
                    <?php while ($ligne_reseaux = $sql->fetch()) {

                        echo '<tr>';
                        echo '<td>' . $ligne_reseaux['url'] . '</td>';
                        echo '<td> <a href="modif_reseau.php?id_reseau=' . $ligne_reseaux['id_reseau'] . '" onclick="return(confirm(\'Etes-vous certain de vouloir modifier ce reseau ?\'))"><i class="fas fa-edit"></i></a></td>';

                        echo '<td> <a href="?id_experience=' . $ligne_reseaux['id_reseau'] . '" onclick="return(confirm(\'Etes-vous certain de vouloir supprimer ce reseau ?\'))" ><i class="far fa-trash-alt"></i></a></td>';
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
                    Insertion d'un nouveau reseau :
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="url">reseau</label>
                            <input type="text" name="url" class="form-control" placeholder="nouveau reseau" required>
                        </div>
                        
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Insérer un reseau</button>
                        </div>
                    </form>
                </div><!-- fin div .card-body -->
            </div><!-- fin div .card -->
        </div><!-- fin div .col-sm-12 col-md-4 col-lg-4 -->
        
    </div><!-- fin .row -->
            
</div><!-- fin .container-->

<?php
require_once 'inc/bas.inc.php';