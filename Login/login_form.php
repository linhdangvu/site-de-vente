<?php
$page_title = "Login";
include("header.php");
?>

<h1> Login </h1>

<nav>
  <a href="../index.php"> HOME </a>
  <a href="../List/Liste.php"> LIST </a>
  <a href="../List/panier.php"> Panier </a>
  <a href="register_acheteur.php">Nouveau acheteur</a> 
  <a href="register_vendeur.php">Nouveau vendeur</a> 
</nav>
<br><br>
<form action="login.php" method="POST">


  <label for="login"><b> Username&emsp;</b></label>
  <input type="text" placeholder="Enter Username" name="login" required>

  <br>

  <label for="pass"><b> Password  &emsp;</b></label>
  <input type="password" placeholder="Enter Password" name="pass" required>
  <br><br><br>
  <button type="submit">Login</button>

  <br>



</form>

<?php 
include "footer.php";
?>

