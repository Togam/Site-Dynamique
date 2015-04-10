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
			$codeVerger = $_GET['id'];
			$SuperficiePlantee = $_POST['SuperficiePlantee'];
			$NbArbesHectare = $_POST['NbArbesHectare'];
			$LibelleVar = $_POST['LibelleVar'];
			$CodeCom = $_POST['CodeCom'];
			$NomProducteur = $_POST['NomProducteur'];
			
			 if($request = mysqli_query($base, 'UPDATE verger SET CodeVerger="'.$codeVerger.'", SuperficiePlantee="'.$SuperficiePlantee.'", NbArbesHectare="'.$NbArbesHectare.'", LibelleVar="'.$LibelleVar.'", CodeCom="'.$CodeCom.'", NomProducteur="'.$NomProducteur.'" where CodeVerger="'.$codeVerger.'"'))
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
			if(isset($_POST['numverger']))
			{
				$numverger = $_POST['numverger'];
				
				if($req = mysqli_query($base, 'SELECT * FROM verger WHERE CodeVerger="'.$numverger.'"'))
				{
					if(mysqli_num_rows($req)>0)
					{
						$dn = mysqli_fetch_array($req);
						{
							$codeVerger = $dn['CodeVerger'];
							$SuperficiePlantee = $dn['SuperficiePlantee'];
							$NbArbesHectare = $dn['NbArbesHectare'];
							$LibelleVar = $dn['LibelleVar'];
							$CodeCom = $dn['CodeCom'];
							$NomProducteur = $dn['NomProducteur'];
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
								<a href="modifier_verger.php"> Retour </a><br/><br/>
											<form action="modifier_verger.php?id=<?php echo $codeVerger;?>" method="POST">												
												<label>Code du verger : </label><input type="text" name="codeVerger" value="<?php echo $codeVerger; ?>" required /><br/><br/>
												<label>Superficie : </label><input type="text" name="SuperficiePlantee" value="<?php echo $SuperficiePlantee; ?>" required /><br/><br/>
												<label>Nombre d'arbres : </label><input type="text" name="NbArbesHectare" value="<?php echo $NbArbesHectare; ?>" required /><br/><br/>
												<label>Libellé de la variété : </label><input type="text" name="LibelleVar" value="<?php echo $LibelleVar; ?>" required /><br/><br/>
												<label>Code de la commune : </label><input type="text" name="CodeCom" value="<?php echo $CodeCom; ?>" required /><br/><br/>
												<label>Nom du producteur : </label><input type="text" name="NomProducteur" value="<?php echo $NomProducteur; ?>" required /><br/><br/>
					
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
					
						echo 'aucun verger pour ce numero';
					
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
					<form action="modifier_verger.php" method="POST">
						<label>Numero du verger  : </label><input type="text" name="numverger" />
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