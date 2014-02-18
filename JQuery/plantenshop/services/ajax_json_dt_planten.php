<?php
//error_reporting(E_ALL);
//dit script levert een JSON bestand voor de dataTables Ajaxcall, voor gebruik clientside dus
//die haalt alle noodzakelijke variabelen op en pompt ze in de presentatielaag
require_once("plantenservice.php");

/*********************Managers, services instances*******************************/

$pService = new PlantenService();

/*********************Methods van de Managers, services*******************************/
//default values
		$soort_id 		= (isset($_GET['soort_id']))?$_GET['soort_id']:'%';
		$kleur 			= (isset($_GET['kleur']))?$_GET['kleur']:'%';
		$hoogte_min 	= (isset($_GET['hoogte_min']))?intval($_GET['hoogte_min']):0;
		$hoogte_max 	= (isset($_GET['hoogte_max']))?intval($_GET['hoogte_max']):10000;
	//	$bl_b 			= (isset($_GET['bl_b']))?intval($_GET['bl_b']):0;
//		$bl_e 			= (isset($_GET['bl_e']))?intval($_GET['bl_e']):11;
//		$prijs_min 		= (isset($_GET['prijs_min']))?intval($_GET['prijs_min']):0;
//		$prijs_max 		= (isset($_GET['prijs_max']))?intval($_GET['prijs_max']):100;
				

$json_dt_Planten = $pService->geefJSON_dt_PlantenAdvanced($soort_id,$kleur, $hoogte_min, $hoogte_max); //JSON

echo $json_dt_Planten;	

?>