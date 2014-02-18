<?php 
/*
BUSINESS LAAG
geeft verschillende klassieke PHP services: 
 let op de return statements 
*/ 
@define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/data/plantendao.php'); 
require_once(__ROOT__."/man/displayManager.php");

$Plant_DAO 	= new PlantenDAO();
$DM  		= new DisplayManager();


class PlantenService{
	
	public function geefTabelAllePersoneel(){
	
		global $Pers_DAO;
		global $DM;
		
		$arrPersoneel = $Pers_DAO->getArrayAllePersoneel(); //array van arrays
				
		//titels toevoegen op 1ste rij
		$titels = array("Profiel wijzigen","Voornaam","Familienaam","Functie");
		array_unshift($arrPersoneel,$titels);	
		
		//in tabel zetten
		$tbl_personeel = $DM->arrayNaarTabelMKoppen($arrPersoneel,"omlijnd","personeelslijst");
		
		return $tbl_personeel;
	}
	
	public function geefJSON_dt_PlantenAdvanced($soort_id,$kleur, $hoogte_min, $hoogte_max ){
	
		global $Plant_DAO;
		$planten = $Plant_DAO->getJSON_dt_PlantenAdvanced($soort_id,$kleur, $hoogte_min, $hoogte_max); //resultset
		//andere taken hier
		return $planten;
	}
	public function geefTabelPlantenAdvanced($soort_id,$kleur, $hoogte_min, $hoogte_max){
	
		global $Plant_DAO;
		global $DM;
		
		$arrPlanten = $Plant_DAO->getArrayPlantenAdvanced($soort_id,$kleur, $hoogte_min, $hoogte_max); //array
		
		//titels toevoegen op 1ste rij
		$titels = array("Soort","kleur","hoogte","beginbloei","eindbloei","prijs","rubriek");
		array_unshift($arrPlanten,$titels);	
		//in tabel zetten
		$tbl_planten = $DM->arrayNaarTabelMKoppen($arrPlanten,"omlijnd","plantenlijst");
		
		return $tbl_planten;
	}
	public function geefArrayAllePlanten(){
	
		global $Plant_DAO;
		$planten = $Plant_DAO->getArrayAllePlanten(); //array
		//doe hier ook andere taken zoals mail versturen, loggen, etc...
		//of sorteren kan hier gebeuren, met het array
		return $planten;
	}
	
	public function geefResultSetAllePlanten(){
	
		global $Plant_DAO;
		$planten = $Plant_DAO->getResultSetAllePlanten(); //resultset
		//andere taken hier
		return $planten;
	}
	
	public function geefResultSetPlantenAdvanced( $soort_id,$kleur, $hoogte_min, $hoogte_max){
	
		global $Plant_DAO;
		$planten = $Plant_DAO->getResultSetPlantenAdvanced( $soort_id, $kleur, $hoogte_min, $hoogte_max); //resultset
		//andere taken hier
		return $planten;
	}
	public function geefXMLPlantenAdvanced($kleur, $hoogte_min, $hoogte_max, $bl_b, $bl_e, $prijs_min, $prijs_max, $soort_id){
	
	global $Plant_DAO;
		$planten = $Plant_DAO->getXMLPlantenAdvanced($kleur, $hoogte_min, $hoogte_max, $bl_b, $bl_e, $prijs_min, $prijs_max, $soort_id); //resultset
		//andere taken hier
		return $planten;
	}
	public function geefResultSetPlantenPerSoort($soort_id){
	
		global $Plant_DAO;
		$planten = $Plant_DAO->getResultSetPlantenPerSoort($soort_id); //resultset
		//andere taken hier
		return $planten;
	}
	
	public function geefDDAlleSoorten(){
	
		global $Plant_DAO;
		global $DM;
		$soorten 			= $Plant_DAO->getArrayAlleSoorten(); //array
		$soortendropdown 	= $DM->soortenDropdown("soort_id",$soorten, null, "kies een soort",  false); //keuzelijst  object, geen html
		return $soortendropdown;
	}
	public function geefDDAlleSoortenMultiple(){
	
		global $Plant_DAO;
		global $DM;
		$soorten 			= $Plant_DAO->getArrayAlleSoorten(); //array
		$soortendropdown 	= $DM->soortenDropdown("soort_id[]",$soorten, null, "kies niet meer dan 3 soorten",  true); //keuzelijst  object, geen html
		return $soortendropdown;
	}
	public function geefDDAlleKleuren(){
	
		global $Plant_DAO;
		global $DM;
		$kleuren 			= $Plant_DAO->getArrayAlleKleuren(); //array
		$kleurendropdown 	= $DM->kleurenDropdown($kleuren); 	//keuzelijst object, geen html
		return $kleurendropdown;
	}
	public function geefResultSetAlleSoorten(){
	
		global $Plant_DAO;
		$planten = $Plant_DAO->getResultSetAlleSoorten(); //resultset
		//andere taken hier
		return $planten;
	}
	
	public function showPlant($art_code){
	
		global $Plant_DAO;
		$plant = $Plant_DAO->getPlantByArt_code($art_code);
		return $plant;
	}
	
	public function createNewPlant($plantennm,$kleur,$hoogte,$bl_b,$bl_e,$prijs,$soort_id){
		
		//verplichte velden
		if ( (!isset($plantennm) || ($plantennm)=="") || (!isset($soort_id) || ($soort_id)=="")){
			throw new MissingDataException(); 
		}
		
		global $Plant_DAO;
		$plant = new Plant(NULL, $plantennm,$kleur,$hoogte,$bl_b,$bl_e,$prijs,$soort_id); //NULL omdat de key een autonummer is
		$plant = $Plant_DAO->createPlant($plant);
		return $plant;
	}
	
	public function searchPlantenBySoort_id($soort_id){
	//verplichte velden
		if (!is_numeric($soort_id)){
			throw new MissingDataException(); 
		}
		//controle soort_id
		$soortenDAO = new SoortenDAO();

		$s= $this->getSoortBySoort_id($soort_id);
		if (isset($s)){
			$plantenDao = new PlantenDAO();
			$planten = $plantenDao->getPlantenBySoort_id($soort_id);
			return $planten;
		
		}
		else{
			return null;
		}
		
		
	}
}



?>