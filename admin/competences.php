<?php require 'connexion.php'; 

// insertion d'une competence
if(isset($_POST['competence'])){
    //si on a reçu un nouvelle competencecompetence
    if($_POST['competence']!='' && $_POST['niveau']!='' && $_POST['categorie']!=''){

        $competence = addslashes($_POST['competence']);
        $niveau = addslashes($_POST['niveau']);
        $categorie = addslashes($_POST['categorie']);
        $pdoCV -> exec("INSERT INTO t_competences VALUES (NULL, '$competence', '$niveau', '$categorie', '1')");

        header("location: ../admin/competences.php");
            exit();

    }// ferme le if n'est pas vide
}//ferme le if isset($_POST['competence'])

//Supression d'une competence de la BDD
if(isset($_GET['id_competence'])){
    // on recupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_competence'];// je passe l'id dans une variable $efface

    $sql = " DELETE FROM t_competences WHERE id_competence = '$efface' ";// delete de la base 
    $pdoCV -> query($sql); // on peut le faire avec exec() également

    header("location: ../admin/competences.php");

}// Ferme le if isset pour la suppression
//********************TRI PAR ORDER CROISSANT ET DECROISSANT ************************* */

$order = '';
if(isset($_GET['order']) && isset($_GET['column'])){	// début de if(isset($_GET['order']))

	if($_GET['column'] == 'competence'){
		$order = ' ORDER BY competence';
	}

	elseif($_GET['column'] == 'niveau'){
		$order = ' ORDER BY niveau';
	}

	
	elseif($_GET['column'] == 'categorie'){
		$order = ' ORDER BY categorie';
    }
    
    if($_GET['order'] == 'asc'){
		$order.= ' ASC';
	}

	elseif($_GET['order'] == 'desc'){
		$order.= ' DESC';
	}


}	//  fin de if(isset($_GET['order']) && isset($_GET['column']))


?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin : Les competences</title>
        <!-- CDN Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <!-- Lien Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    
    </head>
    <body>
        <h1 class="display-">Les compétences et insertion d'une nouvelle compétence</h1>
        <?php 
            //requête popur compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
            $sql = $pdoCV -> prepare("SELECT * FROM t_competences" . $order);
            $sql -> execute();  // j'exécute la requête
            $nbr_competences = $sql -> rowCount();
        ?>

        <div class="row">

            <div class="col-sm-8">

                <table class="table table-striped table-dark">
                    <caption class="">La liste des compétences : <?php echo $nbr_competences; ?></caption>

                    <thead>
                        <tr>
                            <th>Les compétences<a href="competences.php?column=competence&order=asc"> <i class="far fa-arrow-alt-circle-up"></i></a> | <a href="competences.php?column=competence&order=desc"><i class="far fa-arrow-alt-circle-down"></i></a></th>
                            <th>Niveau<a href="competences.php?column=niveau&order=asc"> <i class="far fa-arrow-alt-circle-up"></i></a> | <a href="competences.php?column=niveau&order=desc"><i class="far fa-arrow-alt-circle-down"></i></a></th>
                            <th>Catégorie<a href="competences.php?column=categorie&order=asc"> <i class="far fa-arrow-alt-circle-up"></i></a> | <a href="competences.php?column=categorie&order=desc"><i class="far fa-arrow-alt-circle-down"></i></a></th>
                            <th>Modifier</th>
                            <th>Suppression</th>
                        </tr>
                    </thead><!-- fin <thead> -->
                    <tbody>
                    <?php  while($ligne_competence = $sql -> fetch()) 
                        {
                    ?>
                        <tr>
                            <td><?php echo $ligne_competence['competence']; ?></td>
                            <td><?php echo $ligne_competence['niveau']; ?></td>
                            <td><?php echo $ligne_competence['categorie']; ?></td>
                            <td><a href="modif_competence.php?id_competence=<?php echo $ligne_competence['id_competence']; ?> " ><i class="fas fa-edit"></i></a></td>
                            <td><a href="competences.php?id_competence=<?php echo $ligne_competence['id_competence']; ?> " ><i class="fas fa-trash"></i></a></td>
                        </tr>
                        <?php 
                            }  // fin de la boucle while
                        ?>
                    </tbody><!-- fin <tbody> -->
                </table><!-- fin <table> -->

            </div><!-- fin div .col-sm-8 -->
            <hr>
            
            <!-- insertion d'une nouvelle competence formulaire -->
           
            <div class="col-sm-4">

                <form action="competences.php" method="post">
                    <div class="form-group">
                        <label for="competence">Compétence :</label>
                        <input type="text" name="competence" class="form-control" placeholder="Nouvelle compétence" required>
                    </div>
                    <div class="form-group">
                        <label for="niveau">Niveau :</label>
                        <input type="text" name="niveau" class="form-control" placeholder="Niveau en chiffre" required>
                    </div>
                    <div class="form-group">
                        <label for="categorie">Catégorie</label>
                        <select name="categorie" class="form-control">
                            <option value="Back">Back</option>
                            <option value="CMS">CMS</option>
                            <option value="Front">Front</option>
                            <option value="Frameworks">Frameworks</option>
                        </select>
                    </div>
                    
                    <button class="btn btn-primary" type="submit">Insérer une compétence </button>
                    
                </form><!-- Fin dui formulaire -->

            </div><!-- fin div .col-sm-4 -->
            
        </div><!-- fin div .row -->
    </body>
</html>