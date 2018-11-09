<?php require_once 'inc/init.inc.php';

//pour le tri des colonnes 
$ordre = ''; // on vide la variable 

if (isset($_GET['ordre']) && isset($_GET['colonne'])) {

  if ($_GET['colonne'] == 'titre_form') {
    $ordre = ' ORDER BY titre_form';
  } elseif ($_GET['colonne'] == 'stitre_form') {
    $order = ' ORDER BY stitre_form';
  } elseif ($_GET['colonne'] == 'dates_form') {
    $order = ' ORDER BY dates_form';
  } elseif ($_GET['colonne'] == 'description_form') {
    $order = ' ORDER BY descrition_form';
  }

  if ($_GET['ordre'] == 'asc') {
    $ordre .= ' ASC';
  } elseif ($_GET['ordre'] == 'desc') {
    $ordre .= ' DESC';
  }
}

// insertion d'une formation

if(isset($_POST['dates_form'])) { // si on a reçu une nouvelle formation

    if($_POST['dates_form']!='' && $_POST['titre_form']!='' && $_POST['stitre_form']!='' && $_POST['description_form']!='' && $_POST['icon']!='') {

        $icon = addslashes($_POST['icon']);
        $dates_form = addslashes($_POST['dates_form']);
        $titre_form = addslashes($_POST['titre_form']);
        $stitre_form = addslashes($_POST['stitre_form']);
        $description_form = addslashes($_POST['description_form']);

        $pdo -> exec("INSERT INTO t_formations VALUES (NULL,'$icon', '$dates_form', '$titre_form', '$stitre_form', '$description_form', '1')");

        header("location:formations.php");
            exit();

    } // ferme le if n'est pas vide
} // ferme le if isset



// suppression d'un élément de la BDD
if(isset($_GET['id_formation'])) { // on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_formation']; //je passe l'id dans une variable $efface

    $sql = "DELETE FROM t_formations WHERE id_formation = '$efface' "; // delete de la BDD
    $pdo -> query($sql); // on peut le faire avec exec également

    header("location:formations.php");
} // ferme le if isset pour la suppression

//----------------------------- AFFICHAGE -------------------------

require_once 'inc/haut.inc.php';

?>

    <?php
        //requête pour compter et chercher plusieurs enregistrements, on ne peut compter que si on a un prepare

        $sql = $pdo -> prepare("SELECT * FROM t_formations".$ordre);
        $sql -> execute();
        $nbr_formations = $sql -> rowCount();
    ?>

<div class="container margin">
    <div class="row m-2 p-1">
        <div class="col-xs-12 col-sm-12 col-md-9 col-xl-9">
            <div class="table-responsive">
                <table class="table table-bordered border border-danger table-hover table-primary table-striped table-sm">

                    <thead>
                        <tr>
                            <th style="width:18%;">Dates<a href="formations.php?column=dates_forms&ordre=asc"> <i class="fas fa-sort-up"></i></a> |
                            <a href="formations.php?column=dates_forms&ordre=desc"> <i class="fas fa-sort-down"></i></a></th>
                            <th style="width:27%;">Titre formation</th>
                            <th style="width:25%;">Sous-titres</th>
                            <th style="width:25%;">Description</th>
                            <th>Modifier </th>
                            <th>Supprimer </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($line_formation=$sql ->fetch())
                        {
                        ?> 
                            <tr id="<?php echo $line_formation['id_formation']; ?>">
                                <td><?php echo $line_formation['dates_form']; ?></td>
                                <td><?php echo $line_formation['titre_form']; ?></td>
                                <td><?php echo $line_formation['stitre_form']; ?></td>
                                <td><?php echo $line_formation['description_form']; ?></td>
                                <td><a href="modif_formation.php?id_formation=<?php echo $line_formation['id_formation']; ?>"><i class="fas fa-edit"></i></a></td> 
                                <td><a href="formations.php?id_formation=<?php echo $line_formation['id_formation']; ?>"><i class="fas fa-window-close"></i></a></td>
                            </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <p class="text-primary font-weight-bold text-center">La liste des formations : <?php echo $nbr_formations; ?></p>
        </div> <!-- fin col 1 -->
            
         <div class="col-xs-12 col-sm-12 col-md-3 col-xl-3">   
        <div class="card-header border border-dark text-center">AJOUTER</div>

            <form action="formations.php" method="post" class="text-dark border border-dark p-2">
                    
                <div class="form-group">
                <label for="dates_form">Dates</label>
                    <input class="form-control" type="text" name="dates_form" id="dates_form" placeholder="" required>
                </div>
                    
                <div class="form-group">
                    <label for="titre_form">Titre</label>
                    <input class="form-control" type="text" name="titre_form" id="titre_form" placeholder="" required>
                </div>
                    
                <div class="form-group">
                    <label for="stitre_form">Sous-titres</label>
                    <input class="form-control" type="text" name="stitre_form" id="stitre_form" placeholder="">
                </div>
                    
                <div class="form-group">
                    <label for="description_form">Description</label>
                    <input class="form-control" type="text" name="description_form" id="description_form" placeholder="">
                </div>
                    
                <button type="submit" class="btn btn-primary">Ajouter</button>  
            </form> 
        </div> <!-- fin col 2 -->
    </div> <!-- fin row -->
</div> <!-- fin container -->
    
<?php require_once 'inc/bas.inc.php';


