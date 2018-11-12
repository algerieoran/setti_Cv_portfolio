<?php
require_once 'inc/init.inc.php';

// 1- On vérifie si membre est admin :

if (!internauteEstConnecteEtAdmin()) {
    header('location:../connexion.php'); // si pas admin, on le redirige vers la page de connexion
    exit();
}

extract($_SESSION['t_utilisateurs']);

//-----------------mise à jour d'une experience ---------------
if (!empty($_POST)) {

    $result = executeRequete(
        " UPDATE t_experiences SET titre_exp = :titre_exp, stitre_exp = :stitre_exp, dates_exp = :dates_exp, description_exp = :description_exp, id_utilisateur = :id_utilisateur WHERE id_experience = :id_experience",
        array(
            ':titre_exp' => $_POST['titre_exp'],
            ':stitre_exp' => $_POST['stitre_exp'],
            ':dates_exp' => $_POST['dates_exp'],
            ':description_exp' => $_POST['description_exp'],
            ':id_utilisateur' => $_POST['id_utilisateur']
        )
    );

    if ($result->rowCount() == 1) { // si j'ai une ligne dans $result, j'ai modifié une experience
        $contenu .= '<div class="alert alert-success" role="alert">l\'experience à bien été modifier</div>';
    } else {
        $contenu .= '<div class="alert alert-danger" role="alert">Erreur lors de la modification</div>';
    }
}

//-----------------------
$id_experience = $_GET['id_experience'];

$resultat = $pdo->query(" SELECT * FROM t_experiences WHERE id_experience = '$id_experience' ");

while ($ligne_exp = $resultat->fetch(PDO::FETCH_ASSOC)) {
    $contenu .= '<form method="post" action="">';
        // debug($ligne);

    foreach ($ligne_exp as $indice => $valeur) {
        $contenu .= '<div class="form-group">';

        if ($indice == 'id_experience' || $indice == 'id_utilisateur') {
            $contenu .= '<input type="hidden" name="' . $indice . '" id="' . $indice . '" value="' . $valeur . '">';

        } else {
            $contenu .= '<label for="' . $indice . '">&nbsp;' . $indice . '</label>';
            $contenu .= '<input class="form-control"  id="' . $indice . '" value="' . $valeur . '" name="' . $indice . '">';
        }

        $contenu .= '</div>';

    }
    $contenu .= '<input type ="submit" id="' . $ligne_exp['id_experience'] . '" value="Modifier" class="form-control btn-success">';
    $contenu .= '<form>';
}
//--------------------------AFFICHAGE------------
require_once 'inc/haut.inc.php';
?>
    
    <div class="container mt-4" style="min-width: 180vh">
        <div class="jumbotron mt-4">
                <h1 class="text-center mt-4 mb-4">Gestion de votre  CV</h1>
                <?php echo '<h4 class="text-center mt-4 mb-4">' . $prenom . ' - ' . $nom . '</h4>'; ?>
                <h2 class="text-center"> Vous êtes un administrateur !</h2>
        </div>
    
        <div class="row d-flex justify-content-center">
            <h2 class="text-center m-5">La mise à jour d'une experience</h2>
            <div class="col-lg-6 m-3">
            
                <?php echo $contenu; ?>
            </div>
        </div>
    
    
    </div>
    
    <?php
    //le bas de page
    require_once 'inc/bas.inc.php';
