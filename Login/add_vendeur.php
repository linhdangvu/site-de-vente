<?php
$page_title = "Add account";

include("header.php");

?>


<?php

if(!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['login']) || !isset($_POST['pass']) || empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['login']) || empty($_POST['pass'])) {
	echo "<p>Information invalide.</p>";
	include("register_vendeur.php");
}

else {
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$log = $_POST['login'];
	$pass = $_POST['pass'];
	$hash_pass = password_hash($pass, PASSWORD_DEFAULT);
	//	$pass = md5($pass);

	try {

		require("../db_config.php");

		$SQL = "SELECT COUNT(*) FROM users WHERE login = ?";
		$st = $db->prepare($SQL);
		$st->execute(array($log));

		$number = $st->fetchColumn();

		if($number != 0) {
			echo "<p>Compte ".$log." est déjà existant.</p>";
			include("register_vendeur.php");
		} 

		else {

			$SQL = "INSERT INTO users (nom,prenom,login,mdp,role) VALUES (?,?,?,?,'vendeur')";
			$st = $db->prepare($SQL);
			$res = $st->execute(array($nom,$prenom,$log,$hash_pass));

			if (!$res) {
				echo "<p>Error</p>";
			} else {
				?>

				<?php
				echo "Bonjour ".$prenom." ".$nom.". Bienvenue dans notre magasin.<br>You are vendeur now.<br>";
				?>
				<a href="login.php">Click here to login the first time.</a>
				<?php
			}

			$db = null; 
		}
	}

	catch (PDOException $e){
		echo "Erreur SQL: ".$e->getMessage(); 
	}
}
?>

<?php
include("footer.php");
?>
