<?php 
session_start();
$page_title="Vente Site UPEC";
include("header.php");
?>



<div>
	<div>
		<h1 align="center"> Vente Site UPEC </h1>

		<?php 
		if (isset($_SESSION['prenom']) && isset($_SESSION['nom'])) {
			echo '<p style="text-align: right;">Bienvenue '.$_SESSION['nom']." ".$_SESSION['prenom']."</p>";
			echo '<p style="text-align: right;"><a href="Login/logout.php">Déconnecter</a></p>';
		}
		else {
			echo '<p align="right">Bienvenue</p>';
		}
		?>
	</div>



	<div>
		<nav>

			<?php

			if(isset($_SESSION['role']) && $_SESSION['role'] == 'vendeur' ) {
				?>
				<a href="Vendeur/produit/liste.php" >Produits</a>
				<a href="Vendeur/commande/liste.php">Commandes</a>
				<a href="List/Liste.php"> Liste </a>
				<a href="List/panier.php?pid=<?php echo $_SESSION['pid'] ?>&qte=<?php echo $_SESSION['q'] ?>" >Panier</a>
				<?php
			} else if(isset($_SESSION['role']) && $_SESSION['role'] == 'acheteur' ){
				?>
				<a href="List/Liste.php"> Liste </a>
				<a href="List/commande.php"> Commande </a>
				<a href="List/panier.php?pid=<?php echo $_SESSION['pid'] ?>&qte=<?php echo $_SESSION['q'] ?>" >Panier</a>
			<?php	} else { ?>
				<a href="List/Liste.php"> Liste </a>
				<a href="List/panier.php?pid=<?php echo $_SESSION['pid'] ?>&qte=<?php echo $_SESSION['q'] ?>" >Panier</a>
			<?php } ?>

			
			<?php
			if(!isset($_SESSION['login'])) {
				?>
				<a href="Login/login_form.php">Login</a>
				<?php
			} ?>

		</nav>
	</div>
	
</div>

<img src="upec.JPG">

<footer>
	<hr>
	Contact : <br>
	Addrese : 123 rue ABC, 94000 Creteil <br>
	Hotline : 01 23 45 67 89 <br>
	Horaire : 9h - 22h de Lundi à Dimanche <br>
</footer>



<?php
include("footer.php");
?>