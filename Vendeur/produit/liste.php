<?php
session_start();
$page_title = 'Liste des produits';
include("header.php");
?>


<?php 
if(isset($_SESSION['role']) && $_SESSION['role'] == 'vendeur') {
	?>

	<h1> Liste des produits </h1>

	<nav>
		<a href='../../index.php'> HOME </a> 
		<a href="liste.php"> Produits </a>
		<a href="../commande/liste.php"> Commandes </a>
		<a href = "ajoute_form.php"> Ajouter </a>


	</nav>
	<br>
	

	<?php
	require("../../db_config.php");
	try {

		if (isset($_GET['ctid']) && isset($_GET['nom'])) {
			echo "<h1>".$_GET['nom']."</h1>";
			$ct = $_GET['ctid'];
			$uid = $_SESSION['uid'];
			$SQL = "SELECT * FROM produits WHERE ctid = $ct AND uid = $uid";
			$res = $db->query($SQL);

			?>
			<table id="table">
				<tr>
					<th> Nom </th>
					<th> Description </th>
					<th> Quantite </th>
					<th> Prix </th>
					<th> Action </th>
				</tr>

				<?php
				if (!$res) {
					echo "La liste est vide";
				} else {

					foreach ($res as $row) {
						?>
						<tr>
							<td><?php echo htmlspecialchars($row['nom'])?></td> 
							<td><?php echo $row['description']?></td>
							<td><?php echo $row['qte']?></td>
							<td><?php echo $row['prix']?></td>
							<td><a href="del.php?pid=<?php echo $row['pid']?>">Delete</a>/<a href="mod.php?pid=<?php echo $row['pid']?>">Modifier</td>

							</tr>

							<?php
						}
						echo "</table>";

					}
				} else { 


					$SQL = "SELECT * FROM categories "; 
					$res = $db->query($SQL);
					?>


					<?php
					foreach($res as $row) {
						?>


						<nav id="nav1">

							<a href="liste.php?ctid=<?php echo $row['ctid']?>&nom=<?php echo $row['nom']?>"><?php echo $row['nom'] ?></a>


						</nav>


					<?php } ?>


					<?php
				}

				$db = null;
			}catch (PDOException $e) {
				echo "Erreur SQL: ".$e->getMessage();
			}
		} else {
			echo "You don't have droit to access<br>";
			echo "<p> Back to </p><a href='../../index.php'>HOME</a>";
		}
		?>
	</table>

	<?php
	include "footer.php";
	?>

