<?php

// ************************************
// mysqli bieren connection 

$host = "localhost";
$dbUser = "web";
$dbPassw = "web";
$dbName ="bieren";

$db = new mysqli($host, $dbUser,$dbPassw, $dbName);

if (mysqli_connect_errno()){

	echo "Er is een fout opgetreden tijdens het openen van de database:".mysqli_connect_errno().mysqli_connect_error();
	
} 
// *****************************************
?>