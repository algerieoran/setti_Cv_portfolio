<?php
require_once 'inc/init.inc.php';

// if(!internauteEstConnecteEtAdmin()){
//     header('location:connexion.php'); // si pas admin, on le redirige vers la page de connexion
//     exit();
// }

extract($_SESSION['t_utilisateurs']);
// var_dump($_POST);

//pour le tri des colonnes par ordre croissant et decroissant
$ordre = ''; // on vide la variable 

if(isset($_GET['ordre']) && isset($_GET['colonne'])){
	
	if($_GET['colonne'] == 'loisirs'){
		$ordre = ' ORDER BY loisir';
	}
	
	if($_GET['ordre'] == 'asc'){
		$ordre.= ' ASC';
	}
	elseif($_GET['ordre'] == 'desc'){
		$ordre.= ' DESC';
	}
}

//suppression d'un élément de la BDD
// if (isset($_GET['id_loisir'])) {// on récupère ce que je supprime dans l'url par son id
    // $efface = $_GET['id_loisir'];// je passe l'id dans une variable $efface

//     $resultat = $pdo->query(" DELETE FROM t_loisirs WHERE id_loisir = '$efface' ");

//     header("location: ../back/loisirs.php");

//     $contenu .= '<div class="alert alert-success" role="alert">Le loisir à bien été supprimé</div>';
// } else {
//     $contenu .= '<div class="alert alert-danger" role="alert">Erreur lors de la suppression</div>';

//}ferme le if isset pour la suppression


if (isset($_GET['id_loisir'])) {
    $resultat = executeRequete("DELETE FROM t_loisirs WHERE id_loisir = :id_loisir", array(':id_loisir' => $_GET['id_loisir']));
    
    if ($resultat -> rowCount() == 1) { // si j'ai une ligne dans $resultat, j'ai supprimé un produit
    $contenu .= '<div class="alert alert-success" role="alert">Le loisir à bien été supprimé</div>';
    } else {
        $contenu .= '<div class="alert alert-danger" role="alert">Erreur lors de la suppression</div>';
    }
}

// 4- Traitement de $_POST : enregistrement de la competence en BDD 
//debug($_POST);

if (!empty($_POST)){ // Si le formulaire est soumis

    // Validation des champs du formulaire
    

    if (!isset($_POST['loisir']) || strlen($_POST['loisir']) < 5 || strlen($_POST['loisir']) > 20  ) $contenu .= '<div class="alert alert-danger" role="alert">Le loisir doit contenir entre 5 et 20 caractères.</div>';

    //-------------------------------
  
    // Insertion de nouvelles loisirs en BDD :
    // executeRequete("REPLACE INTO t_loisirs VALUES (NULL, :loisir, $id_utilisateur )",
    //                      array(
    //                            ':loisir'   => $_POST['loisir']                        
    //                         ));


    // Insertion de la competence en BDD :
    // executeRequete(
    //     " REPLACE INTO t_loisirs VALUES (:id_loisir, :loisir, :id_utilisateur)",
    //     array(
    //         ':id_loisir' => $_POST['id_loisir'],
    //         ':loisir' => $_POST['loisir'],
    //         ':id_utilisateur' => $_POST['id_utilisateur']
    //     )
    // );
// REPLACE INTO se comporte comme un INSERT INTO quand l'id_loisir n'existe pas en BDD : C'est le cas lors de la création d'une expérience pour lequel nout avons mis un id_expérience à 0 par défaut dans le formulaire (voir champ id_loisir). REPLACE INTO se comporte comme un UPDATE quand l'id_loisir existe en BDD : C'est le cas lors de la modification d'une expérience existante.

$contenu .= '<div class="alert alert-success" role="alert">Le loisir a bien été enregitré !</div>';

}/* fin if (!empty($_POST)) */


 // Affichage des loisir 
 $resultat = $pdo->query("SELECT  l.id_loisir, l.loisir, ut.nom, ut.prenom
                        FROM t_loisirs l, t_utilisateurs ut
                        WHERE ut.id_utilisateur = $id_utilisateur  AND l.id_utilisateur = $id_utilisateur" . $ordre );



// affichage des informations de chaque ligne $ligne :

    $contenu .='<table class="table table-hover">';
        $contenu .='<thead class="thead-dark">';
            $contenu .= '<tr>';
                $contenu .='<th scope="col"><a href="loisirs.php?colonne=loisirs&ordre=desc"> DESC ▼  </a>Loisirs<a href="loisirs.php?colonne=loisirs&ordre=asc">ASC ▲</a></th>';
               
                $contenu .='<th scope="col">Prénom</th>';
                $contenu .='<th scope="col">Nom</th>';
                $contenu .= '<th colspan="2">Actions</th>';
            $contenu .= '</tr>';
        $contenu .= '</thead>'; 
        while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
        // debug($ligne);
            $contenu .= '<form method="post">' ;
                $contenu .= '<tr>';
                    foreach($ligne as $indice => $valeur){
                            if($indice != 'id_loisir'){
                                $contenu .= '<td>'. $valeur . '</td>'; 
                            }
                        
                    }
                            $contenu .='<td><a href="?id_loisir='. $ligne['id_loisir'] .'"  onclick="return(confirm(\'Etes-vout certain de vouloir supprimer ce loisir ? \' ))" ><i class="far fa-trash-alt"></i></a></td>';
                            $contenu .='<td><a href=""?id_loisir='. $ligne['id_loisir'] .'"  onclick="return(confirm(\'Etes-vout certain de vouloir modifier ce loisir ? \' ))"><i class="far fa-edit"></i></a></td>';
    
                $contenu .= '</tr>';
            $contenu .= '</form>';  
        }
        // $ligne['id_loisir'] contien l'id de chaque langue à chaque tour de boucle while : ainsi le lien est dynamique, l'id passé en GET change selon le langue sur lequel je clique
    

$contenu .='</table'; 


//------------------------AFFICHAGE---------------------------

require_once 'inc/haut.inc.php';
?>

<div class="container mt-5" style="min-width: 180vh">
    <div class="jumbotron mt-5">
        <h1 class="text-center mt-4 mb-4">Gestion de votre  CV</h1>
        <?php    echo '<h4 class="text-center mt-4 mb-4">' . $prenom . ' - ' . $nom .  '</h4>';  ?>
        <h2 class="text-center lead"> Vout êtes un admin.</h2>
        
    </div>

    <div class="row mb-4">
        <div class="col-lg-12 text-center">
            <h2>Suppression</h2>
        </div>
    </div>

    <div class="row m-5">
        <div class="col-lg-12">
            <?php  echo $contenu;?>
        </div>
    </div>
    <div class="container">
        <div class="row ">
            <div class="col-lg-4 text-center m-5">
                <h2>Ajout d'un loisir </h2>
            </div>
            <div class="col-lg-4 ">
                <form method ="post" action=""> 
                    <input type="hidden" id="id_loisir" name="id_loisir" value="0"><!-- Ce champ caché est utile pour la modification d'un produit afin de l'identifier dans la requête SQL. La valeur 0 par défaut signifie que le produit n'existe pas en BDD, et qu'on est en train de le créer -->
                    <div class="form-group">
                        <input type="text" class="form-control" name="loisir" id="loisir" placeholder="Loisir">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn-success"  value="valider">
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <?php echo $contenu2 ;?>
            </div>
        </div>
    </div>
</div>



<?php
require_once 'inc/bas.inc.php';