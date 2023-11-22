<?php
session_start();
$page_title = 'Panier';
include("header.php");
?>

<nav>
	<a href='../index.php'> HOME </a>
	<a href="Liste.php"> LIST </a>
	<a href="commande.php"> Commande </a>
	<a href="panier.php?pid=<?php echo $_SESSION['pid'] ?>&qte=<?php echo $_SESSION['q'] ?>" > Panier </a>
</nav>

<?php
if(!isset($_SESSION['login'])) {
	?>
	<a href="../Login/login_form.php">Please login to continue buying.</a> <br><br>
	<?php

} else {

	$date = date("Y-m-d h:i:s");
	$qte = $_SESSION['q'];
	$pid = $_SESSION['pid'];
	$uid = $_SESSION['uid'];
	$statut = 'en_cours';

	try {

		require("../db_config.php");

		$SQL = "INSERT INTO commande VALUES (DEFAULT,?,?,?,?,?)"; 
		$st = $db->prepare($SQL);

		$res = $st->execute(array($pid,$uid,$qte,$date,$statut));


		if (!$res) { 
			echo "Erreur de connection.";
		} else {
			echo "Votre commande a ete bien effectuee.";
		}

		$db=null;
	}

	catch (PDOException $e) {
		echo "Erreur SQL: ".$e->getMessage(); 
	}
}
?>



<?php
include "footer.php";
?>

