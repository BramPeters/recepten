<?php
//class voor tonen van gegevens specifiek voor deze applicatie
//HTMLManager is generiek

//require_once("../inc/functies.inc.php");
require_once("HTMLManager.php");

class DisplayManager {

//************************************************************//

public function generaThumbs($arrData,$id,$CSSclass=null){
/* 	UL met thumbnails
	@$CSSClass	string
	@$arrData = array van subarrays
*/
	//var_dump($arrData);
	$thumbs = "<div>";		//extra div voor content
	$thumbs .= "<ul id='$id'>";
	foreach ($arrData as $groep)
			{
				//statistische thumbnails
				//echo "<li><a class='thumb' title='".$row["naam_lt"]."' href='succulentengroep.php?groep_id=".$row["groep_id"]."'><img alt='".$row["naam_lt"]."' src='images/plantengroepen/thumb_".strtolower($row["naam_lt"]).".jpg'/></a><br />";
				//echo "<a title='".$row["naam_lt"]."' href='succulentengroep.php?groep_id=".$row["groep_id"]."'>".$row["naam_lt"]."</a></li>\n";	
				$thumbs .= "<li>";	
				$thumbs .= "<a class='thumb' title='".$groep["naam_lt"]."' href='index.php?page=planten&groep=".$groep["naam_lt"]."'>"; 
				$thumbs .= "<img alt='".$groep["naam_lt"]."' src='images/plantengroepen/thumb_".strtolower($groep["naam_lt"]).".jpg'/>";
				$thumbs .= "</a>";
				//$thumbs .= "<br />";	
				$thumbs .= "<a title='".$groep["naam_lt"]."' href='succulentengroep.php?groep_id=".$groep["groep_id"]."'>".$groep["naam_lt"]."</a>";	
				$thumbs .= "</li>";	
			}
	
	
	$thumbs .= "</ul>";
	$thumbs .= "</div>";
	return $thumbs;
}
//************************************************************//

public function maandenDropdown($name,$CSSclass=null,$selected=null){
/* genereert een keuzelijst met de maanden van het jaar als tekst, de values als getallen
	januari = 0 dec =11 

	@$CSSClass	string

*/
	$maanden = array(0=>"januari", 1=>"februari", 2=>"maart", 3=>"april", 4=>"mei", 5=>"juni", 6=>"juli", 7=>"augustus", 8=>"september", 9=>"oktober", 10=>"november", 11=>"december");

	$dd = new DropDown($name, $maanden, $CSSclass, $title=null, $selected, null, false, false);
	return $dd;
}

//************************************************************//

public function soortenDropdown($name,$soorten, $CSSclass=null, $title=null, $multiple=false){
/* genereert een keuzelijst voor de verschillende soorten 

	@$soorten	array
	@$CSSClass	string

*/
	if(!is_array($soorten)) throw new Exception('argument lijst is geen array');
	//conversie van array van objecten naar array van waarden is noodzakelijk
	$a =  array();
	foreach ($soorten as $soort){
			$a[$soort->getSoortId()] = $soort->getSoort();
	}
	//	__construct($name, array $values, $CSSclass=null, $title=null, $selected=null, $firstOption=null, $valueIsLabel=false, $multiple=false){
	$dd = new DropDown($name, $a, $CSSclass, $title, null,  "maak een keuze", false, $multiple);
	return $dd;
}

//************************************************************//

	public function kleurenDropdown($kleuren, $CSSclass=null){
/* genereert een keuzelijst voor de verschillende kleuren 

	@$kleuren	array
	@$CSSClass	string


*/
	if(!is_array($kleuren)) throw new Exception('argument lijst is geen array');
	
	$dd = new DropDown("kleur", $kleuren, $CSSclass, $title=null, null,  "maak een keuze", true, false);
	return $dd;
}

//************************************************************//
	
	public function arrayNaarTabelZKoppen($lijst, $CSSclass=null, $id=null){
		
    	// return: HTML table element ZONDER head, dus geen titels
		// $lijst:  array van waarden
		// $class: CSS class
		// $id: id
	
		$c = ($CSSclass==null)?"":" class='$CSSclass'";
		$i = ($id==null)?"":" id='$id'";
			
		$t = "<table $i $c>";
		$t .= "<tbody>";
		
		foreach($lijst as $item){
	
			$t .= "<tr>";
			$t .= "<td>".$item."</td>";
			$t .= "</tr>";
		}
		$t .= "</tbody>";
		$t .= "</table>";
		
    	return $t;
    } 
	
