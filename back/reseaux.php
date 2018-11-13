<?php



require_once 'inc/init.inc.php';

// 1- On vérifie si l'utilisateur est admin :

    if(!internauteEstConnecteEtAdmin()){
        header('location:connexion.php'); // si pas admin, on le redirige vers la page de connexion
        exit();
    }

    extract($_SESSION['t_utilisateurs']);


 // Supprimer une langue
 if (isset($_GET['id_reseau'])) {
    $resultat = executeRequete("DELETE FROM t_reseaux WHERE id_reseau = :id_reseau", array(':id_reseau' => $_GET['id_reseau']));
    
    if ($resultat -> rowCount() == 1) { // si j'ai une ligne dans $resultat, j'ai supprimé un produit
    $contenu .= '<div class="alert alert-success" role="alert">Le reseau à bien été supprimé</div>';
    } else {
        $contenu .= '<div class="alert alert-danger" role="alert">Erreur lors de la suppression</div>';
    }
}




    // Update de reseau pour chaque utilisateur
if (!empty($_POST)){ // Si le formulaire est soumis
    // debug($_POST);

    // Validation des champs du formulaire
 
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
    // echo($url);

    if (!isset($_POST['url']) || strlen($_POST['url']) < 4 || strlen($_POST['url']) > 255  ) $contenu .= '<div class="alert alert-danger" role="alert">Le nom doit contenir entre 50 et 255 caractères.</div>';

 

    //-------------------------------
  
    // Insertion de nouvelles reseau en BDD :
    $pdo -> exec("INSERT INTO t_reseaux VALUES (NULL, '$url', '$id_utilisateur')");

    
     

$contenu .= '<div class="alert alert-success" role="alert">Le reseau a bien été enregitré !</div>';

}/* fin if (!empty($_POST)) */
    

 // Affichage les reseaux pour chaque utilisateur

 $resultat = $pdo -> query("SELECT id_reseau, url, ut.prenom, ut.nom
                            FROM t_reseaux r, t_utilisateurs ut 
                            WHERE r.id_utilisateur = $id_utilisateur  AND ut.id_utilisateur = $id_utilisateur");

$contenu .='<table class="table" border = "1">';
    $contenu .= '<thead class="thead-dark">';
        $contenu .='<tr>';
       
        $contenu .= '<th>URL du reseau</th>' ;
            $contenu .= '<th>Prénom</th>' ;
            $contenu .= '<th>Nom</th>' ;
           
            $contenu .='<th colspan="2">Actions</th>';
        $contenu .='</tr>';
$contenu .= '</thead>';
while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){
$contenu .= '<tr>';
    foreach ($ligne as $indice => $valeur) {
    // Affichage de chaque ligne à chaque tour de boucle sauf "mdp"
        if($indice != 'id_reseau'){
            $contenu .= '<td>'. $valeur . '</td>'; 
        }
    }
$contenu .='<td><a href="?id_reseau='. $ligne['id_reseau'] .'"  onclick="return(confirm(\'Etes-vous certain de vouloir supprimer ce reseau ? \' ))" ><i class="far fa-trash-alt"></i></a></td>';
        $contenu .='</tr>';
}
$contenu .= '</table>'; 

    //------------------------AFFICHAGE---------------------------

require_once 'inc/haut.inc.php';



?>
<div class="container mt-5" style="min-width: 180vh">
    <div class="jumbotron mt-5">
            <h1 class="text-center mt-4 mb-4">Gestion de votre CV</h1>
            <?php    echo '<h4 class="text-center mt-4 mb-4">' . $prenom . ' - ' . $nom .  '</h4>';  ?>
            <h2 class="text-center lead"> Vous êtes un  admin.</h2>
            
        </div>

        


        <div class="row mb-3">
            <div class="col-lg-12 text-center">
                <h2>Mise à jour d'un reseau</h2>
            </div>
        </div>

        

        <div class="row mb-4 bg-secondary">
            <div class="col-lg-6 text-center">
                <?php  echo $contenu;?>
            </div>
            
            <div class="col-lg-4">
                
                <form method ="post" action=""> 
                    <input type="hidden" id="id_reseau" name="id_reseau" value="0"><!-- Ce champ caché est utile pour la modification d'un produit afin de l'identifier dans la requête SQL. La valeur 0 par défaut signifie que le produit n'existe pas en BDD, et qu'on est en train de le créer -->
                    
                    <div class="form-group">
                        <label for="url">Url de réseau</label>
                        <input type="text" class="form-control" name="url" id="url" placeholder="Url reseau">
                    </div>
                    <div class="form-group">
                        <label for="icon">Choix de l'icon</label>                                
                        <select name="icon" id="" class="form-control">
                            <option value="Facebook">Facebook</option>
                            <option value="Twitter">Twitter</option>
                            <option value="Instagram">Instagram</option>
                            <option value="Linkedin">Linkedin</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" class="form-control btn-success"  value="valider">
                    </div>
                </form>
            </div> 
        </div>
</div>




<?php

require_once 'inc/bas.inc.php';