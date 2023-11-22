<?php 
$page_title = "Recherche";
include("header.php");
?>

<h1> Search </h1>
<nav>
	<a href='../index.php'> HOME </a>
	<a href="Liste.php"> LIST </a>
	<a href="commande.php"> Commande </a>

</nav>
<br>

<table id = "table">
	<tr>
		<th> Nom </th>
		<th> Description </th>
		<th> Prix </th>
		<th> Action </th>
	</tr>

	<?php 

	if(!isset($_POST['recherche'])) {
		echo "What do you want to find ?<br>";
		include("find_form.php");
	} else {

		$find = $_POST['recherche'];
		//echo $find;

		require("../db_config.php");

		try {
			$name = "%".$find."%";
			//echo $name;
			$SQL = "SELECT * FROM produits WHERE nom LIKE '$name'";
			$res = $db->query($SQL);


			if (!$res) {
				echo "Doesn't exist";
			} else {
				foreach ($res as $row) {
					?>
					<tr>
						<td><?php echo htmlspecialchars($row['nom'])?></td> 
						<td><?php echo $row['description']?></td>
						<td><?php echo $row['prix']?></td>
						<?php $_SESSION['q'] = 1; ?>
						<td> <a href="panier.php?pid=<?php echo $row['pid']?>&prix=<?php echo $row['prix'] ?>">Ajouter au panier</a> </td>

					</tr>

					<?php
				}
			}

			$db = null;
		}catch (PDOException $e){
			echo "Erreur SQL: ".$e->getMessage(); 
		}

	}

	?>
</table>


<?php
include("footer.php");
?>