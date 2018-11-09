<?php require_once 'inc/init.inc.php';

//pour le tri des colonnes 
$ordre = ''; // on vide la variable 

if (isset($_GET['ordre']) && isset($_GET['colonne'])) {

    if ($_GET['colonne'] == 'loisirs') {
        $ordre = ' ORDER BY loisir';
    }

    if ($_GET['ordre'] == 'asc') {
        $ordre .= ' ASC';
    } elseif ($_GET['ordre'] == 'desc') {
        $ordre .= ' DESC';
    }
}

// insertion d'un loisir
if(isset($_POST['loisir'])) { // si on a reçu une nouvelle formation

    if($_POST['loisir']!='') {

        $loisir = addslashes($_POST['loisir']);
    
        $pdo -> exec("INSERT INTO t_loisirs VALUES (NULL, '$loisir', '1')");

        header("location:loisirs.php");
            exit();

    } // ferme le if n'est pas vide
} // ferme le if isset


// suppression d'un élément de la BDD
if(isset($_GET['id_loisir'])) { // on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_loisir']; //je passe l'id dans une variable $efface

    $sql = "DELETE FROM t_loisirs WHERE id_loisir = '$efface' "; // delete de la BDD
    $pdo -> query($sql); // on peut le faire avec exec également

    header("location:loisirs.php");
} // ferme le if isset pour la suppression

//----------------------------- AFFICHAGE -------------------------

require_once 'inc/haut.inc.php';

?>

    <?php
        //requête pour compter et chercher plusieurs enregistrements, on ne peut compter que si on a un prepare

        $sql = $pdo -> prepare("SELECT * FROM t_loisirs".$ordre);
        $sql -> execute();
        $nbr_loisirs = $sql -> rowCount();
    ?>

<div class="container margin">
    <div class="row m-2 p-1">
        <div class="col-xs-12 col-sm-12 col-md-9 col-xl-9">
            <div class="table-responsive">
                <table class="table table-bordered border border-danger table-hover table-primary table-striped table-sm">

                    <thead>
                        <tr>
                            <th style="width:18%;">Loisir<a href="loisirs.php?column=loisirs&ordre=asc"> <i class="fas fa-sort-up"></i></a> |
                            <a href="loisirs.php?column=loisirs&ordre=desc"> <i class="fas fa-sort-down"></i></a></th>
                            <th>Modifier </th>
                            <th>Supprimer </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($line_loisir=$sql ->fetch())
                        {
                        ?> 
                            <tr id="<?php echo $line_loisir['id_loisir']; ?>">
                                <td><?php echo $line_loisir['loisir']; ?></td>
                                <td><a href="modif_loisir.php?id_loisir=<?php echo $line_loisir['id_loisir']; ?>"><i class="fas fa-edit"></i></a></td> 
                                <td><a href="loisirs.php?id_loisir=<?php echo $line_loisir['id_loisir']; ?>"><i class="fas fa-window-close"></i></a></td>
                            </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <p class="text-primary font-weight-bold text-center">La liste des loisirs : <?php echo $nbr_loisirs; ?></p>
        </div> <!-- fin col 1 -->
            
         <div class="col-xs-12 col-sm-12 col-md-3 col-xl-3">   
        <div class="card-header border border-dark text-center">AJOUTER</div>

            <form action="loisirs.php" method="post" class="text-dark border border-dark p-2">
                    
                <div class="form-group">
                <label for="loisir">Loisir</label>
                    <input class="form-control" type="text" name="loisir" id="loisir" placeholder="" required>
                </div>
                    
                <button type="submit" class="btn btn-primary">Ajouter</button>  
            </form> 
        </div> <!-- fin col 2 -->
    </div> <!-- fin row -->
</div> <!-- fin container -->
    
<?php require_once 'inc/bas.inc.php';