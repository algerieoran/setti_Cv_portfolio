<?php require_once 'inc/init.inc.php';

$ordre = '';

// insertion d'une formation

if(isset($_POST['dates_exp'])) { // si on a reçu une nouvelle formation

    if($_POST['dates_exp']!='' && $_POST['titre_exp']!='' && $_POST['stitre_exp']!='' && $_POST['description_exp']!='') {

        $dates_exp = addslashes($_POST['dates_exp']);
        $titre_exp = addslashes($_POST['titre_exp']);
        $stitre_exp = addslashes($_POST['stitre_exp']);
        $description_exp = addslashes($_POST['description_exp']);

        $pdo -> exec("INSERT INTO t_experiences VALUES (NULL, '$dates_exp', '$titre_exp', '$stitre_exp', '$description_exp', '1')");

        header("location:experiences.php");
            exit();

    } // ferme le if n'est pas vide
} // ferme le if isset

if(isset($_GET['ordre']) && isset($_GET['column'])){

    if($_GET['column'] == 'dates_exps') {
        $ordre = ' ORDER BY dates_exp'; }

    elseif($_GET['column'] == 'titre_exp') { 
        $ordre = ' ORDER BY titre_exp'; }

    elseif($_GET['column'] == 'stitre_exp') {
        $ordre = ' ORDER BY stitre_exp'; }

    elseif($_GET['column'] == 'description_exp') {
        $ordre = ' ORDER BY description_exp'; }

    if($_GET['ordre'] == 'asc') {
        $ordre.= ' ASC'; }

    elseif($_GET['ordre'] == 'desc') { 
        $ordre.= ' DESC'; }     
}

// suppression d'un élément de la BDD
if(isset($_GET['id_experience'])) { // on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_experience']; //je passe l'id dans une variable $efface

    $sql = "DELETE FROM t_experiences WHERE id_experience = '$efface' "; // delete de la BDD
    $pdo -> query($sql); // on peut le faire avec exec également

    header("location:experiences.php");
} // ferme le if isset pour la suppression

//----------------------------- AFFICHAGE -------------------------

require_once 'inc/haut.inc.php';

?>

    <?php
        //requête pour compter et chercher plusieurs enregistrements, on ne peut compter que si on a un prepare

        $sql = $pdo -> prepare("SELECT * FROM t_experiences".$ordre);
        $sql -> execute();
        $nbr_experiences = $sql -> rowCount();
    ?>

<div class="container margin">
    <div class="row m-2 p-1">
        <div class="col-xs-12 col-sm-12 col-md-9 col-xl-9">
            <div class="table-responsive">
                <table class="table table-bordered border border-danger table-hover table-primary table-striped table-sm">

                    <thead>
                        <tr>
                            <th style="width:18%;">Dates<a href="experiences.php?column=dates_exps&ordre=asc"> <i class="fas fa-sort-up"></i></a> |
                            <a href="formations.php?column=dates_exps&ordre=desc"> <i class="fas fa-sort-down"></i></a></th>
                            <th style="width:27%;">Titre exp</th>
                            <th style="width:25%;">Sous-titres</th>
                            <th style="width:25%;">Description</th>
                            <th>Modifier </th>
                            <th>Supprimer </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($line_experience=$sql ->fetch())
                        {
                        ?> 
                            <tr id="<?php echo $line_experience['id_experience']; ?>">
                                <td><?php echo $line_experience['dates_exp']; ?></td>
                                <td><?php echo $line_experience['titre_exp']; ?></td>
                                <td><?php echo $line_experience['stitre_exp']; ?></td>
                                <td><?php echo $line_experience['description_exp']; ?></td>
                                <td><a href="modif_experience.php?id_experience=<?php echo $line_experience['id_experience']; ?>"><i class="fas fa-edit"></i></a></td> 
                                <td><a href="experiences.php?id_experience=<?php echo $line_experience['id_experience']; ?>"><i class="fas fa-window-close"></i></a></td>
                            </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <p class="text-primary font-weight-bold text-center">La liste des expériences : <?php echo $nbr_experiences; ?></p>
        </div> <!-- fin col 1 -->
            
         <div class="col-xs-12 col-sm-12 col-md-3 col-xl-3">   
        <div class="card-header border border-dark text-center">AJOUTER</div>

            <form action="experiences.php" method="post" class="text-dark border border-dark p-2">
                    
                <div class="form-group">
                <label for="dates_exp">Dates</label>
                    <input class="form-control" type="text" name="dates_exp" id="dates_exp" placeholder="" required>
                </div>
                    
                <div class="form-group">
                    <label for="titre_exp">Titre</label>
                    <input class="form-control" type="text" name="titre_exp" id="titre_exp" placeholder="" required>
                </div>
                    
                <div class="form-group">
                    <label for="stitre_exp">Sous-titres</label>
                    <input class="form-control" type="text" name="stitre_exp" id="stitre_exp" placeholder="">
                </div>
                    
                <div class="form-group">
                    <label for="description_exp">Description</label>
                    <input class="form-control" type="text" name="description_exp" id="description_exp" placeholder="">
                </div>
                    
                <button type="submit" class="btn btn-primary">Ajouter</button>  
            </form> 
        </div> <!-- fin col 2 -->
    </div> <!-- fin row -->
</div> <!-- fin container -->
    
<?php require_once 'inc/bas.inc.php';


