<?php
//datalaag
require_once(__ROOT__.'/entities/planten.php');//pad steeds vanuit de controller
require_once(__ROOT__.'/entities/soorten.php'); //pad steeds vanuit de controller
require_once("abstractdao.php"); //connectiegegevens

class PlantenDAO extends AbstractDAO{

	
	public function getJSON_dt_PlantenAdvanced($soort_id, $kleur, $hoogte_min, $hoogte_max){
			
			// dataTables JSON object:
			
			//		een object met de property aaData met als waarde een array met subarrays voor elke rij gegevens
			//		{ "aaData": [
			//						["Trident","Internet Explorer 4.0","Win 95+","4","X"],
			//						["Trident","Internet Explorer 5.0","Win 95+","5","C"]
			//					]
			//		}
			
			$kleur 		= (empty($kleur))?"%":$kleur;
			$hoogte_min = intval($hoogte_min);
			$hoogte_max = intval($hoogte_max);
			$soort_id 	= (empty($soort_id))?"%":$soort_id;
			
			$sqlAlleCriteria  =  "SELECT p.art_code as code, p.plantennm as naam, p.kleur, p.hoogte, p.bl_b as beginbloei, p.bl_e as eindebloei, p.prijs, s.soort";
			$sqlAlleCriteria .= " FROM planten p ";
			$sqlAlleCriteria .= " INNER JOIN soorten s ON p.soort_id = s.soort_id";
			$sqlAlleCriteria .= " WHERE (p.kleur LIKE '".$kleur . "' OR p.kleur IS NULL)";
			$sqlAlleCriteria .= " AND p.hoogte	>".$hoogte_min. " AND p.hoogte<".$hoogte_max ;
			$sqlAlleCriteria .= " AND p.soort_id like '".$soort_id ."' ";
			//echo $sqlAlleCriteria;
			// 
			$jsonArray = array();
			$db = $this->createConnection(); //uit abstractdao.php
			$result = $db->query($sqlAlleCriteria); //resultset
			if($result){ 
				$aantalrecords=$result->num_rows;
				$aantalVelden=$result->field_count;
				//echo "$aantalrecords";
				
				while ($row = $result->fetch_array(MYSQLI_NUM)){ //indexed
					$rijen[] = $row; //zet in array
				}
				
				foreach($rijen as $rij) {
					$data=array();
					for($i=0;$i<$aantalVelden;$i++){
						  array_push($data,$rij[$i]);
						  }
					array_push($jsonArray,$data);
				}
				
				$result->close();
			}
			//opmerking: voor dataTabels moet de prop aaData in "" staan
			$jsonplanten = "{ \"aaData\":" . json_encode($jsonArray) . "}";
			//returnt data 
			$db = null;
			return $jsonplanten ;
			
			
		
	}	

	
	public function getResultSetPlantenAdvanced( $soort_id, $kleur, $hoogte_min, $hoogte_max){
		// returnt de resultset van alle planten met een query waarin alle velden parameters kunnen geven
					
			$kleur 		= (empty($kleur))?"%":$kleur;
			$hoogte_min = intval($hoogte_min);
			$hoogte_max = intval($hoogte_max);
			$soort_id 	= (empty($soort_id))?"%":$soort_id;
			
			/*
			default 
			
			SELECT  plantennm as plant,soort_id, kleur, hoogte, bl_b as beginbloei, bl_e as eindebloei, prijs, art_code
			FROM planten p
			WHERE (kleur LIKE '%' OR kleur IS NULL)
			AND (hoogte BETWEEN 0 AND 10000)
			AND bl_b>=0
			AND bl_e<=11
			AND (prijs BETWEEN 0 AND 100)
			AND soort_id like  '%'
			*/
			
			$sqlAlleCriteria =  "SELECT p.art_code as code, p.plantennm as naam, p.kleur, p.hoogte, p.bl_b as beginbloei, p.bl_e as eindebloei, p.prijs, s.soort";
			$sqlAlleCriteria .= " FROM planten p ";
			$sqlAlleCriteria .= " INNER JOIN soorten s ON p.soort_id=s.soort_id";
			$sqlAlleCriteria .= " WHERE (p.kleur LIKE '".$kleur . "' OR p.kleur IS NULL)";
			$sqlAlleCriteria .= " AND p.hoogte	>".$hoogte_min. " AND p.hoogte<".$hoogte_max ;
			$sqlAlleCriteria .= " AND p.soort_id like '".$soort_id ."' ";
			$sqlAlleCriteria .= " ORDER BY p.art_code ";
			// echo $sqlAlleCriteria;
			// opmerking bij echo: de querystring wordt bovenaan de pagina getoond: 
			// op dat ogenblik gaat er iets mis met de css van de tabel, dus gewoon de qs neutraliseren en alles is weer OK
			
			
			$db = $this->createConnection(); //uit abstractdao.php
			$result = $db->query($sqlAlleCriteria);
			return $result;	
			$db->close();
		
	}	
	
