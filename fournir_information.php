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
		if(isset($_POST['numprod'], $_POST['nomsociete'], $_POST['adressesociete'], $_POST['nomresp'], $_POST['prenomresp']))
		{
			$numlot = $_POST['numprod'];
			$quantite = $_POST['nomsociete'];
			$idnoix = $_POST['adressesociete'];
			$codeliv = $_POST['nomresp'];
			$numcom = $_POST['prenomresp'];
			
			$choix = $_POST['choix'];
			$dateadhe = $_POST['dateadhe'];
			$certification = $_POST['certification'];
			$dateobte = $_POST['dateobte'];
			
			if($req = mysqli_query($base, 'INSERT INTO producteur (NumProducteur, NomSociete, AdresseSociete, NomRespProd, PrenomRespProd) VALUES ("'.$numlot.'", "'.$quantite.'", "'.$idnoix.'", "'.$codeliv.'", "'.$numcom.'")'))
			{	
				if($_POST['choix'] == "oui")
				{
					if($req2 = mysqli_query($base, 'INSERT INTO adherent (DateAdhesion, DateObtention, Certification, NumProducteur) VALUES ("'.$dateadhe.'", "'.$dateobte.'", "'.$certification.'", "'.$numlot.'" )'))
					{
						echo 'les informations producteur et adherent ont bien été ajouté';
						header ("Refresh: 1;URL=fournir_information.php");
					}
					else
					{
						echo "erreur !";
					}
				}
				elseif($_POST['choix'] == "non")
				{
					echo 'les informations producteur ont bien été ajouté';
					header ("Refresh: 1;URL=fournir_information.php");
				}
				else
				{
					echo "erreur !";
				}
			}
			else{
				echo "erreur !";
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
				<form action="fournir_information.php" method="POST">
					<label>Numero : </label><input type="text" name="numprod" required /><br/><br/>
					<label>Nom de la société : </label><input type="text" name="nomsociete" required /><br/><br/>
					<label>Adresse de la société : </label><input type="text" name="adressesociete" required /><br/><br/>
					<label>Nom du responsable de production : </label><input type="text" name="nomresp" required /><br/><br/>
					<label>Prenom du responsable de prodution : </label><input type="text" name="prenomresp" required /><br/><br/>
					<h3>ADHERENT</h3>
					<input type="radio" name="choix"  value="oui" /><label>Oui</label><br><br>
					<label>Date d'adhesion : </label><input type="text" name="dateadhe" placeholder="AAAA-MM-JJ" /><br/><br/>
					<label>Certification : </label><input type="text" name="certification" /><br/><br/>
					<label>Date d'obtention : </label><input type="text" name="dateobte" placeholder="AAAA-MM-JJ" /><br/><br/>
					<input type="radio" name="choix" value="non" checked/><label>Non</label><br><br>
					<br><input type="submit" value="ENVOYER" />
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