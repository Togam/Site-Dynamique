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
		if(isset($_POST['num_livraison']))
		{
			$num_livraison = $_POST['num_livraison'];
			
			$verif = mysqli_query($base, 'SELECT CodeLiv FROM livraison WHERE CodeLiv="'.$num_livraison.'"');
			
				if(mysqli_num_rows($verif) == 1)
				{		
					if($req = mysqli_query($base, 'DELETE FROM livraison where CodeLiv="'.$num_livraison.'"'))
					{
						echo 'Votre livraison a bien été supprimé';
						header ("Refresh: 1;URL=supprimer_livraison.php");
					}
					else
					{
						echo "erreur lors de la suppression";
					}
				}
				else{
					echo "la livraison n'existe pas";
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
				<form action="supprimer_livraison.php" method="POST">
					<label>Numero de livraison : </label><input type="text" name="num_livraison" required /><br/><br/>
					<input type="submit" value="Supprimer" />
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