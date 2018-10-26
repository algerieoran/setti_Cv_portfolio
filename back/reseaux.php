<?php require_once 'inc/init.inc.php';

$ordre = '';

// insertion d'une formation

if(isset($_POST['url'])) { // si on a reçu une nouvelle formation

    if($_POST['url']!='') {

        $url = addslashes($_POST['url']);

        $pdo -> exec("INSERT INTO t_reseaux VALUES (NULL, '$url', '1')");

        header("location:reseaux.php");
            exit();

    } // ferme le if n'est pas vide
} // ferme le if isset

// suppression d'un élément de la BDD
if(isset($_GET['id_reseau'])) { // on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_reseau']; //je passe l'id dans une variable $efface

    $sql = "DELETE FROM t_reseaux WHERE id_reseau = '$efface' "; // delete de la BDD
    $pdo -> query($sql); // on peut le faire avec exec également

    header("location:reseaux.php");
} // ferme le if isset pour la suppression

//----------------------------- AFFICHAGE -------------------------

require_once 'inc/haut.inc.php';

?>

    <?php
        //requête pour compter et chercher plusieurs enregistrements, on ne peut compter que si on a un prepare

        $sql = $pdo -> prepare("SELECT * FROM t_reseaux".$ordre);
        $sql -> execute();
        $nbr_reseaux = $sql -> rowCount();
    ?>

<div class="container">
    <div class="row m-2 p-1">
        <div class="col-xs-12 col-sm-12 col-md-9 col-xl-9">
            <div class="table-responsive">
                <table class="table table-bordered border border-danger table-hover table-primary table-striped table-sm">

                    <thead>
                        <tr>
                            <th>URL</th>
                            <th>Modifier </th>
                            <th>Supprimer </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($line_reseau=$sql ->fetch())
                        {
                        ?> 
                            <tr id="<?php echo $line_reseau['id_reseau']; ?>">
                                <td><?php echo $line_reseau['url']; ?></td>
                                <td><a href="modif_reseau.php?id_reseau=<?php echo $line_reseau['id_reseau']; ?>"><i class="fas fa-edit"></i></a></td> 
                                <td><a href="reseaux.php?id_reseau=<?php echo $line_reseau['id_reseau']; ?>"><i class="fas fa-window-close"></i></a></td>
                            </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <p class="text-primary font-weight-bold text-center">La liste des reseaux : <?php echo $nbr_reseaux; ?></p>
        </div> <!-- fin col 1 -->
            
         <div class="col-xs-12 col-sm-12 col-md-3 col-xl-3">   
        <div class="card-header border border-dark text-center">AJOUTER</div>

            <form action="reseaux.php" method="post" class="text-dark border border-dark p-2">
                    
                <div class="form-group">
                <label for="url">URL</label>
                    <input class="form-control" type="text" name="url" id="url" placeholder="" required>
                </div>
                    
                <button type="submit" class="btn btn-primary">Ajouter</button>  
            </form> 
        </div> <!-- fin col 2 -->
    </div> <!-- fin row -->
</div> <!-- fin container -->
    
<?php require_once 'inc/bas.inc.php';


