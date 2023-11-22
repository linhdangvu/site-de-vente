<?php 
session_start();
$page_title = "Liste";
include("header.php");
?>

<div id="list">
	<h1> Liste </h1>


	<nav >
		<a href="../index.php">HOME</a>
		<a href="categories.php"> Categories </a> 
		<a href="list_produit.php"> Produits </a> 
		<a href="list_four.php"> Fournisseurs </a> 
		<a href="panier.php"> Panier </a>
	</nav>

</div>

<!--img src="upec1.JPG"-->
<h2> Dans cette liste, nous avons </h2>
<button type="button" onclick="document.getElementById('pic').src = changePic('a')"> Alimentaires </button>
<button type="button" onclick="document.getElementById('pic').src = changePic('v')"> Vêtements </button>
<button type="button" onclick="document.getElementById('pic').src = changePic('j')"> Jouets </button>

<h2> Si vous voulez plus d'informations, appuyer sur : </h2>
<p> &nbsp; - 
	<a href="categories.php"> Categories </a>
	 : pour accéder à nos produits de chaque categories</p>
<p> &nbsp; - 
		<a href="list_produit.php"> Produits </a> 
	 : pour voir toutes nos produits </p>
<p> &nbsp; - 
		<a href="list_four.php"> Fournisseurs </a> 
	: Pour voir qui vendre nos produits </p>

<img id="pic" style="width:30cm, height:18cm">

<script type="text/javascript">
	function changePic (s) {
		if (s=='a') {
			return "alimentaire.JPG";
		} else if (s=='j') {
			return "jouet.JPG";
		} else if (s=='v') {
			return "vetement.JPG";
		} else return "";
	}
</script>


<?php
include("footer.php");
?>