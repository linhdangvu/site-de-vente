<?php
session_start();

$page_title = 'Liste';
include("header.php");

?>

	<?php
	if(isset($_SESSION['role']) && $_SESSION['role'] == 'vendeur' ) {
		?>
		<h1>Liste des commandes: </h1>

		<nav>
			<a href='../../index.php'> HOME </a> 
			<a href="../produit/liste.php"> Produits </a>
		</nav>

		<?php

		try {

			require("../../db_config.php");

			if (isset($_GET['cmdida'])) {
				$cmdida = $_GET['cmdida'];
				$pid = $_GET['pid'];

				//echo $pid;
				$SQL1 = "SELECT * FROM produits WHERE pid = $pid";
				$res1 = $db->query($SQL1);
				foreach($res1 as $row) {
					//echo $row['qte'];
					$q_total = $row['qte'];
					//echo $q_total;
				}

				$SQL2 = "SELECT * FROM commande WHERE cmdid = $cmdida";
				$res2 = $db->query($SQL2);
				foreach($res2 as $row) {
					$q = $row['qte'];
					//echo $q;
				}


				$SQL3 = "UPDATE produits SET qte =? WHERE pid = ?";
				$st3 = $db->prepare($SQL3);
				$new_qte = $q_total - $q;
				//echo $new_qte;
				$res3 = $st3->execute(array($new_qte, $pid));

				$SQL = "UPDATE commande SET statut=? WHERE cmdid = ?";
				$st = $db->prepare($SQL);
				$res = $st->execute(array('acceptee',$cmdida));
			} 
			if (isset($_GET['cmdidr'])) {
				$cmdidr = $_GET['cmdidr'];
				$SQL = "UPDATE commande SET statut=? WHERE cmdid = ?";
				$st = $db->prepare($SQL);
				$res = $st->execute(array('refusee',$cmdidr));
			} 

			
			$uid = $_SESSION['uid'];
			$SQL = "SELECT produits.nom,commande.qte,commande.date,commande.statut,produits.pid,commande.pid,commande.cmdid FROM commande, produits WHERE commande.pid = produits.pid AND produits.uid = $uid";
			$res = $db->query($SQL);
			
			?>

			<table id="table">
				<tr>
					<th>Nom</th>
					<th>Quantite</th>
					<th>Date</th>
					<th>Statut</th>
					<th>Action</th>
				</tr>

				<?php
				foreach($res as $row) {
					?>

					<tr>
						<td><?php echo $row['nom'] ?></td>
						<td><?php echo $row['qte'] ?></td>
						<td><?php echo $row['date'] ?></td>
						<td><?php echo $row['statut'] ?></td>
						<td>
							<?php 
							if($row['statut'] == 'en_cours') { 
								?>
								<a href="liste.php?cmdida=<?php echo $row['cmdid'] ?>&pid=<?php echo $row['pid'] ?>">Accept</a>
								/
								<a href="liste.php?cmdidr=<?php echo $row['cmdid'] ?>&pid=<?php echo $row['pid'] ?>">Refuse</a> 
								<?php 
							} else { 
								echo 'Done'; 
							}
							?>
						</td>
					</tr>
					

				<?php } ?>
			</table>
			

			<?php

			$db = null; 
		}

		catch (PDOException $e) {
			echo "Erreur SQL: ".$e->getMessage(); 
		}
	} else {
		echo "Erreur to access.<br>";
		echo "<a href='../../index.php'>Back to HOME</a>";
	}
	?>

<?php
include "footer.php";
?>

