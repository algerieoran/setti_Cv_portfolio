<?php
require_once 'inc/init.inc.php';

// 1- On vérifie si membre est admin :

    if(!internauteEstConnecteEtAdmin()){
        header('location:../connexion.php'); // si pas admin, on le redirige vers la page de connexion
        exit();
    }

extract($_SESSION['t_utilisateurs']);

//-------------------mise à jour dune experience--------------------------
if (!empty($_POST)) {

    $resultat = executeRequete("UPDATE t_formations 
                                SET id_formation = :id_formation, dates_form = :dates_form, titre_form = :titre_form, stitre_form = :stitre_form, description_form = :description_form, id_utilisateur = :id_utilisateur
                                WHERE id_formation = :id_formation",
                                array(':id_formation' => $_POST['id_formation'],
                                        // ':icon' => $_POST['icon'],                       
                                        ':dates_form' => $_POST['dates_form'],                       
                                        ':titre_form' => $_POST['titre_form'],
                                        ':stitre_form' => $_POST['stitre_form'],
                                        ':description_form' => $_POST['description_form'],
                                        ':id_utilisateur' => $_POST['id_utilisateur']
                                        ));

    if ($resultat -> rowCount() == 1) { // si j'ai une ligne dans $resultat, j'ai modifié une formation
    $contenu .= '<div class="alert alert-success" role="alert">la formation à bien été bien modifier</div>';
    } else {
        $contenu .= '<div class="alert alert-danger" role="alert">Erreur lors de la modification</div>';
    }
}
$id_formation = $_GET['id_formation'];

$resultat = $pdo->query("SELECT  id_formation, icon, dates_form, titre_form, stitre_form, description_form, id_utilisateur
                          FROM t_formations 
                          WHERE id_formation = $id_formation");


while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
    $contenu .= '<form method="post">';
        // debug($ligne);
        
        foreach($ligne as $indice => $valeur){ 
            $contenu .= '<div class="form-group">';
                if ($indice != 'icon'){

                    if ($indice == 'id_formation' || $indice =='id_utilisateur'){
                            
                        $contenu .= '<input type="hidden" name="'. $indice .'" id="'. $indice .'" value="' . $valeur . '">';
                    }else{
                        $contenu .='<label for="'.$indice.'">&nbsp;&nbsp;&nbsp;'.$indice.'</label>';
                            $contenu .= '<input class="form-control"  id="'. $indice .'" value="' . $valeur . '" name="'. $indice .'">';
                    }
                }
            $contenu .='</div>';
            
        }
        $contenu .='<input type ="submit" id="'.$ligne['id_formation'] .'" value="Modifier" class="form-control btn-success">';
        $contenu .='<form>';
    }
//--------------------------AFFICHAGE------------------------------------
    require_once 'inc/haut.inc.php';
    ?>
    
    
    
    <div class="container mt-5" style="min-width: 180vh">
        <div class="jumbotron mt-5">
                <h1 class="text-center mt-4 mb-4">Gestion de votre  CV</h1>
                <?php    echo '<h4 class="text-center mt-4 mb-4">' . $prenom . ' - ' . $nom .  '</h4>';  ?>
                <h2 class="text-center lead"> Vous êtes un administrateur !</h2>
        </div>
    
     
    
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 m-3">
                <h2 class="text-center m-5">La mise à jour d'une formation</h2>
                    <?php echo  $contenu ;?>
                </div>
            </div>
    
    
    </div>
    
    
    <?php
    //le bas de page
    require_once 'inc/bas.inc.php';
