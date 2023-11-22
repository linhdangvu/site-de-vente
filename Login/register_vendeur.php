<?php
$page_title = "Register";

include("header.php");
?>

<h1>Register</h1>

<nav>
    <a href="../index.php">HOME</a>
    <a href="../List/Liste.php">LIST</a>
    <a href="../List/panier.php">Panier</a>
    <a href="login.php">Login</a>
</nav>

<br>

<form action = "add_vendeur.php" method="POST">
    <table>
        <tr>
            <td> Nom: </td>
            <td> <input type="text" name="nom" required></td>
        </tr>
        <tr>
            <td> Prenom: </td>
            <td> <input type="text" name="prenom" required></td>
        </tr>
        <tr>
            <td> Account: </td>
            <td> <input type="text" name="login" required></td>
        </tr>
        <tr>
            <td> Password: </td>
            <td> <input type="password" name="pass" required></td>
        </tr>
    </table>
    <input type="submit" value="Register">
</form>



<?php
include("footer.php");
?>

