<?php 
session_start();
$page_title = "Liste par vendeur";
include("header.php");
?>
<div id="cate">
	<h1> Liste par vendeur </h1>

	<nav>
		<a href="../index.php">HOME</a>
		<a href="Liste.php">LIST</a>
		<a href="categories.php"> Categories </a> 
		<a href="list_produit.php"> Produits </a> 
	</nav>

	<?php if (isset($_GET['pid']) || isset($_GET['nom'])) {
		?> 
		<h3> <?php include ("find_form.php") ?></h3>
	<?php } else { ?>
		<h3> <?php include ("find_form_vendeur.php") ?></h3>
	<?php } ?>
	<?php 	
	require("../db_config.php");
	try {

		if (isset($_GET['uid']) && isset($_GET['nom'])) {
			echo $_GET['nom'];
			$uid = $_GET['uid'];
			$SQL = "SELECT * FROM produits WHERE uid = $uid";
			$res = $db->query($SQL);

			?>
			<table id = "table">
				<tr>
					<th> Nom </th>
					<th> Description </th>
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
							<td><?php echo $row['prix']?></td>
							<?php $_SESSION['q'] = 1; ?>
							<td> <a href="panier.php?pid=<?php echo $row['pid']?>">Ajouter au panier</a> </td>

						</tr>

						<?php
					}
					echo "</table>";

				}
			} else { 


				$SQL = "SELECT * FROM users WHERE role = 'vendeur' "; 
				$res = $db->query($SQL);
				?>
				<table id = "table">
					<tr>
						<th> Nom et Prenom </th>
					</tr>

					<?php
					foreach($res as $row) {
						?>

						<tr>

							<td><a href="list_four.php?uid=<?php echo $row['uid']?>&nom=<?php echo $row['nom']?>"><?php echo $row['nom']." ".$row['prenom'] ?></a></td>


						</tr>


					<?php } ?>
				</table>

				<?php
			}
			$db = null;
		} catch (PDOException $e) {
			echo "Erreur SQL: ".$e->getMessage(); 
		}
		?>


	</div>

	
	<?php
	include("footer.php");
	?>