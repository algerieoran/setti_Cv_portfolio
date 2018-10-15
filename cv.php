<?php
require_once 'inc/init.inc.php';

// 1- Affichages des  :
$resultat = executeRequete("SELECT * FROM t_utilisateurs WHERE id_utilisateur = 1");  


$contenu_gauche .= '<div class="list-group">';
// Affichage de la catégorie "tous" :

        $contenu_gauche .=  '<a href="?categorie=tous" class="list-group-item">tous</a>';

        // Affichage des autres catégories (provenant de la BDD) :
        while ($cat = $resultat->fetch(PDO::FETCH_ASSOC)) {
            //debug($cat);  // on voit que catégories sont dans cet array $cat à l'indice "categorie"

            $contenu_gauche .=  '<a href="?categorie='.$cat['categorie'].'" class="list-group-item">'. $cat['categorie'] .'</a>';  // on met l'array $cat['categorie'] à la place de "tous" pour récupérer à chaque tour de boucle chacune des catégories prédentent dans cet array (voir le debug ci dessus)
        }

$contenu_gauche .='</div>';



// 2- Affichage des produits selon la catégorie choisie :
if(isset($_GET['categorie']) && $_GET['categorie'] !='tous') {
    // si existe categorie dans $_GET (donc mon url), c'est qu'on a cliqué sur une categorie. De plus, si elle est différente de "tous" c'est qu'on a choisi une categorie particulier (robe, pull...). On sélectionne donc tous les produits de CETTE categorie :
        $donnees = executeRequete("SELECT * FROM produit WHERE categorie = :categorie", array(':categorie'=> $_GET['categorie']));

}else {
    // dans le cas contraire , on affiche TOUS les produits :

    $donnees = executeRequete("SELECT * FROM produit");

    }

while ($produit = $donnees->fetch(PDO::FETCH_ASSOC)) {
    //debug($produit);  // on a 1 array avec 1 seule produit à l'interieur à chaque tour de boucle

    // ici on met tout le HTML de présentation du produit :
    $contenu_droite .= '<div class="col-sm-4 mb-4">';
        $contenu_droite .= '<div class="card">';
            
            // Image cliquable du produit :
            $contenu_droite .= '<a href="fiche_produit.php?id_produit='. $produit['id_produit']  .'"><img class="card-img-top" src="'. $produit['photo'] .'" alt="'. $produit['titre'] .'"></a>';

            // les infos du produit :
            $contenu_droite .= '<div class="card-body">';

                $contenu_droite .= '<h4>' . $produit['titre']  .'</h4>';
                $contenu_droite .= '<h5>' . $produit['prix']  .'€</h5>';
                $contenu_droite .= '<p>' . $produit['description']  .'</p>';

            $contenu_droite .= '</div>';  //  class="card-body"

        $contenu_droite .= '</div>';  // class="card"

    $contenu_droite .= '</div>';  //class="col-sm-4 mb-4"
}    


//-----------------------------------------------------AFFICHAGE------------------------------------------------
require_once 'inc/haut.inc.php';
?>
<h1 class="mt-4">Vetements</h1>

<div class="row">
    <div class="col-md-3">
        <?php echo $contenu_gauche; ?>
    </div>

    <div class="col-md-9">
        <div class="row">
        <?php echo $contenu_droite; ?> 
        </div>
    </div>

</div>

<?php

require_once 'inc/bas.inc.php';