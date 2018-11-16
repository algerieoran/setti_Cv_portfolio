<?php
require_once 'inc/init.inc.php';

extract($_SESSION['t_utilisateurs']);

//-----------------mise à jour d'une experience ---------------
if (!empty($_POST)) {

    // ICI le code de la icon à venir
    $icon_bdd ='';  // par défaut la icon est vide en BDD

    // debug($_FILES);

    if (!empty($_FILES['icon']['name'])) {  // s'il y a un nom de fichier dans la superglobale $_FILES, c'est que je suis en tyrain d'uploader un fichier. L'indice "icon" correspond au name du champ dans le formulaire.
        $nom_icon =  $_FILES['icon']['name'];   

        $icon_bdd = $nom_icon;  // chemin relatif de la icon enregistré dans la BDD correspondant au fichier physique uploadé dans le dossier/img/ du site

        copy($_FILES['icon']['tmp_name'], 'img/' . $icon_bdd);  // on enregistre le fichier icon qui est tomporairement dans $_FILES['icon']['tmp_name'] dans le répertoire "img/nom_icon.jpg"

    }

    $result = executeRequete(" UPDATE t_competences SET icon = :icon, competence = :competence, niveau = :niveau, categorie = :categorie, id_utilisateur = $id_utilisateur WHERE id_competence = :id_competence",
                                array(
                                        ':id_competence' => $_POST['id_competence'],  
                                        ':icon'    => $icon_bdd,  
                                        ':competence' => $_POST['competence'],    
                                        ':niveau' => $_POST['niveau'],
                                        ':categorie' => $_POST['categorie']
                                    ));


    if ($result -> rowCount() == 1) { // si j'ai une ligne dans $result, j'ai modifié une competence
    $contenu .= '<div class="alert alert-success" role="alert">la competence a bien été modifiée</div>';
    } else {
        $contenu .= '<div class="alert alert-danger" role="alert">Erreur lors de la modification</div>';
    }
}

//-----------------------
$id_competence = $_GET['id_competence'];

$resultat = $pdo->query(" SELECT * FROM t_competences WHERE id_competence = '$id_competence' ");

while($ligne_competences = $resultat->fetch(PDO::FETCH_ASSOC)) {
    
        // debug($ligne);
    
    $contenu .= '<form method="post" action="" enctype="multipart/form-data">';
        
        foreach($ligne_competences as $indice => $valeur){ 
            $contenu .= '<div class="form-group">';

                if ($indice == 'id_competence' || $indice =='id_utilisateur'){    
                    $contenu .= '<input type="hidden" class="form-control" name="'. $indice .'" id="'. $indice .'" value="' . $valeur . '">'; 
                }
                elseif($indice == 'icon') {
                    $contenu .= '<div class="files color"><input type="file" class="form-control" name="' . $indice . '" id="'. $indice . '" value="'. $valeur . '"> <img src="img/' . $valeur . '" width="90" alt=""></div>';
                } 
                elseif($indice == 'categorie')  {
                    $contenu .= '<label for="'.$indice.'">Categories :</label>';
                    $contenu .= '<select type="text" class="form-control" name="'.$indice.'"  value ="'.$indice.'">';
                        $contenu .= '<option value="">Choisisez...</option>';
                        $contenu .= '<option value="Back">Back</option>';
                        $contenu .= '<option value="CMS">CMS</option>';
                        $contenu .= '<option value="Frameworks">Frameworks</option>';
                        $contenu .= '<option value="Front">Front</option>';
                    $contenu .= '</select>';
                }
                else{
                    $contenu .='<label for="'.$indice.'">&nbsp;&nbsp;'.$indice.'</label>';
                    $contenu .= '<input class="form-control"  id="'. $indice .'" value="' . $valeur . '" name="'. $indice .'">';
                }
                    $contenu .='</div>';
            
        } //fin foreach($ligne_competences as $indice => $valeur)
        
        $contenu .='<div><input type ="submit" id="'.$ligne_competences['id_competence'] .'" value="Modifier" class="form-control btn-success"></div>';
       
    $contenu .='</form>';
    $contenu .= '<div class="mt-2"><strong ><a href="competences.php" class="form-control btn-success"><i class="fas fa-code"></i>&nbsp;Competences</a></div class="danger"></strong></div>';    
        
}// fin while($ligne_competences = $resultat->fetch(PDO::FETCH_ASSOC))
//--------------------------AFFICHAGE------------
    require_once 'inc/haut.inc.php';
    ?>
    
    <div class="container-fluid text-center mt-4" style="min-width: 180vh">
        <div class="jumbotron mt-4" style="background-color:#f1f1f1;opacity:0.5; color:grey;">
                <h1 class=" mt-4 mb-4">Gestion de votre  CV</h1>
                <?php echo '<h4 class="mt-4 mb-4">' . $prenom . ' - ' . $nom .  '</h4>';  ?>
                <strong class="text-center"> Vous êtes un administrateur !</strong>
        </div>
    
        <div class="container text-center mb-5">
            <div class="row d-flex justify-content-center">
                <h2 class=" m-5">La mise à jour d'une competen</h2>
                <div class="col-lg-6 m-auto">
                    <?php echo  $contenu ;?>
                </div>
            </div>
        </div>
    
    
    </div>
    
    <?php
    //le bas de page
    require_once 'inc/bas.inc.php';
