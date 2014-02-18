<?php
//datalaag

require_once("/entities/soorten.php"); //pad steeds vanuit de controller
require_once("abstractdao.php"); //connectiegegevens
require_once("/exceptions/missingdataexception.php");
require_once("/exceptions/duplicatekeyexception.php");

class SoortenDAO extends AbstractDAO{

	//elke functie heeft een atomaire data-taak: één ding
	
	
	public function getAllSoorten(){
		////plantenlijst
		$soorten = array();
		$db = $this->createConnection(); 
		$result = $db->query("select * from soorten");
		
		if($result){ 
			while ($row= $result->fetch_array()){
				//soort object
				$soort = new Soort($row["soort_id"],$row["soort"]);
				//toevoegen aan het array
				array_push($soorten,$soort);		
			}
			$result->close();
		}
		$db->close();
		return $soorten;
	}	
	
	public function getSoortBySoort_id($soort_id){
		//één soort
		$db = $this->createConnection(); 
		$result = $db->query("select * from soorten WHERE soort_id=".$soort_id);
		
		$row= $result->fetch_array();
		
		if($row){
			$soort = new Plant($row["soort_id"],$row["soort"]);
			return $soort;
		}
		
		else{return null;}
		
		$db->close();
	}
	
	
	
	public function createSoort($soort){
		//controle van argumenten
		$si=$soort->getSoortId();
		
		//als leeg/niet nummer
		if (!is_numeric($si)){
		//werp exception die bovenliggende lagen allerteert
		//deze service weet echter niet welke de oproeper is, heeft ook niets te maken met de presentation
	
			throw new MissingDataException(); //zelfgebrouwen exception enkel afgeleid van de base class exception
		}
		//bestaat soort_id al
		$s= $this->getSoortBySoort_id($si);
		
		if (isset($s)){
			throw new DuplicateKeyException(); //zelfgebrouwen exception enkel afgeleid van de base class exception
		}
		
		$db = $this->createConnection();
		
		$si = $db->real_escape_string($plant->getSoortId());//weinig zin want moet NULL zijn
		$so = $db->real_escape_string($plant->getSoort()); 
		
		
		$sql  = "INSERT INTO soorten (soort_id,soort)";
		$sql .= "VALUES(".$si.",".$so.")";
		
		$r = $db->query($sql);
		
		if($r){
		
			$soort->setSoortId($db->insert_id) ;//laatst inserted id
			return $soort; 
			$db->close();
		
		}
		else{
		
			throw new Exception("<p>mysql foutboodschap ".$db->errno.": ".$db->error."</p>");
		}
	}
	
	
	
//einde class	
}

?>