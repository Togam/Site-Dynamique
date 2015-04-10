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
		if(!empty($_GET['id']))
		{
			$id = $_GET['id'];
			$provenance = $_POST['provenance'];
			$date = $_POST['date'];
			$type = $_POST['type'];
			$quantite = $_POST['quantite'];
			
			 if($request = mysqli_query($base, 'UPDATE livraison SET ProvNoix="'.$provenance.'", Date="'.$date.'", Type="'.$type.'", Quantite="'.$quantite.'" where CodeLiv="'.$id.'"'))
			 {
				
				echo 'Vos modification on bien été pris en compte';	
				header ("Refresh: 1;URL=Modifier.php");
			 
			 }
			 else
			 {
				echo 'Probleme mise a jour de la livraison';			 
			 }
		}
		else
		{
			
		if(isset($_POST['code']))
		{
			$code = $_POST['code'];
			
			if($req = mysqli_query($base, 'SELECT * FROM livraison WHERE CodeLiv="'.$code.'"'))
			{
				if(mysqli_num_rows($req)>0)
				{
					$dn = mysqli_fetch_array($req);
					{
						$id = $dn['CodeLiv'];
						$provenance = $dn['ProvNoix'];
						$date = $dn['Date'];
						$type = $dn['Type'];
						$quantite = $dn['Quantite'];
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
				<a href="modifier_livraison.php"> Retour </a><br/><br/>
							<form action="modifier_livraison.php?id=<?php echo $id;?>" method="POST">
								<label>Provenance des noix : </label><input type="text" name="provenance" value="<?php echo $provenance; ?>"/><br/><br/>
								<label>Date de livraison : </label><input type="text" name="date" placeholder="AAAA-MM-JJ" value="<?php echo $date; ?>"/><br/><br/>
								<label>Type de produit : </label><input type="text" name="type" value="<?php echo $type; ?>"/><br/><br/>
								<label>Quantité livré : </label><input type="text" name="quantite" value="<?php echo $quantite; ?>"/><br/><br/>
								<input type="submit" value="ENVOYER" />
							</form>	
							
				<?php
			
			}
			else
			{
			
				echo 'Vous n\'êtes pas connecté. veuillez vous connecter.';
				?> <a href="connexion.php" > Connexion </a><?php
			
			}
			?>		
			</div>		
						<div class="mention"></div>					 
						 <?php
					 }
				}
				else{
				
					echo 'aucune commande pour ce code';
				
				}
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
							<a href="#">Supprimer</a>
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
				<form action="modifier_livraison.php" method="POST">
					<label>Code de livraison : </label><input type="text" name="code" />
					<input type="submit" value="ENVOYER" />
				</form>
				<?php
			
			}
			else
			{
			
				echo 'Vous n\'êtes pas connecté. veuillez vous connecter.';
				?> <a href="connexion.php" > Connexion </a><?php
			
			}
			?>		
			</div>
			<div class="mention"></div>
			<?php
		}
		}
		?>
	</body>
</html>