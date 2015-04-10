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
		if(isset($_POST['numlot'], $_POST['quantite'], $_POST['idnoix'], $_POST['codeliv'], $_POST['numcom']))
		{
			$numlot = $_POST['numlot'];
			$quantite = $_POST['quantite'];
			$idnoix = $_POST['idnoix'];
			$codeliv = $_POST['codeliv'];
			$numcom = $_POST['numcom'];
			
			if($req = mysqli_query($base, 'INSERT INTO lotproduction (NumLot, Quantite, IdCalibre, CodeLiv, NumCommande) VALUES ("'.$numlot.'", "'.$quantite.'", "'.$idnoix.'", "'.$codeliv.'", "'.$numcom.'")'))
			{
			
				echo 'Votre production a bien été ajouté';
				header ("Refresh: 1;URL=ajout_production.php");
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
				<form action="ajout_production.php" method="POST">
					<label>Numero de lot : </label><input type="text" name="numlot" required /><br/><br/>
					<label>Quantité : </label><input type="text" name="quantite" required /><br/><br/>
					<label>Id noix : </label><input type="text" name="idnoix" required /><br/><br/>
					<label>Code livraison : </label><input type="text" name="codeliv" required /><br/><br/>
					<label>Numero de commande : </label><input type="text" name="numcom" required /><br/><br/>
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