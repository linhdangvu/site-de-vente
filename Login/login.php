<?php
ob_start();
session_start();
$page_title = "Login";
include("header.php");
?>


<?php

if(!isset($_POST["login"])) {
	echo "<p>Account incomplet.</p>";
	require("login_form.php");
}

else if(!isset($_POST["pass"])) {
	echo "<p>Password incomplet.</p>";
	require("login_form.php");
}

else {
	$log = $_POST["login"];

	$pass = $_POST["pass"];

	//	$pass = md5($pass);

	try {

		require("../db_config.php");

		$SQL = "SELECT COUNT(*) FROM users WHERE login = ?";
		$st = $db->prepare($SQL);
		$res = $st->execute(array($log));

		if(!$res) {
			echo "<p>Error to connect</p>";

		} else {


			$number1 = $st->fetchColumn();

			if ($number1 != 0) {

				$SQL1 = "SELECT * FROM users WHERE login = ?";
				$st1 = $db->prepare($SQL1);
				$st1->execute(array($log));

				$result1 = $st1->fetchAll(PDO::FETCH_ASSOC);

				foreach ($result1 as $row1) {
					$mdp = $row1['mdp'];

				}
				
				if(password_verify($pass, $mdp)) {
					$SQL2 = "SELECT COUNT(*) FROM users WHERE login = ?";
					$st2 = $db->prepare($SQL);
					$res2 = $st2->execute(array($log));

					if(!$res2) {
						echo "<p>Error to connect</p>";

					} else {

						$number2 = $st2->fetchColumn();

						if ($number2 != 0) {

							$SQL2 = "SELECT * FROM users WHERE login = ?";
							$st2 = $db->prepare($SQL2);
							$st2->execute(array($log));

							$result2 = $st2->fetchAll(PDO::FETCH_ASSOC);

							foreach ($result2 as $row2) {
								$_SESSION['uid'] = $row2['uid'];
								$_SESSION['login'] = $row2['login'];
								$_SESSION['nom'] = $row2['nom'];
								$_SESSION['prenom'] = $row2['prenom'];
								$_SESSION['role'] = $row2['role'];
							}
							?>

							<?php
						/*	echo "Bonjour, votre compte est ".$_SESSION['login'].", votre role est: ".$_SESSION['role']."<br>";*/
							header("Location:../index.php");
							exit();

							?>

						<?php }

						else {
							echo "<p>Compte n'existe pas ou mot de passe incorrect.</p>";
							require("login_form.php");
						}
					}
				} else {
					echo "Wrong pass";
					require("login_form.php");
				}
				?>



				<?php
			/*	echo "Bonjour, votre compte est ".$_SESSION['login'].", votre role est: ".$_SESSION['role']."<br>";
				header("Location:../index.php");
				exit();
*/
				?>

			<?php }

			else {
				echo "<p>Compte n'existe pas ou mot de passe incorrect.</p>";
				require("login_form.php");
			}
		}
		$db = null; 
	}

	catch (PDOException $e){
		echo "Erreur SQL: ".$e->getMessage(); 
	}
}
?>
<?php
include("footer.php");
?>

