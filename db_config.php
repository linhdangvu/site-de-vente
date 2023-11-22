<?php

$hostname = "localhost";
$dbname = "u21611949";
$username = "u21611949";
$password = "3vLcWjJeId0b";

$dsn = "mysql:host=$hostname;dbname=$dbname;charset=utf8";

try {
	$db = new PDO($dsn,$username,$password);
	//echo "Connected";
} catch (PDOException $e) {
	$error = $e->getMessage();
	echo $error;
}

?>
