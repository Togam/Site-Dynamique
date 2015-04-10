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
		if(isset($_POST['num_s'], $_POST['nom_s'], $_POST['adresse_s'], $_POST['nom_resp'], $_POST['prenom_resp']))
		{
			$num_s = $_POST['num_s'];
			$nom_s = $_POST['nom_s'];
			$adresse_s = $_POST['adresse_s'];
			$nom_resp = $_POST['nom_resp'];
			$prenom_resp = $_POST['prenom_resp'];
			
			if($req = mysqli_query($base, 'INSERT INTO association (Numero, NomSociete, AdresseSociete, NomResp, PrenomResp) VALUES ("'.$num_s.'", "'.$nom_s.'", "'.$adresse_s.'", "'.$nom_resp.'", "'.$prenom_resp.'")'))
			{
			
				echo 'Vous avez associé un verger';
				header ("Refresh: 1;URL=associer_verger.php");
			}
			
		}
		else
		{	
			?>
			<div class="conteneur">
			<div class="banniere"></div>
			<?php
			if(isset($_SESSION['status']))
			{
				echo 'vous est connecté en tant que '.$_SESSION['status']; ?> <a href="connexion.php"> Se deconnecter </a><br/><br/><?php
					
				if($_SESSION['status'] == 'Producteur')
				{
					?>
					
					<div class="menu">
						<div class="barremenu1">
							<a href="consulter_producteur.php">Consulter l'ensemble de son profil</a>
						</div>
						<div class="barremenu">	
							<a href="ajout.php">Ajouter</a>
							<a href="modifier.php">Modifier</a>
							<a href="supprimer.php">Supprimer</a>
							<a href="fournir_information.php">Fournir informations</a>
							<a href="connexion.php">Se deconnecter</a>
						</div>
					</div>
					<?php							
				}
				elseif($_SESSION['status'] == 'Agrur')
				{
					?>
					<div class="menu">
						<ul>
							<li><a href="#">Consulter les informations d'une société</a></li>
							<li><a href="#">Donner les autorisations à une société</a></li>
							<li><a href="#">Afficher les commandes</a></li>
							<li><a href="#">Ajouter un bon de commande</a></li>
							<li><a href="#">Modifier un bon de commande</a></li>
							<li><a href="#">Supprimer un bon de commande</a></li>
						</ul>
					</div>
					<?php										 
				}
				else
				{
				
					echo 'probleme de status';
				
				}
				?>
				<br/><br/> 
				<form action="associer_verger.php" method="POST">
					<label>Numero : </label><input type="text" name="num_s" required /><br/><br/>
					<label>Nom de la société : </label><input type="text" name="nom_s" required /><br/><br/>
					<label>Adresse de la société : </label><input type="text" name="adresse_s" required /><br/><br/>
					<label>Nom du responsable de production : </label><input type="text" name="nom_resp" required /><br/><br/>
					<label>Prenom du responsable de production : </label><input type="text" name="prenom_resp" required /><br/><br/>
					<input type="submit" value="ENVOYER" />
				</form>
				<?php
			
			}
			else{
			
				echo 'Vous n\'êtes pas connecté. veuillez vous connecter.';
				?> <a href="connexion.php" > Connexion </a><?php
			
			}
			?>		
			</div>
			<div class="mention"></div>
			<?php
		}
		?>
	</body>
</html>