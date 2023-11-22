<?php
$page_title = "Ajouter un produit";
include("header.php");
?>

<h1> Ajouter un produit </h1>

<nav>
	<a href="../../index.php"> HOME </a>
	<a href="liste.php"> Produits </a>
	<a href="../commande/liste.php"> Commandes </a>
	
</nav>

<form action="ajoute.php" method="post">

	<table id="table">

		<tr>
			<th>Nom</th>
			<td><input type="text" name="nom" required/></td>
		</tr> 

		<tr>
			<th>Description</th>
			<td><input type="text" name="desp" required/></td>
		</tr> 

		<tr>
			<th>Quantite</th>
			<td><input type="number" name="qte" required/></td>
		</tr>

		<tr>
			<th>Prix</th>
			<td><input type="number" step="0.1" name="prix" required/></td>
		</tr>

		<tr>
			<th>Rayon</th>
			<td><select name = "rayon">
				<?php
				require("../../db_config.php");
				try {

					$SQL = "SELECT * FROM categories";
					$res = $db->query($SQL);

					foreach($res as $row) {
						?>
						<option value="<?php echo $row['nom'] ?>"><?php echo $row['nom'] ?></option>
					<?php } 

					$db=null;
				}

				catch (PDOException $e){
					echo "Erreur SQL: ".$e->getMessage(); 
				}
				?>
			</td>
		</tr>

	</table> 
	<br><br>
	<input type="submit" value="ajouter">
	

</form>



<?php
include("footer.php");
?>