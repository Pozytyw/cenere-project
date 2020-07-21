<?php 
	$directory = $_SERVER['DOCUMENT_ROOT'];
	include($directory."/database/databaseLink.php");
	$connectorDB = new ConnectorDB();
	$query = "select gender.gender from users inner join gender on gender.id = gender_id where email like 'a@a.pl' and password like '123';";
	$result = $connectorDB->query($query);
	echo mysqli_num_rows($result);
?>