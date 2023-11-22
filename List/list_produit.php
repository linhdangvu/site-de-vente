<?php 
session_start();
$page_title = "Categories";
include("header.php");
?>


<h1> Liste des produits </h1>

<nav>
		<a href="../index.php">HOME</a>
		<a href="Liste.php">LIST</a>
		<a href="categories.php"> Categories </a> 
		<a href="list_four.php"> Fournisseurs </a> 
		<a href="panier.php?pid=<?php echo $_SESSION['pid'] ?>&qte=<?php echo $_SESSION['q'] ?>" > Panier </a>
	</nav>

<h3> <?php include("find_form.php") ?></h3>

<table id = "table">
	<tr>
		<th> Nom </th>
		<th> Description </th>
		<th> Prix </th>
		<th> Action </th>
	</tr>


	<?php
	require("../db_config.php");
	try {
		
		$SQL = "SELECT * FROM produits";
		$res = $db->query($SQL);

		if ($res->rowCount() == 0) {
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
			
		}
		$db = null;
	}catch (PDOException $e) {
		echo "Erreur SQL: ".$e->getMessage();
	}
	?>
</table>

<?php
include("footer.php");
?>