<?php
require_once 'inc/init.inc.php';

// 1- On vérifie si membre est admin :

    if(!internauteEstConnecteEtAdmin()){
        header('location:../connexion.php'); // si pas admin, on le redirige vers la page de connexion
        exit();
    }

extract($_SESSION['t_utilisateurs']);

//-----------------mise à jour d'une experience ---------------
if (!empty($_POST)) {

    $result = executeRequete(" UPDATE t_competences SET competence = :competence, niveau = :niveau, categorie = :categorie, id_utilisateur = $id_utilisateur
                                WHERE id_competence = :id_competence",
                                array(':id_competence' => $_POST['id_competence'],    
                                        ':competence' => $_POST['competence'],    
                                        ':niveau' => $_POST['niveau'],
                                        ':categorie' => $_POST['categorie']
                                        
                                        ));

    if ($result -> rowCount() == 1) { // si j'ai une ligne dans $result, j'ai modifié une competence
    $contenu .= '<div class="alert alert-success" role="alert">la competence à bien été modifier</div>';
    } else {
        $contenu .= '<div class="alert alert-danger" role="alert">Erreur lors de la modification</div>';
    }
}

//-----------------------
$id_competence = $_GET['id_competence'];

$resultat = $pdo->query(" SELECT * FROM t_competences WHERE id_competence = '$id_competence' ");

while($ligne_comp = $resultat->fetch(PDO::FETCH_ASSOC)) {
    $contenu .= '<form method="post" action="">';
        // debug($ligne);
        
        foreach($ligne_comp as $indice => $valeur){ 
            $contenu .= '<div class="form-group">';

                if ($indice == 'id_competence' || $indice =='id_utilisateur'){    
                    $contenu .= '<input type="hidden" name="'. $indice .'" id="'. $indice .'" value="' . $valeur . '">';
                
                }else{
                    $contenu .='<label for="'.$indice.'">&nbsp;&nbsp;'.$indice.'</label>';
                    $contenu .= '<input class="form-control"  id="'. $indice .'" value="' . $valeur . '" name="'. $indice .'">';
                }
                
            $contenu .='</div>';
            
        }
        $contenu .='<input type ="submit" id="'.$ligne_comp['id_competence'] .'" value="Modifier" class="form-control btn-success">';
        $contenu .='<form>';
    }
//--------------------------AFFICHAGE------------
    require_once 'inc/haut.inc.php';
    ?>
    
    <div class="container mt-4" style="min-width: 180vh">
        <div class="jumbotron mt-4" style="background-color:#f1f1f1;opacity:0.5; color:grey;">
                <h1 class="text-center mt-4 mb-4">Gestion de votre  CV</h1>
                <?php echo '<h4 class="text-center mt-4 mb-4">' . $prenom . ' - ' . $nom .  '</h4>';  ?>
                <h2 class="text-center"> Vous êtes un administrateur !</h2>
        </div>
    
        <div class="row d-flex justify-content-center">
            <h2 class="text-center m-5">La mise à jour d'une competen</h2>
            <div class="col-lg-6 m-3">
            
                <?php echo  $contenu ;?>
            </div>
        </div>
    
    
    </div>
    
    <?php
    //le bas de page
    require_once 'inc/bas.inc.php';
