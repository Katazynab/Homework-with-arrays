<?php include("AllFunctions.php"); ?>
<h1>Praktinė Užduotis</h1>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$user = "root";
$password = "";
$database = "homework";

$db = new mysqli('localhost', $user, $password, $database);
$db->set_charset("utf8");

if($db->connect_errno){
	printf("Connect failed: %s\n", $db->connect_error);
	exit();
}

	$table="CREATE TABLE duomenys
	(
		id int NOT NULL AUTO_INCREMENT,
		title nvarchar(30) NOT NULL,
		parent_id int DEFAULT 0,
		PRIMARY KEY (id)
	)";

	if($db->query($table) === TRUE){
		printf("Table successfully created. <br>");
	}

	$ifEmpty = mysqli_query($db,("SELECT COUNT(*) FROM table"));

	//if($ifEmpty){
	$result=mysqli_query($db,("SELECT * FROM duomenys"));

	if(!mysqli_num_rows($result)){
		$tableInsert="INSERT INTO duomenys (title, parent_id) VALUES
		('Apie', 0),
		('Socialiniai tinklai', 0),
		('Dokumentai', 0)";

		if(mysqli_query($db, $tableInsert)){
			echo "Values1 inserted successfully. <br>";
		}

		$tableInsert2="INSERT INTO duomenys (title, parent_id) VALUES
		('Kontaktai', 1),
		('Facebook', 2),
		('Twitter', 2),
		('Anketa', 3),
		('Skaičiuoklė', 3)";

		if($db->query($tableInsert2) === TRUE){
			printf("Values2 successfully created. <br>");
		}
	}

echo "<h3>Pirma Užduotis</h3>";
title_tree(0);

function title_tree($titleid){
$servername = "localhost";
$user = "root";
$password = "";
$database = "homework";
$db = new mysqli('localhost', $user, $password, $database);
$db->set_charset("utf8");

$sql = "SELECT * FROM duomenys WHERE parent_id ='".$titleid."'";
$result = $db->query($sql);
 
	while($row = $result->fetch_assoc()){
		echo '<ul><li>' . $row['title'];
		title_tree($row['id']);
		echo '</li></ul>';
	}
}

echo "<h3>Antra Užduotis</h3>";

$sqlDisplay = "SELECT * FROM duomenys";
$resultDisplay = $db->query($sqlDisplay);

$Sort = new AllFunctions();
echo "<pre>" . var_export($Sort->grouping($resultDisplay), true) . "</pre>";



echo "<h3>Trečia Užduotis</h3>";

$sqlLevel = "SELECT * FROM duomenys";
$resultLevel = $db->query($sqlLevel);

$Level = new AllFunctions();
echo "<pre>" . var_export($Level->levels($resultLevel), true) . "</pre>";

mysqli_close($db);

?>