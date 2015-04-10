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
			<a href="modifier_livraison.php">Modifier une livraison</a><br/>
			<a href="modifier_production.php">Modifier une production</a><br>
			<a href="modifier_verger.php">Modifier un verger</a>
			<?php
		
		}
		else{
		
			echo 'Vous n\'êtes pas connecté. veuillez vous connecter.';
			?> <a href="connexion.php" > Connexion </a><?php
		
		}
		?>		
		</div>
		<div class="mention"></div>
	</body>
</html>