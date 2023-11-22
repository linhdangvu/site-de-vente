<?php
session_start();
$page_title = "Suppression produit"; 
include("header.php");

?>

<nav>
	<a href='../../index.php'> HOME </a>
	<a href="liste.php"> Produits </a>
	<a href="../commande/liste.php"> Commandes </a>
</nav>

<?php
if(isset($_SESSION['role']) && $_SESSION['role'] == 'vendeur' ) {



	if (!isset($_GET["pid"])) { 
		echo "<p>Erreur ko pid</p>";

	}else if (!isset($_POST["supprimer"]) && !isset($_POST["annuler"]) ){ 
		include("del_form.php");

	} else if (isset($_POST["annuler"])){ 
		echo "<p'>Operation annulée.</p>";

	} else {


		$pid = $_GET["pid"];

		try {
			
			require("../../db_config.php");

			$SQL = "DELETE FROM produits WHERE pid = ? "; 
			$st = $db->prepare($SQL);
			$res = $st->execute([$pid]);

			if (!$res) {
				echo "<p>Erreur de suppression.<p>";
			}
			else echo "<p>La suppression a été effectuée.</p>";

			$db=null;
		}
		catch (PDOException $e) {
			echo "Erreur SQL: ".$e->getMessage(); 
		}
	}
	?>

	<?php
} else {
	echo "Erreur to access.<br>";
	echo "<a href='../../index.php'>BACK to HOME</a>";
}
?>

<?php

include("footer.php");
?>