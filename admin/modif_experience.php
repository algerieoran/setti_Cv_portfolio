<?php
require_once '../inc/init.inc.php';

// 1- On vérifie si l'utilisateur est admin :

    if(!internauteEstConnecteEtAdmin()){
        header('location:../connexion.php'); // si pas admin, on le redirige vers la page de connexion
        exit();
    }
    // debug ($_POST);
    if (!empty($_POST)) {
        //     debug ($_POST);
        //     $photo_bdd ='';
        //     if (!empty($_FILES['photo']['name'])){// 'il y a un nom de fichier dans la superglobale $_FILES, c'est que je suis en train d'uploader un fichier
        //         $nom_photo = $_POST['reference'] . '_' . $_FILES['photo']['name']; // Pour créer un nom de fichier unique, on concatène la référence du produit avec le nom du fichier en cours d'upload

        //         $photo_bdd = 'photo/'. $nom_photo; // chemin relatif de la photo enregistré dans la BDD correspondant au fichier physique uploadé dans le dossier /photo/ du site 
        //         copy($_FILES['photo']['tmp_name'], '../' .$photo_bdd); // on enregistre le fichier photo qui est temporairement dans $_FILES['photo]['tmp_name] dans le répértoire "../photo/nom_photo.jpg"

        //     }
        $resultat = executeRequete("UPDATE t_loisirs SET loisir = :loisir, id_utilisateur= :id_utilisateur WHERE id_loisir = :id_loisir",
         array(
            ':id_loisir' => $_POST['id_loisir'],
            ':loisir' => $_POST['loisir'],
            ':id_utilisateur' => $_POST['id_utilisateur']
            ));
        
        if ($resultat -> rowCount() == 1) { // si j'ai une ligne dans $resultat, j'ai supprimé un loisir
        $contenu .= '<div class="bg-primary">Le loisir à bien été Modifier</div>';
        } else {
            $contenu .= '<div class="bg-danger">Erreur lors de la Modification</div>';
        }
    }
// 2 - Affichage des loisirs dans le back-office :
//Tous les loisirs sont affichés sous forme de table HTML que je stocke dans la variable $contenu. Tous les champs sont affichés. 
$resultat = $pdo->query("SELECT * FROM t_loisirs");

$contenu .= '<table class="table table-hover" border="1">';
    $contenu .= '<thead class="thead-dark">';
        $contenu .= '<tr>';
            $contenu .= '<th>id loisir</th>';
            $contenu .= '<th>loisir</th>';
            $contenu .= '<th>id utilisateur</th>';
            $contenu .= '<th>action</th>';
        $contenu .= '</tr>';
    $contenu .= '</thead>';
     // Affichage des autres lignes :
    
     while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
        // debug($ligne);
        $contenu .= '<form method="post" enctype="multipart/form-data">' ;
            $contenu .= '<tr>';
        // affichage des informations de chaque ligne $ligne :
            foreach($ligne as $indice => $valeur){
                if($indice == 'photo') {
                    
                    $contenu .= '<td><input type="file" name="' . $valeur . '" id="'. $indice . '"> <img src="../photo/' . $valeur . '" width="90" alt"' . $ligne['loisir'] . '"></td>';
                } else {
               
                     $contenu .= '<td><input   type ="text" id ="' . $indice . '" name="' .$indice. '" value="' . $valeur . '"></td>';
              
                    }

            }
            $contenu .= '<td><input type="submit" id="'.$ligne['id_loisir'] .'" value="modification"  onclick="return(confirm(\'Etes-vous certain de vouloir modifier ce loisir ? \' ))" ></td>';  // $ligne['id_loisir'] contien l'id de chaque loisir à chaque tour de boucle while : ainsi le lien est dynamique, l'id passé en GET change selon le loisir sur lequel je clique
            $contenu .= '</tr>';
        $contenu .= '</form>';
    }
  
$contenu.= '</table>';

//------------------------AFFICHAGE---------------------------

require_once '../inc/haut.inc.php';
?>

    <h1 class="mt-4">Gestion des loisirs :</h1>

    <ul class="nav nav-tabs">
    
        <li><a class= "nav-link active" href="gestion_cv.php">Affichage de loisirs</a></li>
        <li><a class="nav-link" href="ajout_loisir.php">Ajout d'un loisir</a></li>
        <li><a class="nav-link" href="modif_loisir.php">Modifier un loisir</a></li>
    </ul>
<?php
 echo $contenu;
 
require_once '../inc/bas.inc.php';