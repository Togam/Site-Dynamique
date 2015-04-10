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
		if(isset($_POST['num_producteur']))
		{
			$NumProducteur = $_POST['num_producteur'];
			
			if($req = mysqli_query($base, 'SELECT * FROM producteur WHERE NumProducteur="'.$NumProducteur.'"'))
			{
				if(mysqli_num_rows($req)>0)
				{
					$dn = mysqli_fetch_array($req);
					{
						$id = $dn['NumProducteur'];
						$NomSociete = $dn['NomSociete'];
						$AdresseSociete = $dn['AdresseSociete'];
						$NomRespProd = $dn['NomRespProd'];
						$PrenomRespProd = $dn['PrenomRespProd'];
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
								<form action="consulter_producteur.php" method="POST">
									<label>Numero : </label><input type="text" name="num_producteur" value="<?php echo $id; ?>" /><br><br>
									<input type="submit" value="Afficher" />
								</form>
										<br><br>
											<label>Nom de la société : </label><input type="text" value="<?php echo $NomSociete; ?>"/><br/><br/>
											<label>Adresse de la société : </label><input type="text" value="<?php echo $AdresseSociete; ?>"/><br/><br/>
											<label>Nom du responsable de production : </label><input type="text" value="<?php echo $NomRespProd ; ?>"/><br/><br/>
											<label>Prenom du responsable de production : </label><input type="text" value="<?php echo $PrenomRespProd; ?>"/><br/><br/>		

										
									<h2>VERGER</h2>
									
									<table>
									<tr>
										<th>
											Code
										</th>
										<th>
											Superficie
										</th>
										<th>
											Nombre d'arbre
										</th>
										<th>
											Variété
										</th>
										<th>
											Code Commande
										</th>
									</tr>
									<?php 
									$verger = mysqli_query($base, 'SELECT * FROM verger where NumProducteur="'.$id.'"');
									
									while($dnn = mysqli_fetch_array($verger))
									{
										?>
										<tr>
											<td>
												<?php echo $dnn['CodeVerger']; ?>
											</td>	
											<td>
												<?php echo $dnn['SuperficiePlantee']; ?>
											</td>
											<td>
												<?php echo $dnn['NbArbesHectare']; ?>
											</td>	
											<td>
												<?php echo $dnn['LibelleVar']; ?>
											</td>
											<td>
												<?php echo $dnn['CodeCom']; ?>
											</td>
										</tr>
										<?php
									}
									?>
									</table>
									
									<h2>LOT DE PRODUCTION</h2>
									
									<table>
									<tr>
										<th>
											Numéro du lot 
										</th>
										<th>
											Quantité
										</th>
										<th>
											Id noix
										</th>
										<th>
											Code livraison
										</th>
									</tr>
									<?php 
									$verger = mysqli_query($base, 'SELECT * FROM lotproduction where NumProducteur="'.$id.'"');
									
									while($dnn = mysqli_fetch_array($verger))
									{
										?>
										<tr>
											<td>
												<?php echo $dnn['NumLot']; ?>
											</td>	
											<td>
												<?php echo $dnn['Quantite']; ?>
											</td>
											<td>
												<?php echo $dnn['IdCalibre']; ?>
											</td>	
											<td>
												<?php echo $dnn['CodeLiv']; ?>
											</td>
										</tr>
										<?php
									}
									?>
									</table>
									
									<h2>LIVRAISON</h2>
									
									<table>
									<tr>
										<th>
											Code
										</th>
										<th>
											Date de livraison
										</th>
										<th>
											Provenance noix
										</th>
										<th>
											Type noix
										</th>
										<th>
											Quantité
										</th>
										<th>
											Numero lot
										</th>
										<th>
											Numero commande
										</th>
									</tr>
									<?php 
									$verger = mysqli_query($base, 'SELECT * FROM livraison where NumProducteur="'.$id.'"');
									
									while($dnn = mysqli_fetch_array($verger))
									{
										?>
										<tr>
											<td>
												<?php echo $dnn['CodeLiv']; ?>
											</td>	
											<td>
												<?php echo $dnn['Date']; ?>
											</td>
											<td>
												<?php echo $dnn['ProvNoix']; ?>
											</td>	
											<td>
												<?php echo $dnn['Type']; ?>
											</td>
											<td>
												<?php echo $dnn['Quantite']; ?>
											</td>
											<td>
												<?php echo $dnn['NumLot']; ?>
											</td>
											<td>
												<?php echo $dnn['NumCommande']; ?>
											</td>
										</tr>
										<?php
									}
									?>
									</table>
									
									
									<br/><br/>	<a href="index.php"> Retour </a><br/>
									
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
				<form action="consulter_producteur.php" method="POST">
					<label>Numero : </label><input type="text" name="num_producteur" /><br><br>
					<input type="submit" value="Afficher" />
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
		?>
	</body>
</html>