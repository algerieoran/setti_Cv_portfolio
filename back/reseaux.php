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
 // Supprimer une langue
//  if (isset($_GET['id_reseau'])) {
//     $resultat = executeRequete("DELETE FROM t_reseaux WHERE id_reseau = :id_reseau", array(':id_reseau' => $_GET['id_reseau']));

//suppression d'un élément de la BDD
if (isset($_GET['id_reseau'])) {// on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_reseau'];// je passe l'id dans une variable $efface

    $resultat = $pdo->query(" DELETE FROM t_reseaux WHERE id_reseau = '$efface' ");

     header("location:../back/reseaux.php");
    
    if ($resultat -> rowCount() == 1) { // si j'ai une ligne dans $resultat, j'ai supprimé un produit
    $contenu .= '<div class="alert alert-success" role="alert">Le reseau à bien été supprimé</div>';
    } else {
        $contenu .= '<div class="alert alert-danger" role="alert">Erreur lors de la suppression</div>';
    }
}


//--------------------------------------

// Update de reseau pour chaque utilisateur
if (!empty($_POST)){ // Si le formulaire est soumis

    // debug($_POST);
    // Validation des champs du formulaire
    if (!isset($_POST['url']) || strlen($_POST['url']) < 4 || strlen($_POST['url']) > 255  ) $contenu .= '<div class="alert alert-danger" role="alert">Le nom doit contenir entre 50 et 255 caractères.</div>';
 
    // echo ($_POST['url'] );
    if ($_POST['icon'] == 'Facebook'){
        $url .=  '<a href="' . $_POST['url'] . '" target="_blank"><i class="fab fa-facebook fa-2x fa-fw"></i></a>';
    }

    if ($_POST['icon']  == 'Instagram'){
        $url .=  '<a href="' . $_POST['url'] . '" target="_blank"><i class="fab fa-instagram fa-2x fa-fw"></i></a>';
    }

    if ($_POST['icon']  == 'Twitter'){
        $url .=  '<a href="' . $_POST['url'] . '" target="_blank"><i class="fab fa-twitter-square fa-2x fa-fw"></i></a>';
    }
    if ($_POST['icon'] == 'Linkedin'){
        $url .=  '<a href="' . $_POST['url'] . '" target="_blank"><i class="fab fa-linkedin fa-2x fa-fw"></i></a>';
    }
    if ($_POST['icon'] == 'Github'){
        $url .=  '<a href="' . $_POST['url'] . '" target="_blank"><i class="fab fa-github-square fa-2x fa-fw"></i></a>';
    }

    // echo($url);

    //-------------------------------
  
    // Insertion de nouvelles reseau en BDD :
    $pdo -> exec("INSERT INTO t_reseaux VALUES (NULL, '$url', '$id_utilisateur')");

    $contenu .= '<div class="alert alert-success" role="alert">Le reseau a bien été enregitré !</div>';

}/* fin if (!empty($_POST)) */
    

 // Affichage les reseaux pour chaque utilisateur
 $resultat = $pdo -> query("SELECT * FROM t_reseaux WHERE id_utilisateur = 1 $ordre ");
    $resultat->execute();
    $nbr_reseaux = $resultat->rowCount();

    $contenu .='<div class="table-responsive">';
        $contenu .='<div class="card-header">La liste des reseaux : '.$nbr_reseaux.'</div>';
    
        $contenu .='<table class="table table-striped table-sm">';
            $contenu .= '<thead class="thead-dark">';
                $contenu .='<tr>';
            
                $contenu .= '<th>URL du reseau</th>' ;
                
                    $contenu .='<th colspan="2">Actions</th>';
                $contenu .='</tr>';
            $contenu .= '</thead>';
            $contenu .= '<tbody class="thead-light">';
                while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){
                $contenu .= '<tr>';
                    foreach ($ligne as $indice => $valeur) {
                        // Affichage de chaque ligne à chaque tour de boucle sauf "mdp"
                        if($indice != 'id_reseau' && $indice != 'id_utilisateur'){
                        $contenu .= '<td>'. $valeur . '</td>'; 
                        }
                    }
                    $contenu .='<td><a href="?id_reseau='. $ligne['id_reseau'] .'"  onclick="return(confirm(\'Etes-vous certain de vouloir supprimer ce reseau ? \' ))" ><i class="far fa-trash-alt"></i></a></td>';

                    $contenu .='<td> <a href="modif_reseau.php?id_reseau=' . $ligne['id_reseau'] . '" onclick="return(confirm(\'Etes-vous certain de vouloir modifier ce reseau ?\'))"><i class="fas fa-edit"></i></a></td>';
                $contenu .='</tr>';
            }
            $contenu .= '</tbody>'; 
        $contenu .= '</table>'; 
    $contenu .='</div><!-- fin div .table-responsive -->';

//------------------------AFFICHAGE---------------------------

require_once 'inc/haut.inc.php';

?>
<div class="container mt-5 mb-5" style="min-width: 180vh">
    
        


        <div class="row">
            <div class="col-xm-6 col-md-8 col-lg-12">
                <h2 class="text-center margin text-dark">Mise à jour d'un reseau</h2>
            </div>
        </div>
        <div class="row d-flex justify-content-center mb-5">
            <div class="col-lg-6 m-auto pb-4 color">
                <?php  echo $contenu;?>
            </div>
        </div>
            
            <div class="col-lg-8 color m-auto">
                
                <form class="form-inline" method ="post" action=""> 
                    <input type="hidden" id="id_reseau" name="id_reseau" value="0"><!-- Ce champ caché est utile pour la modification d'un produit afin de l'identifier dans la requête SQL. La valeur 0 par défaut signifie que le produit n'existe pas en BDD, et qu'on est en train de le créer -->
                    
                    <div class="form-group pl-5">
                        <label for="url">Url de réseau</label>
                        <input type="text" class="form-control" name="url" id="url" placeholder="Url reseau">
                    </div>
                    <div class="form-group pl-5">
                        <label for="icon">Choix de l'icon</label>                                
                        <select name="icon" id="" class="form-control">
                            <option value="Facebook">Facebook</option>
                            <option value="Twitter">Twitter</option>
                            <option value="Instagram">Instagram</option>
                            <option value="Linkedin">Linkedin</option>
                            <option value="Github">Github</option>
                        </select>
                    </div>
                    
                    <div class="form-group pl-5">
                    <button class="btn" type="submit"><i class="fas fa-plus"></i> reseau</button>
                    </div>
                </form>
            </div> 

            
</div>




<?php

require_once 'inc/bas.inc.php';