	public function getXMLPlantenAdvanced($kleur, $hoogte_min, $hoogte_max, $bl_b, $bl_e, $prijs_min, $prijs_max, $soort_id){
			// returnt een xml string voor een Ajaxcall van alle planten met een query waarin alle velden parameters kunnen geven
			// oppassen! het element 'plant' mag maar één keer voorkomen in 'planten' daarom plantennm als 'naam'
			
			$kleur 		= (empty($kleur))?"%":$kleur;
			$hoogte_min = intval($hoogte_min);
			$hoogte_max = intval($hoogte_max);
			$bl_b 		= intval($bl_b);
			$bl_e 		= intval($bl_e);
			$prijs_min 	= intval($prijs_min);
			$prijs_max 	= intval($prijs_max);
			$soort_id 	= (empty($soort_id))?"%":$soort_id;
			
			/*
			default 
			
			SELECT  plantennm as plant,soort_id, kleur, hoogte, bl_b as beginbloei, bl_e as eindebloei, prijs, art_code
			FROM planten p
			WHERE (kleur LIKE '%' OR kleur IS NULL)
			AND (hoogte BETWEEN 0 AND 10000)
			AND bl_b>=0
			AND bl_e<=11
			AND (prijs BETWEEN 0 AND 100)
			AND soort_id like  '%'
			*/
			
			$sqlAlleCriteria =  "SELECT art_code as code, plantennm as naam, kleur, hoogte, bl_b as beginbloei, bl_e as eindebloei, prijs, soort_id";
			$sqlAlleCriteria .= " FROM planten p ";
			$sqlAlleCriteria .= " WHERE (kleur LIKE '".$kleur . "' OR kleur IS NULL)";
			$sqlAlleCriteria .= " AND p.hoogte	>".$hoogte_min. " AND p.hoogte<".$hoogte_max ;
			$sqlAlleCriteria .= " AND  bl_b>=".$bl_b;
			$sqlAlleCriteria .= " AND bl_e<=".$bl_e;
			$sqlAlleCriteria .= " AND (prijs BETWEEN ".$prijs_min." AND ". $prijs_max .")";
			$sqlAlleCriteria .= " AND soort_id like '".$soort_id ."' ";
			// echo $sqlAlleCriteria;
			// let op: bij een xml output geeft ajax een fout . Belijk echter de sqlstring in de FF console
			
			
			$db = $this->createConnection(); //uit abstractdao.php
			$result = $db->query($sqlAlleCriteria);
			//aanmaak xml
			$xml = "<planten>";
			
			if($result){ 
				$aantalrecords=$result->num_rows;
				$aantalVelden=$result->field_count;
				//echo "$aantalrecords";
				while ($row = $result->fetch_assoc()){
					//plant node	
					$xml.= "<plant>";
					//geeft automatisch alle gevraagde kolommen als elementen
					if($aantalVelden>0){
					  foreach ($row as $column=>$value) { 
						  $xml.= "<" . $column . ">";
						  $xml.=  $row[$column]; 
						  $xml.= "</" . $column . ">";
					  }
					}
					$xml.= "</plant>";
				}
				$result->close();
			}
			$xml .= "</planten>";
			return $xml;	
			$db->close();
		
	}	

	
	public function getArrayPlantenAdvanced($soort_id, $kleur, $hoogte_min, $hoogte_max){
		// returnt een array van subarrays
			
			$kleur 		= (empty($kleur))?"%":$kleur;
			$hoogte_min = intval($hoogte_min);
			$hoogte_max = intval($hoogte_max);
			$soort_id 	= (empty($soort_id))?"%":$soort_id;
			
			$sql  =  "SELECT p.art_code as code, p.plantennm as naam, p.kleur, p.hoogte, p.bl_b as beginbloei, p.bl_e as eindebloei, p.prijs, s.soort";
			$sql .= " FROM planten p ";
			$sql .= " INNER JOIN soorten s ON p.soort_id = s.soort_id";
			$sql .= " WHERE (p.kleur LIKE '".$kleur."'";
			$sql .= ")";
			//$sql .= " OR p.kleur IS NULL)";
			$sql .= " AND p.hoogte	>".$hoogte_min. " AND p.hoogte<".$hoogte_max ;
			$sql .= " AND p.soort_id like '".$soort_id ."' ";
			//echo $sql;
	
			$arrPlanten = array();
			$db = $this->createConnection(); //uit abstractdao.php
			$result = $db->query($sql);
			if($result){ 
				$aantalrecords=$result->num_rows;
				$aantalVelden=$result->field_count;
				//echo "$aantalrecords";
				
				while ($row = $result->fetch_array()){
					//plant array
					$plant = array($row["naam"],$row["kleur"],$row["hoogte"],$row["beginbloei"],$row["eindebloei"],$row["prijs"],$row["soort"]);
					//toevoegen aan hoofdarray
					array_push($arrPlanten,$plant);		
				}
				$result->close();
			}
			$db->close();
			return $arrPlanten;
	}	
	
