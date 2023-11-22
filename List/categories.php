<?php 
session_start();
$page_title = "Categories";
include("header.php");
?>
<div id="cate">
	<h1> Categories </h1>

	<nav>
		<a href="../index.php">HOME</a>
		<a href="Liste.php">LIST</a>
		<a href="list_produit.php"> Produits </a> 
		<a href="list_four.php"> Fournisseurs </a> 
	</nav>



	<?php 	

 if (isset($_GET['pid']) || isset($_GET['nom'])) {
		?> 
		<h3> <?php include ("find_form.php") ?></h3>
	<?php } else { ?>
		<h3> <?php include ("find_form_cate.php") ?></h3>
	<?php } 

	require("../db_config.php");
	try {
		
		if (isset($_GET['ctid']) && isset($_GET['nom'])) {
			echo $_GET['nom']."<br>";
			$ct = $_GET['ctid'];
			$SQL = "SELECT * FROM produits WHERE ctid = $ct";
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


				$SQL = "SELECT * FROM categories "; 
				$res = $db->query($SQL);
				?>


				<?php
				foreach($res as $row) {
					?>

					<nav id="nav1">

						<a href="categories.php?ctid=<?php echo $row['ctid']?>&nom=<?php echo $row['nom']?>"><?php echo $row['nom'] ?></a>


					</nav>


				<?php } ?>
				

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