<?php

//dit script levert enkel een JSON output voor een Ajaxcall, geen controller

$team = array(
			  "roger" 	=> array("naam"=>"Roger Mary","leeftijd"=> 59, "functie"=>"bedrijfsleider", "foto"=>"roger.jpg"),
			  "jan" 	=> array("naam"=>"Jan Vandorpe","leeftijd"=>55,"functie"=>"tuinman","foto"=>"jan.jpg"),
			  "hilde"	=> array("naam"=>"Reinhilde De Klippel","leeftijd"=>35,"functie"=>"secretariaat", "foto"=>"reinhilde.jpg"),
			  "evelyn"	=> array("naam"=>"Evelyn Van Welsenaere","leeftijd"=>39, "functie"=>"sales", "foto"=>"evelyn.jpg")
			  );

$teamlid 	= (isset($_GET['teamlid']))?$_GET['teamlid']:'';

/*
een assoc array wordt door json_encode in een JS object omgezet { }, een geindexeerd array in een gewoon array [ ]
de extra param 'options' werkt pas vanaf PHP 5.3
$output = json_encode($team,JSON_FORCE_OBJECT);

*/
if (!isset($_GET['teamlid'])){
	$output = json_encode($team);
	}
else{
	if (array_key_exists($teamlid, $team)) {
    	$output = json_encode($team[$teamlid]);
	}
	else{
		$output = "{}";
	}
}

echo $output;	
?>