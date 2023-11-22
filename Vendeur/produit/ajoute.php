<?php
session_start();
$page_title="Ajouter un produit"; 
include("header.php");
?>



<?php
if(isset($_SESSION['role']) && $_SESSION['role'] == 'vendeur' ) {

	if (!isset($_POST['nom']) || !isset($_POST['desp']) || !isset($_POST['qte']) || !isset($_POST['prix']) || !isset($_POST['rayon']) ) {
		include("ajoute_form.php"); 
	} 
	else {
		$nom = $_POST['nom']; 
		$desp = $_POST['desp'];
		$qte = $_POST['qte'];
		$prix = $_POST['prix'];
		$rayon = $_POST['rayon'];


		if ($nom == "" || $desp == "" || !is_numeric($qte) || $qte<0 || !is_numeric($prix) || $prix < 0 || $rayon=="") {
			echo "<p>Error. Rajouter</p>";
			include("ajoute_form.php"); 
		} 

		else {

			$test = 0;

			try {

				require("../../db_config.php");

				$SQL = "SELECT * FROM produits";
				$res = $db->query($SQL);

				foreach($res as $row) {
					if ($row['nom'] == $nom) {
						echo "<p>Ce produit déjà existant.<br></p>";
						?>

						<p>Voulez-vous le modifier?</p>
						<a href="mod.php?pid=<?php echo $row['pid']?>">Oui</a>
						<a href="liste.php">Non</a>
						<br>

						<?php

						$test = 1;
					}
				}

				if($test == 0) {

					$SQL1 = "SELECT * FROM categories WHERE nom = '$rayon'";
					$res1 = $db->query($SQL1);


					if (!$res1) {  
						echo "<p>Erreur d’ajout 1.</p>";
					} else {
						foreach ($res1 as $row) {
							
							$ctid = $row['ctid'];
						}
					}



					$SQL = "INSERT INTO produits VALUES (DEFAULT,?,?,?,?,?,?)"; 
					$st = $db->prepare($SQL);
					$res = $st->execute(array($nom,$desp,$qte, $prix,$_SESSION['uid'],$ctid));


					if (!$res) {  
						echo "<p>Erreur d’ajout.</p>";
					}
					else {
						?>
						<nav>
							<a href="../../index.php"> HOME </a>
							<a href="liste.php"> Produits </a>
							<a href="../commande/liste.php"> Commandes </a>
							
						</nav>

						<?php
						echo "L'ajout a été effectué.<br>";
					}
				} 

				$db=null;
			}

			catch (PDOException $e){
				echo "Erreur SQL: ".$e->getMessage(); 
			}
		}}
		?>


		<?php
	} else {
		echo "Erreur to access<br>";
		echo "<a href='../../index.php'>Back to HOME</a>";
	}
	?>

	<?php
	include("footer.php"); 
	?>