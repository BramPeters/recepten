<?php

require_once("airportservice.php");

$country_code	= (isset($_GET['country_code']))?$_GET['country_code']:'';

/*
een assoc array wordt door json_encode in een JS object omgezet { }, een geindexeerd array in een gewoon array [ ]
de extra param 'options' werkt pas vanaf PHP 5.3
$output = json_encode($team,JSON_FORCE_OBJECT);

*/
$apService= new AirportService();


if (!isset($_GET['country_code'])){
	//$output = "{}";
	$output = $apService->geefJSONAlleAirports();
	}
else{
	$output = $apService->geefJSONAirportsByCountryCode($country_code);
	}
//header('Content-type: application/json');
echo $output;	
?>