<?php
	include('config.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Accueil Agrur</title>
		<meta charset="UTF-8" />
		<link href="style.css" rel="stylesheet" type="text/css" />
	</head>
	
	<body>
		<?php
		//Si lutilisateur est connecte, on le deconecte
		if(isset($_SESSION['status']))
		{
			//On le deconecte en supprimant simplement les sessions status et userid
			unset($_SESSION['status'], $_SESSION['userid']);
			?><div class="message">Vous avez bien été déconnecté.<br /><a href="index.php"> Accueil</a></div><br/>
			<?php header ("Refresh: 1;URL=index.php");
		}
		else
		{
		//on verifie que le formulaire a bien été envoyer
		if(isset($_POST['Status'], $_POST['MotDePasse']))
		{
            // on stock les données dans des variables      
            $status = $_POST['Status'];
            $password = $_POST['MotDePasse'];						
           
            //On recupere le mot de passe de lutilisateur
           if($req = mysqli_query($base, 'SELECT Id,Status,MotDePasse FROM utilisateurs WHERE Status="'.$status.'"'))
		   {
			   $dn = mysqli_fetch_array($req);
			
				//On le compare a celui quil a entre 
				if($dn['MotDePasse'] == $password)
				{
					//Si le mot de passe es bon, on ne vas pas afficher le formulaire
					$form = false;
					//On enregistre son pseudo dans la session username et son identifiant dans la session userid
					$_SESSION['status'] = $_POST['Status'];
					$_SESSION['userid'] = $dn['Id'];
					
					?><div class="message">Vous avez bien été connecté Vous pouvez accéder à votre menu.<br /> <a href="index.php">Accueil</a></div><br/>
					<?php header ("Refresh: 1;URL=index.php");
				}
				else
				{
					//Sinon, on indique que la combinaison nest pas bonne
					$form = true;
					$message = 'La combinaison que vous avez entré n\'est pas bonne.';
				}
		   }
		   else{
			   echo "erreur connexion";
		   }
            
		}
		else
		{
			$form = true;
		}
        if($form)
        {
            //On affiche un message sil y a lieu
			if(isset($message))
			{
                echo '<div class="message">'.$message.'</div>';
			}
			//On affiche le formulaire
			?>
			<div class="content">
				<form action="connexion.php" method="post"><br/>
					<center><h2>Veuillez entrer vos identifiants pour vous connecter :</h2></center><br /><br/>
					<div class="center">
						<label for="username">Nom d'utilisateur :</label><input type="text" name="Status" required /><br />
						<label for="password">Mot de passe :</label><input type="password" name="MotDePasse" required /><br />
						<input type="submit" value="Se connecter" style="cursor: pointer" />
					</div>
				</form>
			</div>
			<?php
        }
		}
		?>
	</body>
</html>



