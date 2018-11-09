<?php


require_once 'inc/init.inc.php';
if(internauteEstConnecteEtAdmin()){
    // ----------------------mise à jour des messages-------------------------------

    if (isset($_GET['id_message'])) {
        $resultat = executeRequete("DELETE FROM t_messages WHERE id_message = :id_message", array(':id_message' => $_GET['id_message']));
        
        if ($resultat -> rowCount() == 1) { // si j'ai une ligne dans $resultat, j'ai supprimé une message
        $contenu .= '<div class="alert alert-success" role="alert">La message à bien été supprimé</div>';
        } else {
            $contenu .= '<div class="alert alert-danger" role="alert">Erreur lors de la suppression</div>';
        }
    }
}



    $message ='';
    if (!empty($_POST)) {
        // $presentation = htmlspecialchars($_POST['presentation'], ENT_QUOTES);
        // $message =$_POST['message'];
        if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)  ) $contenu .= '<div class="alert alert-danger" role="alert">Email est incorrect.</div>';// filter_var() avec l'argument FILTER_VALIDATE_EMAIL valide que $_POST['email] est bien de format d'un email. Notez que cela marche aussi  pour valider les URL avec FILTER_VALIDATE_URL
        
        if (!isset($_POST['nom']) || strlen($_POST['nom']) < 4 || strlen($_POST['nom']) > 50  ) $contenu .= '<div class="alert alert-danger" role="alert">Le nom doit contenir entre 4 et 50 caractères.</div>';
        if (!isset($_POST['message']) || strlen($_POST['message']) < 20 || strlen($_POST['message']) > 255  ) $contenu .= '<div class="alert alert-danger" role="alert">Le message doit contenir entre 8 et 255 caractères.</div>';

   
   
      executeRequete("REPLACE INTO t_messages 
                              VALUE (NULL, :nom, :email, :message, :sujet :date, :id_utilisateur)",
                                   array(
                                        ':nom' => $_POST['nom'],
                                        ':email' => $_POST['email'],
                                        ':message' =>  $_POST['message'],
                                        ':sujet' =>  $_POST['sujet'],
                                        ':date' => date('Y-m-d H:i:s'),
                                        ':id_utilisateur' => $_POST['id_utilisateur']
                                        ));
       

                                        $message = $_POST['message'] ;
                                        $email = $_POST['email'] ;
                                        $nom = $_POST['nom'] ;
                                        $sujet = $_POST['sujet'] ;
                                        $date = date('Y-m-d H:i:s');
    //    $contenu .= '<div class="alert alert-success" role="alert">Le message à bien été bien enregistrer</div>';

    if ($contenu == '') {
        $contenu .= '<div class="alert alert-info m-auto">Votre requête à bien été prise en compte</div>';
        
        $messages = "$message\r\n$email\r\n$nom\r\n$date";

        // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
        // $messagee = wordwrap($message, 70, "\r\n");

        // Envoi du mail
        // mail('settibelkacem313@gmail.com', 'camarche', $messages); // je dois le activer une fois héberger

    } else {
        $contenu .= '<div class="alert alert-danger">Une erreur de saisie a été détéctée</div>';
    }
    

          
    } //fin du if (empty($alert)){
           
       
    
    // 2 - Affichage du message dans le back-office :
    
    $resultat = $pdo->query("SELECT id_message, nom, message, sujet, email, date FROM t_messages   WHERE id_utilisateur = 1");
    
    
    
        
         // Affichage des autres lignes : 
        
         while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
        
             
            // affichage des inmessages de chaque ligne $ligne :
            $contenu .=  '<div class="card" style="width: 100%;">';
            
                $contenu .= '<div class="card-body">';
                    foreach($ligne as $indice => $valeur){
                        
                        
                        if ($indice != 'id_message' && $indice == 'nom' ){
                            
                            // $contenu .=   '<span class="bg-secondary text-black">'    .  $indice . ': ' . $valeur .' *** ' . '</span>';
                            $contenu .=   '<div class="alert alert-info" role="alert">' . $valeur .'</div>';    
                        }elseif ($indice != 'id_message'){
                            $contenu .=   '<div class="alert alert-success" role="alert">' . $valeur .'</div>';
                        }

                    }
                    if(internauteEstConnecteEtAdmin()){// cette ligne de code concerne uniquement l'administrateur
                        $contenu .='<a href="?id_message='. $ligne['id_message'] .'" class="btn btn-primary" onclick="return(confirm(\'Etes-vous certain de vouloir supprimer ce message ? \' ))"><i class="far fa-trash-alt">&nbsp;&nbsp;Supprimer le message</i></a>';
                    }
                 
                $contenu .= '</div>';
            $contenu .= '</div>';
        }
       

    //------------------------AFFICHAGE---------------------------

