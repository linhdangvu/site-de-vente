<?php
session_start();

$page_title = 'Liste';
include("header.php");

?>

<?php
if(isset($_SESSION['role']) && $_SESSION['role'] == 'acheteur' ) {
	?>
	<h1>Liste des commandes: </h1>
	<nav>
		<a href='../index.php'> HOME </a> 

	</nav>
	<?php

	try {

		require("../db_config.php");

		
		$uid= $_SESSION['uid'];
		$SQL = "SELECT produits.nom,commande.qte,commande.date,commande.statut FROM commande, produits WHERE commande.pid = produits.pid AND commande.uid = $uid";
		$res = $db->query($SQL);

		?>

		<table id = "table">
			<tr>
				<th>Nom</th>
				<th>Quantite</th>
				<th>Date</th>
				<th>Statut</th>

			</tr>

			<?php
			foreach($res as $row) {
				?>

				<tr>
					<td><?php echo $row['nom'] ?></td>
					<td><?php echo $row['qte'] ?></td>
					<td><?php echo $row['date'] ?></a></td>
					<td><?php echo $row['statut']?></a></td>

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
	echo "Erreur to access. You have to log in.<br>";
	echo "<a href='../index.php'>Back to HOME</a>";
}
?>

<?php
include "footer.php";
?>

