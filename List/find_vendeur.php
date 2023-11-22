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

<table id = "table">
	<tr>
		<th> Nom </th>
	</tr>

	<?php 

	if(!isset($_POST['recherche'])) {
		echo "Who do you want to find ?<br>";
		include("find_form_vendeur.php");
	} else {

		$find = $_POST['recherche'];
		//echo $find;

		require("../db_config.php");

		try {
			$name = "%".$find."%";
			//echo $name;
			$SQL = "SELECT * FROM users WHERE nom LIKE '$name' AND role = 'vendeur'";
			$res = $db->query($SQL);


			if (!$res) {
				echo "Doesn't exist";
			} else {
				foreach ($res as $row) {
					?>
					<tr> 
						<td><a href="list_four.php?uid=<?php echo $row['uid']?>&nom=<?php echo $row['nom']?>"><?php echo $row['nom']." ".$row['prenom'] ?></a></td>
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