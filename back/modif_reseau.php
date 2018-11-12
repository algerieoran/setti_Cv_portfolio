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
        " UPDATE t_reseaux SET url = :url, id_utilisateur = :id_utilisateur WHERE id_loisir = :id_loisir",
        array(
            ':url' => $_POST['url'],
            ':id_utilisateur' => $_POST['id_utilisateur']
        )
    );

    if ($result->rowCount() == 1) { // si j'ai une ligne dans $result, j'ai modifié un reseau
        $contenu .= '<div class="alert alert-success" role="alert">le reseau à bien été modifier</div>';
    } else {
        $contenu .= '<div class="alert alert-danger" role="alert">Erreur lors de la modification</div>';
    }
}

//-----------------------
$id_reseau = $_GET['id_reseau'];

$result = $pdo->query(" SELECT * FROM t_reseaux WHERE id_reseau = '$id_reseau' ");

while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
    $contenu .= '<form method="post" action="">';
        // debug($ligne);

    foreach ($ligne as $indice => $valeur) {
        $contenu .= '<div class="form-group">';

        if ($indice == 'id_reseau' || $indice == 'id_utilisateur') {
            $contenu .= '<input type="hidden" name="' . $indice . '" id="' . $indice . '" value="' . $valeur . '">';

        } else {
            $contenu .= '<label for="' . $indice . '">&nbsp;&nbsp;' . $indice . '</label>';
            $contenu .= '<input class="form-control"  id="' . $indice . '" value="' . $valeur . '" name="' . $indice . '">';
        }

        $contenu .= '</div>';

    }
    $contenu .= '<input type ="submit" id="' . $ligne['id_reseau'] . '" value="Modifier" class="form-control btn-success">';
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
            <h2 class="text-center m-5">La mise à jour d'un loisir</h2>
            <div class="col-lg-8 m-3">
            
                <?php echo $contenu; ?>
            </div>
        </div>
    
    
    </div>
    
    <?php
    //le bas de page
    require_once 'inc/bas.inc.php';