require_once 'inc/haut.inc.php';

?>
<div class="container m-auto">
    <!-- <script src="ckeditor/ckeditor.js"></script> -->

      <section class="features-icons mt-5 text-center" style="background-color: #e3f2fd;">
        <div class="m-5"><h1 class = "text-center p-4">Fiche de contact</h1></div>

        <div class=" m-auto"><h3 class="text-center alert alert-secondary ">Contactez-moi ! </h3></div>

    </section>   

    <section class="features-icons m-auto bg-light text-center">

        <div class="row mt-5 mb-4 d-flex ">
            <div class="col-lg-6 col-md-6 col-sm-12 m-auto">
            
                <div class="card m-auto" style="width: 27rem;">
                   
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2623.9022860024365!2d2.4185197159740266!3d48.87913927928956!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66d0c19846e85%3A0xb1780260bf3b093c!2s96+Rue+Romain+Rolland%2C+93260+Les+Lilas!5e0!3m2!1sfr!2sfr!4v1541777980639" width="430vh" height="450vh" frameborder="0" style="border:0" allowfullscreen></iframe>
                    <div class="card-body m-auto">
                        <h5 class="card-title">Mon adresse :</h5>
                        <address>96 rue romainn rolland</address>
                        <address>les lilas 93260</address>
                        <a href="tel:+33762445374" class="btn btn-primary"><i class="fas fa-mobile-alt">&nbsp;&nbsp;777777777</i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12  m-auto">
            <?php echo $contenu; ?>
                <h2 class="alert alert-secondary mt-5 mb-5">Par mail</h2>
                <form method="post" action="<?php echo RACINE_SITE . 'back/gestion_messages.php'; ?>" enctype="multipart/form-data">
                    <div class="form-group m-2">
                        <label for="email">L'email</label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="Votre  email">
                    </div>

                    <div class="form-group m-2">
                        <label for="nom">Le nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Votre  nom">
                    </div>


                    <div class="form-group m-2">
                        <label for="sujet">Le sujet</label>
                        <input type="text" name="sujet" id="sujet" class="form-control" placeholder="Dites moi tout">
                    </div>
                    <div class="form-group m-2">
                        <input type="hidden" name="id_message" id="id_message">
                        <input type="hidden" name="id_utilisateur" id="id_utilisateur" value="1">
                        
                        
                        <label for="message">Dites moi tout</label>
                        <textarea  type="text" class="form-control" name="message" id="message" rows="3" placeholder="Votre message"></textarea>
                            
                    </div>
                    
                    <a href="<?php echo RACINE_SITE . 'back/gestion_messages.php'; ?>"><input type="submit" class="form-control btn-success" id="'.$ligne['id_message'] .'" value="Envoyer"  onclick="return(confirm(\'Etes-vous certain de vouloir enregistrer votre commentaire? \' ))" ></a>
            
                </form>
               
                <div class="mt-5">
                    <?php echo $contenu;?>
                </div>
            </div>
    </section>     
       
    </div>
   

<?php

require_once 'inc/bas.inc.php';








