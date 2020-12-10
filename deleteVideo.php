<?php
//$db = new PDO("mysql:dbname=hw6", "root", "");
$id = $_GET["id"];
if (!isset($id))
	die("Missing querystring parameter!");
else{

$conn = new PDO("mysql:host=localhost;dbname=278project","root","");
$sql1 =$conn->query("DELETE FROM Report WHERE video = '$id'");
print "done";
	header("Location: user_management.php");
}
	?>