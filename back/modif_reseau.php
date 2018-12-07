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
        " UPDATE t_reseaux SET url = :url, id_utilisateur = :id_utilisateur WHERE id_reseau = :id_reseau",
        array(
            ':id_reseau' => $_POST['id_reseau'],
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

$contenu .= '<form method="post" action="">';
while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
        // debug($ligne);

    foreach ($ligne as $indice => $valeur) {
        
        if ($indice == 'id_reseau' || $indice == 'id_utilisateur') {
            $contenu .= '<input type="hidden" name="' . $indice . '" id="' . $indice . '" value="' . $valeur . '">';
            
        }else{
            $contenu .= '<div class="form-group">';
                $contenu .= '<label for="' . $indice . '">&nbsp;&nbsp;' . $indice . '</label>';
                $contenu .= '<input class="form-control" value="' . $valeur . '" name="' . $indice . '">';
            $contenu .= '</div>';
        }


    }
   
        $contenu .= '<div class="container">
            <div class="row">
                <div class="col-6">
                    <input type="submit" id="' . $ligne['id_reseau'] . '" value="Modifier" class="btn btn-block btn-outline-info">
                </div>
                <div class="col-6">
                    <a href="reseaux.php" class="btn btn-block btn-outline-success"><i class="fas fa-ban"></i>&nbsp;Revenir aux reseaux</a>
                </div>
            </div>   
        </div>';
    }
    $contenu .= '<form>';

//--------------------------AFFICHAGE------------
require_once 'inc/haut.inc.php';
?>
    
    <div class="container text-center mt-4 mb-5 pt-5" style="min-width: 180vh">
        <h2 class="text-dark margin pb-3">La mise à jour d'un réseau</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 m-auto bg-info pb-4">
                <?php echo  $contenu ;?>
            </div>
        </div>
    </div>
    





    <?php
    //le bas de page
    require_once 'inc/bas.inc.php';
