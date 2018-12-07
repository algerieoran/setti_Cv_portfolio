<?php require_once 'back/inc/init.inc.php'; // connexion PDO

if (isset($_POST['nom'])) {
	$nom=addslashes($_POST['nom']);
	$email=addslashes($_POST['email']);
	$message=addslashes($_POST['message']);
	
//	insertion dans la BDD
	$pdoCV->exec(" INSERT INTO t_messages VALUES (NULL, '$nom', '$email', '$message') ");
	
//pour faire le courriel on commence par l'en-tête du courriel
		$entete ="From: page patrick isola <settibelkacem313@gmail.com>\r\n"; 
		$entete.="Reply-To: settibelkacem313@gmail.com\r\n";
		$entete.="MIME-version: 1.0\r\n";
		$entete.="Content-Type: text/html; charset=\"UTF-8\""."\n"; //utf 8 pour avoir les accents
		$entete.="Content-Transfer-Encoding: 8bit";
	
//	l'en-tête est terminé on fabrique le corps de l'email	
		$corps ='Nouveau message de '.$nom.'';//ouverture de la construction du message
		$corps.="<br>Nom : <strong>".$nom.'</strong><br>' ;
		$corps.="Courriel : <em>".$email.'</em><br>';
		$corps.="Message. : ".$message.'<br>';//fermeture du corps du message
	
	mail('settibelkacem313@gmail.com','Message depuis mon site web de : '.$nom, $corps, $entete);//on fait un courriel avec le nom du client dans l'objet
	
		$pourvisiteur='Bonjour <br> Merci de votre message !<br>';
		$pourvisiteur.='Je vous contacte dans les meilleurs délais<br> A bientôt !';
		$pourvisiteur.='<br><a href=\"http://www.settibelkacem.com\">www.settibelkacem.com</a>';
	
	mail($email,'Depuis le site www.settibelkacem', $pourvisiteur, $entete);

	}
	header("location: index.php");
			exit();

?>