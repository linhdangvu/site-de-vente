<?php
session_start();
$page_title="Modification"; 
include("header.php");

?>

<nav>
	<a href='../../index.php'> HOME </a> 
	<a href="liste.php"> Produits </a> 
	<a href="../commande/liste.php"> Commandes </a>

</nav>

<div id="container">
	<?php
	if(isset($_SESSION['role']) && $_SESSION['role'] == 'vendeur' ) {
		if (!isset($_GET["pid"])) {
			echo "<p>Erreur<p>\n";

		} else {
			$test = 0;
			$pid = $_GET["pid"];

			try {

				require("../../db_config.php");

				$SQL = "SELECT * FROM produits WHERE pid = ?";
				$st = $db->prepare($SQL);
				$res = $st->execute(array($pid));

				if ($st->rowCount() == 0) {
					echo "<p>Erreur de pid</p>\n";

				} else if (!isset($_POST['nom']) || !isset($_POST['desp']) || !isset($_POST['qte']) || !isset($_POST['prix']) ) {
					include("mod_form.php"); 

				} else {  
					$nom = $_POST['nom'];
					$desp = $_POST['desp'];
					$qte = $_POST['qte']; 
					$prix=  $_POST['prix']; 

					if ($nom=="" || !is_numeric($qte) || $qte<0 || !is_numeric($prix) || $prix<0) {
						include("mod_form.php");   

					} else {

						$SQL = "SELECT * FROM produits";
						$res = $db->query($SQL);

						foreach($res as $row) {
							if ($row['nom'] == $nom) {
								echo "<p>Ce produit déjà existant.</p>";
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

							$SQL ="UPDATE produits SET nom=?, description=?, qte=?, prix=? WHERE pid=? ";
							$st = $db->prepare($SQL);
							$res = $st->execute(array($nom, $desp, $qte, $prix, $pid));

							if (!$res) {
								echo "<p>Erreur de modification</p>";
							} else  echo "<p>La modification a été effectuée</p>";
						}
					}

					$db=null;
				}
			} catch (PDOException $e) {
				echo "Erreur SQL: ".$e->getMessage();
			}
		}
		?>

		<?php
	} else {
		echo "Erreur to access.<br>";
		echo "<a href='../../index.php'>Back to HOME</a> ";
	}
	?>
</div>

<?php
include("footer.php");
?>





