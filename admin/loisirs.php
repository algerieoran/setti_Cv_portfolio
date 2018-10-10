<?php require 'connexion.php'; 
// insertion d'un loisir
if(isset($_POST['loisir'])){
    //si on a reçu un nouveau loisir
    if($_POST['loisir']!=''){
        $loisir = addslashes($_POST['loisir']);
        $pdoCV -> exec("INSERT INTO t_loisirs VALUES (NULL, '$loisir', '1')");

        header("location: ../admin/loisirs.php");
            exit();


    }// ferme le if n'est pas vide
}//ferme le if isset

//Supression d'un loisir de la BDD
if(isset($_GET['id_loisir'])){
    // on recupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_loisir'];// je passe l'id dans une variable $efface

    $sql = " DELETE FROM t_loisirs WHERE id_loisir = '$efface' ";
    $pdoCV -> query($sql); // on peut le faire avec exec() également

    header("location: ../admin/loisirs.php");
}// Ferme le if isset pour la suppression

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CDN Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <title>Admin : LesLoisirs</title>
</head>
<body>
    <h1>Les loisirs et insertion d'un nouveau Loisir :</h1>
    <?php
   //requête pour compter et chercher plusieurs enrengistrement on ne peut compter si on a un prepare
    $sql = $pdoCV ->prepare("SELECT  * FROM t_loisirs");
    $sql -> execute();
    $nbr_loisirs = $sql-> rowCount();

    ?>

    <div>
        <table border="1">
        <caption>La liste des loisirs : <?php echo $nbr_loisirs ;?></caption>
            <thead>
                <tr>
                    <th>Loisirs</th>
                    <th>Modifier</th>
                    <th>Suppression</th>
                </tr>
            </thead>
            <tbody>
    
            <?php while($ligne_loisir = $sql ->fetch())  
            {
            ?>
                <tr> 
                    <td><?php echo $ligne_loisir['loisir'];?></td>
                    <td><a href="modif_loisir.php?id_loisir=<?php echo $ligne_loisir['id_loisir'];?>">Modif</a></td>
                    <td><a href="loisirs.php?id_loisir=<?php echo $ligne_loisir['id_loisir'];?>">Suppr</a></td>
                </tr>
            <?php 
            }
            ?>
            </tbody>
        </table>
    </div>
    <hr>
    <!-- insertion d'une nouvelle competence formulaire -->
    <form action="loisirs.php" method="post">
        <div class="">
            <label for="loisir">Loisir</label>
            <input type="text" name="loisir" placeholder="Nouveau loisir" required>
        </div>
        <div class="">
            <button type="submit">Insérer un loisir</button>
        </div>
    </form>
</body>
</html>