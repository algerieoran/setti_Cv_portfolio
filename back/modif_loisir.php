<?php
require_once 'inc/init.inc.php';

extract($_SESSION['t_utilisateurs']);
debug($_POST);
//-----------------mise à jour d'une experience ---------------
if (!empty($_POST)) {
    $photo_bdd ='';  // par défaut la photo est vide en BDD

    // debug($_FILES);

     if (!empty($_FILES['photo']['name'])) {  // s'il y a un nom de fichier dans la superglobale $_FILES, c"est que je suis en tyrain d'uploader un fichier. L'indice "photo" correspond au name du champ dans le formulaire.
        $nom_photo = $_FILES['photo']['name'];  

       $photo_bdd = $nom_photo;  // chemin relatif de la photo enregistré dans la BDD correspondant au fichier physique uploadé dans le dossier/photo/ du site

       copy($_FILES['photo']['tmp_name'], 'img/' . $photo_bdd);  // on enregistre le fichier photo qui est tomporairement dans $_FILES['photo']['tmp_name'] dans le répertoire "img/nom_photo.jpg"
     }
    $result = executeRequete(
        " UPDATE t_loisirs SET loisir = :loisir, photo = :photo, id_utilisateur = $id_utilisateur WHERE id_loisir = :id_loisir",
        array(
            ':id_loisir' => $_POST['id_loisir'],
            ':loisir' => $_POST['loisir'],
            ':photo' => $photo_bdd
        )
    );

    if ($result->rowCount() == 1) { // si j'ai une ligne_loisirs dans $result, j'ai modifié un loisir
        $contenu .= '<div class="alert alert-success" role="alert">le loisir à bien été modifier</div>';
    } else {
        $contenu .= '<div class="alert alert-danger" role="alert">Erreur lors de la modification</div>';
    }
}

//-----------------------
$id_loisir = $_GET['id_loisir'];

$result = $pdo->query(" SELECT * FROM t_loisirs WHERE id_loisir = '$id_loisir' ");

while ($ligne_loisirs = $result->fetch(PDO::FETCH_ASSOC)) {
    // debug($ligne_loisirs);
    $contenu .= '<form method="post" action="" enctype="multipart/form-data">';

        foreach ($ligne_loisirs as $indice => $valeur) {
            $contenu .= '<div class="form-group">';

            if ($indice == 'id_loisir' || $indice == 'id_utilisateur') {
                $contenu .= '<input type="hidden" name="' . $indice . '" id="' . $indice . '" value="' . $valeur . '">';
            }
            elseif($indice == 'photo') {
                $contenu .= '<div class="files color"><input type="file" class="form-control" name="' . $indice . '" id="'. $indice . '" value="'. $valeur . '"> <img src="img/' . $valeur . '" width="90" alt=""></div>';
            } 
            else {
                $contenu .= '<label for="' . $indice . '">&nbsp;&nbsp;' . $indice . '</label>';
                $contenu .= '<input class="form-control"  id="' . $indice . '" value="' . $valeur . '" name="' . $indice . '">';
            }

            $contenu .= '</div>';

        }//fin foreach($ligne_loisirs as $indice => $valeur)

        $contenu .= '<div><input type ="submit" id="' . $ligne_loisirs['id_loisir'] . '" value="Modifier" class="form-control btn-success"></div>';
    $contenu .= '<form>';
    $contenu .= '<div class="mt-2"><strong ><a href="loisirs.php" class="form-control btn-success"><i class="fas fa-table-tennis"></i>&nbsp;Loisirs</a></div class="danger"></strong></div>';   

}// fin while($ligne_loisirs = $resultat->fetch(PDO::FETCH_ASSOC))

//--------------------------AFFICHAGE------------
require_once 'inc/haut.inc.php';
?>
    
    <div class="container-fluid text-center mt-4" style="min-width: 180vh">
        <div class="jumbotron mt-4">
                <h1 class="text-center mt-4 mb-4">Gestion de votre  CV</h1>
                <?php echo '<h4 class="text-center mt-4 mb-4">' . $prenom . ' - ' . $nom . '</h4>'; ?>
                <h2 class="text-center"> Vous êtes un administrateur !</h2>
        </div>

        <div class="container text-center mb-5">
            <div class="row d-flex justify-content-center">
                <h2 class="text-center m-5">La mise à jour d'un loisir</h2>
                <div class="col-lg-8 m-3">
                
                    <?php echo $contenu; ?>
                </div><!-- fin div .col-lg-8 m-3 -->
            </div><!-- fin div .row d-flex justify-content-center -->
        </div><!-- fin div .container text-center mb-5 -->
    
    </div>
    
    <?php
    //le bas de page
    require_once 'inc/bas.inc.php';
