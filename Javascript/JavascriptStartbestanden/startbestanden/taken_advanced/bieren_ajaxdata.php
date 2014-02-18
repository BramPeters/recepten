<?php 
// scriptje voor Javascript taak "Bieren en brouwers"
// produceert een xml bestand voor een Ajax call


//connection : zorg voor de INC file!
include('conn_mysqli_bieren.inc.php');

$xml = "";

//reageert op de GET/POST in het XMLHttpRequest.open

if (empty($_REQUEST['brouwerNr'])){
	//misschien een bier gevraagd
	if (empty($_REQUEST['bierNr'])){
		//default output = lijst brouwers
		$xml .= "<brouwers>";
	
		$strQuery="SELECT * FROM brouwers";
		$resultSet=$db->query($strQuery);
		if($resultSet){	
			while($row = $resultSet->fetch_assoc()){
					$xml.= "<brouwer brouwerNr='".$row['BrouwerNr']."'>".$row['BrNaam']."</brouwer>";
			}
		}
		$xml .= "</brouwers>";
	} 
	else {
		$bierNr = $_REQUEST['bierNr'];
		//gegevens van één bier
		$xml .= "<bier bierNr='".$bierNr."'>";
	
		$strQuery =	"SELECT bieren.Naam as bierNaam, bieren.Alcohol as alcohol, soorten.Soort as soortNaam ";
		$strQuery.=	"FROM bieren INNER JOIN soorten ";
		$strQuery.=	"ON bieren.SoortNr=soorten.SoortNr ";
		$strQuery.=	"WHERE BierNr=".$bierNr;
		
		$resultSet=$db->query($strQuery);
		if($resultSet){	
			while($row = $resultSet->fetch_assoc()){
					$xml.= "<naam>".$row['bierNaam']."</naam>";
					$xml.= "<alcohol>".$row['alcohol']."</alcohol>";
					$xml.= "<soort>".$row['soortNaam']."</soort>";
			}
		}
		$xml .= "</bier>";
	}
	
	
	
}
else
{
	$brouwerNr = $_REQUEST['brouwerNr'];
	//bieren van brouwer
	$xml .= "<bieren>";

	$strQuery="SELECT * FROM bieren WHERE BrouwerNr=".$brouwerNr;
	$resultSet=$db->query($strQuery);
	if($resultSet){	
		while($row = $resultSet->fetch_assoc()){
				$xml.= "<bier bierNr='".$row['BierNr']."'>".$row['Naam']."</bier>";
		}
	}
	$xml .= "</bieren>";
	
}

$db->close();

header("Content-Type: application/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo $xml;
?>