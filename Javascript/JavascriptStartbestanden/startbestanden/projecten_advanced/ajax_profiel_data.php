<?php
/*
ajax_profile_data.php
nodig voor JS adv project profiel.html
db gegevens voor http en XHR request 
*/



if (!empty($_REQUEST['actie'])){
	
	$veld 	= $_REQUEST['veld'];	
	$idpers = $_REQUEST['idpers'];
	$actie 	= $_REQUEST['actie'];

	$pm 	= new PersoneelManager();
		
	switch ($actie){
		case "lees":
			if($veld=="alle"){
				$persoon = $pm->getPersoon($idpers,$veld);
				echo $persoon;
				}
			else{
				$waarde = $pm->getVeld($idpers,$veld);
				echo $waarde;
				}
			break;
		case "schrijf":
			$inh 	= $_REQUEST['inh'];
			$pm->putVeld($idpers,$veld,$inh);
			break;
		default:
			echo "ongekende actie";
		}	
}

//=================================================
class PersoneelManager {
	
	public function getAlleGegevens(){
		//returns array
		$lijst = array();
		$dbh = new PDO("mysql:host=localhost;dbname=personeel","web","web");
		$rs = $dbh->query("select * from personeel");
		
		foreach($rs as $rij){
			$gegevens = $rij["voornaam"] . ", " . $rij["familienaam"];
			array_push($lijst, $naam);
			}
		$dbh = null;
		return $lijst;
		}
		
	public function getPersoon($id){
		//return als JSON string
		$jsonArray = array();
		
		$dbh 		= new PDO("mysql:host=localhost;dbname=personeel","web","web");
		$sql 		= "select * from personeel WHERE idpersoneel=".$id;
		$rs 		= $dbh->query($sql);
		$result 	= $rs->fetch(PDO::FETCH_ASSOC);
		$colcount 	= $rs->columnCount();
		//print $sql;
		
		foreach($result as $key=>$val)
		  {
			$jsonArray[$key] = $val;
		  }
		
		$jsondata = json_encode($jsonArray);
		//returnt data van 1 persoon als 1 json object
		$dbh = null;
		return $jsondata ;
		}
	public function getVeld($id,$veld){
		//leest en returned de inhoud van 1 veld
		$dbh = new PDO("mysql:host=localhost;dbname=personeel","web","web");
		$sql = "select ". $veld . " from personeel where idpersoneel=" . $id;
		//print $sql;
		$rs = $dbh->query($sql);
		
		foreach($rs as $rij){
			$data = $rij[0];
			}
		$dbh = null;
		return $data;
		}
		
	public function putVeld($id,$veld,$inh){
		//schrijft de inhoud van 1 veld
		$dbh = new PDO("mysql:host=localhost;dbname=personeel","web","web");
		$sql = "UPDATE personeel SET ". $veld . "='" . $inh .  "' WHERE idpersoneel=" . $id;
		print $sql;
		$dbh->exec($sql);
		
		$dbh = null;
		}
	}
?>