	public function arrayNaarTabelMKoppen($lijst, $CSSclass=null, $id=null){
		
    	// return: HTML table element MET head, dus met titels
		// $lijst:  2dim array van waarden, EERSTE RIJ BEVAT TITELS!
		// $class: CSS class
		// $id: id
		
		$aantalRijen = count($lijst); //aantal rijen
		$aantalKols = count($lijst[0]); //aantal kolommen
		
		$c = ($CSSclass==null)?"":" class='$CSSclass'";
		$i = ($id==null)?"":" id='$id'";
			
		$t = "<table $i $c>";
		//titels
		$t .= "<thead><tr>";
		for($i=0;$i<$aantalKols;$i++){
			$t .= "<th>".$lijst[0][$i]."</th>" ;
			}
		$t .= "</tr></thead>";
		
		//waarden
		$t .= "<tbody>";
		
		for($i=1;$i<$aantalRijen;$i++){
			//rijen
			$t .= "<tr>";
			//kolommen
			for($j=0;$j<$aantalKols;$j++){
				$t .= "<td>".$lijst[$i][$j]."</td>";
				}
			$t .= "</tr>";
		}
		
		$t .= "</tbody>";
		$t .= "</table>";
		
    	return $t;
    } 

//************************************************************//
public function XMLNaarTabel($xml, $CSSclass=null, $id=null){
	
    		// return: HTML table element
			// $xml: simplexml
			//	veronderstelt rij structuur: firstchild van root is rij
			// $class: CSS class
			// $id: id
	
		$koppen = array(); //array van subarrays: elke rij is een array met daarin een array van celgegevens
		$waarden= array();
		
		$rootElementName = $xml->getName();
		$aantalRijen = $xml->count();
		//if($aantalRijen>0)
		$rijen = $xml->children();
		$rijElementNaam = $rijen[0]->getName();
		
		//koppen. verplicht als array om eventueel subtitels toe te laten
		$koppen[0] =array(); //subarray van titles. Een eventuele tweede rij moet dan in $koppen[1] komen
		//velden
		foreach ($rijen[0] as $veld) {
				array_push($koppen[0],$veld->getName());  //kolomnamen
		}
			
		// de waarden
		foreach ($rijen as $rij=>$rijWaarde) {
			$velden = array();
			foreach ($rijWaarde as $veld=>$veldWaarde) {
					array_push($velden,$veldWaarde);
			}
			array_push($waarden,$velden);
		}
		
	
		//HTMLManager maakt de table
		//new Tabel($id, array $values, $koppen=null, $voet=null, $CSSclass=null)
		$t = new Tabel($id,$waarden,$koppen,null,$CSSclass);

    	return $t;
    } 
//************************************************************//	
	
	public function XMLNaarLijst($xml, $ulol="ul", $CSSclass=null, $id=null){
	
    		// return: HTML UL of OL element
			// $xml: simplexml
			// veronderstelt rij structuur: firstchild van root is rij
			// $ulol: ul of ol lijst, default ul
			// $class: CSS class
			// $id: id
	
		$waarden= array();
		
		$rootElementName 	= $xml->getName();
		$aantalRijen 		= $xml->count();
		//if($aantalRijen>0)
		$rijen				= $xml->children();
		$rijElementNaam 	= $rijen[0]->getName();
		
					
		// de waarden
		foreach ($rijen as $rij=>$rijWaarde) {
			//de waarden worden hier gewoon gecontacteneerd per rij
			$velden = array();
			foreach ($rijWaarde as $veld=>$veldWaarde) {
					array_push($velden,$veldWaarde);
			}
			//$str= substr(implode(" ", $velden),1); //verwijder eerste komma
			$str= implode("", $velden); //verwijder eerste komma
			array_push($waarden,$str);
		}
		
	
		//HTMLManager maakt de table
		//new Lijst( $ulol, array $values, $id, $CSSclass=null)
		$lijst = new Lijst($ulol,$waarden,$id,$CSSclass);

    	return $lijst;
    } 
//************************************************************//	
	
	

}//einde Class

?>