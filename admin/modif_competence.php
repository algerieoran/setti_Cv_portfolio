<?php require 'connexion.php'; 
//2) gestion mise à jour d'une information
if(isset($_POST['competence'])){

    $competence =addslashes($_POST['competence']);
    $niveau =addslashes($_POST['niveau']);
    $categorie =addslashes($_POST['categorie']);
    $id_competence = $_POST['id_competence'];

    $pdoCV -> exec(" UPDATE t_competences SET competence='$competence', niveau='$niveau', categorie='$categorie' WHERE id_competence='$id_competence' ");
    header('location: ../admin/competences.php');
    exit();
}

//1) jr récupère l'id de ce que je mets à jour
$id_competence = $_GET['id_competence']; // par son id et avec GET
$sql = $pdoCV -> query(" SELECT * FROM t_competences WHERE id_competence='$id_competence' ");
$ligne_competence = $sql -> fetch(); // va chercher !
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>admin : Mise à jour des competences</title>
    </head>
    <body>
        <h1>Mise à jour d'une competence</h1>
    
        <!-- insertion d'une nouvelle competence formulaire -->
        <form action="modif_competence.php" method="post">
            <div class="">
                <label for="competence">Competence</label>
                <input type="text" name="competence" value="<?php echo $ligne_competence['competence'];?>">
            </div>
            <div class="">
                <label for="niveau">Niveau</label>
                <input type="text" name="niveau" value="<?php echo $ligne_competence['niveau'];?>">
            </div>
            <div class="">
            <label for="categorie">Catégorie</label>
            <select name="categorie">
                <option value="Back"
                <?php // pour ajouter selected="selected" à la balise option si c'est la categorie de la compétence.
                    
                    if (!(strcmp("Back", $ligne_competence['categorie']))) {// strcmp compare deux chaînes de caractères
                        echo "selected=\"selected\"";
                    }
                    ?>>Back</option>
                <option value="Front"
                <?php 
                    
                    if (!(strcmp("Front", $ligne_competence['categorie']))) {// strcmp compare deux chaînes de caractères
                        echo "selected=\"selected\"";
                    }
                ?>
                >Front</option>
                <option value="CMS"
                <?php // pour ajouter selected="selected" à la balise option si c'est la categorie de la compétence.
                    
                    if (!(strcmp("CMS", $ligne_competence['categorie']))) {// strcmp compare deux chaînes de caractères
                        echo "selected=\"selected\"";
                    }
                ?>
                >CMS</option>
                <option value="Frameworks"
                <?php // pour ajouter selected="selected" à la balise option si c'est la categorie de la compétence.
                    
                    if (!(strcmp("Frameworks", $ligne_competence['categorie']))) {// strcmp compare deux chaînes de caractères
                        echo "selected=\"selected\"";
                    }
                ?>
                >Frameworks</option>
            </select>
        </div>

            <div class="">
                <input type="hidden" name="id_competence" value="<?php echo $ligne_competence['id_competence'];?>">
                <button type="submit">MAJ</button>
            </div>
        </form>
    </body>
</html>