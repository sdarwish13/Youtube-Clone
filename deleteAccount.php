<?php
//$db = new PDO("mysql:dbname=hw6", "root", "");
$email = $_GET["email"];
if (!isset($email))
	die("Missing querystring parameter!");
else{

$conn = new PDO("mysql:host=localhost;dbname=278project","root","");
$sql1 =$conn->query("DELETE FROM Channel WHERE owner = '$email'");
$sql2 =$conn->query("DELETE FROM Account WHERE email = '$email'");
print "done";
	header("Location: user_management.php");
}
	?>