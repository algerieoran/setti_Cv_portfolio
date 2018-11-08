<?php require_once 'inc/init.inc.php';

$ordre = '';

// insertion d'une formation

if(isset($_POST['url'])) { // si on a reçu une nouvelle formation

    if($_POST['url']!='') {

        $url = addslashes($_POST['url']);

        $pdo -> exec("INSERT INTO t_reseaux VALUES (NULL, '$url', '1')");

        $contenu .= '<div class="alert alert-success" role="alert">La langue a bien été enregitré !</div>';

        header("location:reseaux.php");
            exit();

    } // ferme le if n'est pas vide
} // ferme le if isset



// suppression d'un élément de la BDD
if(isset($_GET['id_reseau'])) { // on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_reseau']; //je passe l'id dans une variable $efface

    $sql = "DELETE FROM t_reseaux WHERE id_reseau = '$efface' "; // delete de la BDD
    $pdo -> query($sql); // on peut le faire avec exec également

        if ($sql -> rowCount() == 1) { // si j'ai une ligne dans $sql, j'ai supprimé un reseau
        $contenu .= '<div class="alert alert-success" role="alert">Le reseau à bien été supprimé</div>';
        } else {
            $contenu .= '<div class="alert alert-danger" role="alert">Erreur lors de la suppression</div>';
        }

    header("location:reseaux.php");
} // ferme le if isset pour la suppression


// Update de reseau pour chaque utilisateur
    if (!empty($_POST)){ // Si le formulaire est soumis
        // debug($_POST);
    
        // Validation des champs du formulaire
     
        // echo ($_POST['url_reseau'] );
        if ($_POST['icon'] == 'Facebook'){
            $url .=  '<a href="' . $_POST['url_reseau'] . '" target="_blank"><i class="fab fa-facebook fa-2x fa-fw"></i></a>';
        }
    
        if ($_POST['icon']  == 'Instagram'){
            $url .=  '<a href="' . $_POST['url_reseau'] . '" target="_blank"><i class="fab fa-instagram fa-2x fa-fw"></i></a>';
        }
    
        if ($_POST['icon']  == 'Twitter'){
            $url .=  '<a href="' . $_POST['url_reseau'] . '" target="_blank"><i class="fab fa-twitter-square fa-2x fa-fw"></i></a>';
        }
        if ($_POST['icon'] == 'Linkedin'){
            $url .=  '<a href="' . $_POST['url_reseau'] . '" target="_blank"><i class="fab fa-linkedin fa-2x fa-fw"></i></a>';
        }
        // echo($url);
    
        if (!isset($_POST['url_reseau']) || strlen($_POST['url_reseau']) < 4 || strlen($_POST['url_reseau']) > 255  ) $contenu .= '<div class="alert alert-danger" role="alert">Le nom doit contenir entre 50 et 255 caractères.</div>';
         //-------------------------------
  
        

    
     

        
    
    }/* fin if (!empty($_POST)) */
    

//----------------------------- AFFICHAGE -------------------------

require_once 'inc/haut.inc.php';

?>

   

<div class="container margin" style="min-width: 180vh; min-height: 180vh">
    <div class="row">  
        <div class="col-sm-12 col-md-8 col-lg-8 bg-secondary">
    <?php
        //requête pour compter et chercher plusieurs enregistrements, on ne peut compter que si on a un prepare

        $sql = $pdo -> prepare("SELECT * FROM t_reseaux".$ordre);
        $sql -> execute();
        $nbr_reseaux = $sql -> rowCount();
    ?>
    <div class="row m-5 p-1">
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

          
        </div> <!-- fin col 1 -->

            
        <div class="container">
            <div class="row ">
                    <div class="col-lg-4 text-center m-5">
                        <h2 class="text-primary font-weight-bold text-center">La liste des reseaux : <?php echo $nbr_reseaux; ?></h2>
                    </div>
                    <div class="col-lg-4 ">
                        <form method ="post" action=""> 
                            <input type="hidden" id="id_reseau" name="id_reseau" value="0"><!-- Ce champ caché est utile pour la modification d'un produit afin de l'identifier dans la requête SQL. La valeur 0 par défaut signifie que le produit n'existe pas en BDD, et qu'on est en train de le créer -->
                        
                            <div class="form-group">
                                <label for="url">Url de réseau</label>
                                <input type="text" class="form-control" name="url" id="url" placeholder="Votre Url">
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
                                <input type="submit" class="form-control btn-primary"  value="Enregistrer">
                            </div>
                        </form>
                    </div> 
              
            </div>
    </div>

<?php require_once 'inc/bas.inc.php';


