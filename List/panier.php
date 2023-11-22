<?php
session_start();
$page_title = 'Panier';
include("header.php");
?>

<h1> Liste des produits </h1>

<nav>
	<a href='../index.php'> HOME </a> 
	<a href="Liste.php">LIST</a>
	<a href="panier.php"> Panier </a>

</nav>

<h2> Panier : </h2>

<table id = "table">
	<tr>
		<th> Nom </th>
		<th> Description </th>
		<th> Prix/unite </th>
		<th> Quantite </th>
		<th> Prix total </th>
		<th> Action </th>
	</tr>

	<?php
	

	if (isset($_GET['pid'])) {
		$_SESSION['pid'] = $_GET['pid'];
	}

	$pid = $_SESSION['pid'];

		require("../db_config.php");
		try {
			
			$SQL = "SELECT * FROM produits WHERE pid = $pid"; 
			$st = $db->prepare($SQL);
			$st->execute();

			$res = $st->fetchAll(PDO::FETCH_ASSOC);

			foreach ($res as $row) {
				?>
				<tr>
					<td><?php echo $row['nom']?></td> 
					<td><?php echo $row['description']?></td>
					<td><?php echo $row['prix']?></td>
					<td>
						<?php
						if(isset($_POST['qute']) && $_POST['qute'] <= $row['qte'] && $_POST['qute'] > 0) {
							$_SESSION['q'] = $_POST['qute'];
						} else {
							$_SESSION['q'] = 1;
						}
						echo $_SESSION['q'];
						?>
					</td>
					<td><?php echo $row['prix']*$_SESSION['q'] ?></td>
					<td><a href = "aj_commande.php">Commande</a></td>
				</tr>
				<?php
			}
			$db = null;
		} catch (PDOException $e) {
			echo "Erreur SQL: ".$e->getMessage(); 
		}
	
	?>
</table>

<form method="POST">
	<br><br>
	How many do you want ? <br>
	Quantite : 
	<input type="number" name="qute">
	<input type="submit" value="Ajouter">
</form>


<?php
include "footer.php";
?>