	public function getArrayAllePlanten(){
		// returnt een array van plantobjecten (alle)
		$planten = array();
		$db = $this->createConnection(); //uit abstractdao.php
		$result = $db->query("select * from planten");
		if($result){ 
			$aantalrecords=$result->num_rows;
			$aantalVelden=$result->field_count;
			//echo "$aantalrecords";
			while ($row = $result->fetch_array()){
				//plant object	
				$plant = new Plant($row["art_code"],$row["plantennm"],$row["kleur"],$row["hoogte"],$row["bl_b"],$row["bl_e"],$row["prijs"],$row["soort_id"]);
				//toevoegen aan het array
				array_push($planten,$plant);		
			}
			$result->close();
		}
		$db->close();
		return $planten;
	}	
	
	public function getResultSetAllePlanten(){
		// returnt de resultset van alle planten
		$db = $this->createConnection(); 
		$sql = "select * from planten";
		//echo $sql;
		$result = $db->query($sql);
		return $result;	
		$db->close();
	}	
	
	public function getResultSetPlantenPerSoort($soort_id){
		// returnt de resultset van alle planten
		if(is_numeric($soort_id)){
			$soort_id = intval($soort_id);
			$db = $this->createConnection(); 
			$sql = "select * from planten where soort_id=".$soort_id;
			//echo $sql;
			$result = $db->query($sql );
			return $result;	
			$db->close();
		}
		else{
			throw new exception('soort_id is geen getal');
		}
	}	
	
	public function getArrayAlleSoorten(){
		// returnt een array van soortobjecten (alle)
		$soorten = array();
		$db = $this->createConnection(); 
		$sql = "select * from soorten";
		//echo $sql;
		$result = $db->query($sql);
		if($result){ 
			$aantalrecords=$result->num_rows;
			$aantalVelden=$result->field_count;
			//echo "$aantalrecords";
			while ($row = $result->fetch_array()){
				$soort = new Soort($row["soort_id"],$row["soort"]);
				array_push($soorten,$soort);		
			}
			$result->close();
		}
		$db->close();
		return $soorten;
	}	
	
	public function getResultSetAlleSoorten(){
		// returnt de resultset van alle planten
		$db = $this->createConnection();
		$sql = "select * from soorten";
		//echo $sql;
		$result = $db->query($sql);
		return $result;	
		$db->close();
	}	
	
	public function getArrayAlleKleuren(){
		// returnt een array van strings: kleuren uit de planten tabel
		$kleuren = array();
		$db = $this->createConnection(); 
		$sql = "select distinct kleur from planten where kleur is not null order by kleur";
		//echo $sql;
		$result = $db->query($sql);
		if($result){ 
			$aantalrecords=$result->num_rows;
			$aantalVelden=$result->field_count;
			//echo "$aantalrecords";
			while ($row = $result->fetch_array()){
				$kleur = strtolower($row["kleur"]);
				array_push($kleuren,$kleur);		
			}
			$result->close();
		}
		$db->close();
		return $kleuren;
	}	
	
	public function getPlantByArt_code($art_code){
		//één plant
		$db = $this->createConnection(); 
		$sql = "select * from planten WHERE art_code=".$art_code;
		//echo $sql;
		$result = $db->query($sql);
		$row= $result->fetch_array();
		if($row){
			$plant = new Plant($row["art_code"],$row["plantennm"],$row["kleur"],$row["hoogte"],$row["bl_b"],$row["bl_e"],$row["prijs"],$row["soort_id"]);
			return $plant;
		}
		else{return null;}
		$db->close();
	}
	
	public function getPlantenBySoort_id($soort_id){
		//plantenlijst
		$planten = array();
		$db = $this->createConnection(); 
		$sql = "select * from planten WHERE soort_id=".$soort_id;
		//echo $sql;
		$result = $db->query($sql);
		
		if($result){ 
			while ($row= $result->fetch_array()){
				//plant object
				$plant = new Plant($row["art_code"],$row["plantennm"],$row["kleur"],$row["hoogte"],$row["bl_b"],$row["bl_e"],$row["prijs"],$row["soort_id"]);
				//toevoegen aan het array
				array_push($planten,$plant);	
			}
			$result->close();
		}
		$db->close();
		return $planten;
	}
	
	
	
	public function createPlant($plant){
		//controle van argumenten
		$ac=$plant->getArtCode();
		
		//als leeg/niet nummer
		if (!is_numeric($ac)){
		//werp exception die bovenliggende lagen allerteert
		//deze service weet echter niet welke de oproeper is, heeft ook niets te maken met de presentation
	
			throw new MissingDataException(); //zelfgebrouwen exception enkel afgeleid van de base class exception
		}
		//bestaat art_code al
		$m= $this->getPlantByArt_code($ac);
		if (isset($m)){
			throw new DuplicateKeyException(); //zelfgebrouwen exception enkel afgeleid van de base class exception
		}
		
		$db = $this->createConnection();
		
		$pn = $db->real_escape_string($plant->getPlantennm());
		$kl = $db->real_escape_string($plant->getKleur()); 
		$ho = floatval($plant->getHoogte()); 
		$bb = floatval($plant->getBL_B());
		$be = floatval($plant->getBL_E());
		$pr = floatval($plant->getPrijs());
		$si = intval($plant->getSoort_id());
		
		$sql  = "INSERT INTO planten (plantennm,kleur,hoogte,bl_b,bl_e,prijs,soort_id)";
		$sql .= "VALUES(\"$pn\",\"$kl\",".$ho.",".$bb.",".$be.",".$pr.",".$si.")";
		
		$r = $db->query($sql);
		
		if($r){
		
			$plant->setArtCode($db->insert_id) ;//laatst inserted id
			return $plant; 
			$db->close();
		
		}
		else{
		
			throw new Exception("<p>mysql foutboodschap ".$db->errno.": ".$db->error."</p>");
		}
	}
	
	
	
//einde class	
}

?>