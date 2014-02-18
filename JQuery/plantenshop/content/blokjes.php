<?php
/*
	service om blokjes voor zijbalk te leveren via functies

*/

//=== includes, Classes===============================================================

require_once("data/grusoniadao.php"); //pad steeds vanuit de controller
require_once("man/displayManager.php"); 
require_once("man/HTMLManager.php"); 

$Grus 	= new GrusoniaDAO();
$DM 	= new DisplayManager();



//=== FUNCTIES========================================================================

function getTestKnop(){
	//tesknop om in JS script fucnties te testen
	//gebruik in opnderstaande fucnties in inhoud
	$str =  "<button type='button' id='testknop'>testknop</button>";
	return $str;
	}


//*************************************************

function getBlokjeBestuur(){
	//blokje het bestuur
	global $Grus;
	
	//bestuur
	$bestuur 	= $Grus->getArrayAlleBestuurleden();
	//var_dump($arrBestuur);
	$strBestuur	= "";
	
	foreach($bestuur as $bestuurslid){
		$strBestuur .= "<div class='bestuurslid'>";
		$strBestuur .= "<img src='images/bestuur/".$bestuurslid->getFoto().".jpg' title='".$bestuurslid->getNaam()."' alt='".$bestuurslid->getNaam()."' />";
		$strBestuur .= "<a class='stuurmailtje' href='#' data-id='".$bestuurslid->getId()."' data-naam='".$bestuurslid->getNaam()."' title='stuur een mailtje naar ".$bestuurslid->getNaam()."' >".$bestuurslid->getNaam()."</a><br />";
		$strBestuur .= $bestuurslid->getFunctie()."<br />".$bestuurslid->getStraat()."<br />";
		$strBestuur .= $bestuurslid->getPostcode()." ".$bestuurslid->getGemeente()."<br />";
		$strBestuur .= "</div>";
		}
	
	//======output===================
	
	$str =  "<!-- start vaste tekst -->
	<!-- start blokje -->
	<div class='blokje ikoon ' id='bestuur'>";
	$str .= "<h2>Het bestuur:</h2>";
	
	$str .= $strBestuur;
	$str .= "<!-- einde blokje --></div>";
	//einde blokje niet vergeten!
	return $str;
	
	}

//*************************************************

function getBlokjeBinnenkort(){
	//blokje Binnekort op de agenda
	global $Grus;
	global $DM;
	//binnenkort ul lijstje
	$lijst = $Grus->getXMLKalenderBinnenkort();
	$lijst = simplexml_load_string($lijst);
	//XMLNaarLijst($xml, $ulol="ul", $CSSclass=null, $id=null){
	$lijst_bk =$DM->XMLNaarLijst($lijst,"ul",null,"binnenkort");
	$bk_lijst = $lijst_bk->parse();
	
	
	//======output===================
	
	$str =  "<!-- start vaste tekst -->
	<!-- start blokje -->
	<div class='blokje ikoon' id='binnenkort'>";
	$str .= "<h2>binnenkort:</h2>";
	$str .= $bk_lijst;
	$str .= "<!-- einde blokje --></div>";
	//einde blokje niet vergeten!
	return $str;
	}
//*************************************************

function getBlokjeInlichtingen(){
	//blokje inlichtingen
	$str =  "<!-- start vaste tekst -->
	<!-- start blokje -->
	<div class='blokje ikoon' id='inlichtingen'>";
	$str .= "<h2>Inlichtingen:</h2>";
	$str .= "<p>Wil je meer weten of heb je een vraag over de club?<br />
	<a href='index.php?page=mail'>Stuur ons een mailtje</a><br />
	(vragen AT grusonia.be)</p>";
	
	$str .= "<!-- einde blokje --></div>";
	//einde blokje niet vergeten!
	return $str;
	
	}
	
	

//*************************************************

function getInfokaartBlokjes(){
	//return de info blokjes voor de rechterkolom van het genus
	
	
  	$str 	 = "<!-- start blokje -->";
	$str 	.= "<div class='blokje ikoon' id='kaart'>";
	
	$str 	.= "<div class='nl'>";	
	$str 	.= "<h2>Locatie toevoegen?</h2>";	
	//$str 	.= getTestKnop();	
	$str 	.= "<p>Wilt u ook uw locatie op deze kaart aanbrengen? <br /><a id='link_locatieToevoegen_nl' href='#'>stuur een verzoekje naar de webmaster</a> met de <em>naam</em> van de locatie, het <em>volledige adres</em> en eventuele <em>andere info</em> die uw erbij wil (tel, gsm, email, www, ...). Een <em>fotootje</em> is ook mogelijk: stuur dat afzonderlijk op naar de <i>webmaster AT grusonia.be</i>. <br />
Een voorwaarde: houdt verband met cactussen/vetplanten.</p>";
  	$str 	.= "</div>";
  	
	$str 	.= "<div class='uk' style='display:none;'>";	
	$str 	.= "<h2>Add your location?</h2>";		
	$str 	.= "<p>Would you like to add your location to this map?  <br /><a id='link_locatieToevoegen_fr' href='#'>send a request to the webmaster</a> stating the <em>name</em> of the location, the <em>full address</em> and optionally  any <em>addtional info</em> you want to include (tel, mobile, email, www, ...). An <em>image</em> is possible as well: send it separately to the <i>webmaster AT grusonia.be</i> by email. <br />
One condition: cactus/succulent related.</p>";
  	$str 	.= "</div>";
	
	$str 	.= "<div class='fr' style='display:none;'>";	
	$str 	.= "<h2>Ajouter votre location?</h2>";		
	$str 	.= "<p>Voulez vous ajouter votre location sur cette carte? <br /><a id='link_locatieToevoegen_fr' href='#'>Envoyez votre demande au webmaster</a> sans oublier le <em>lieu</em>, <em>l'adresse compl&egrave;te</em> et &eacute;ventuellement <em>d'autres informations</em> que vous d&eacute;sirez voir para&icirc;tre, tels que : num&eacute;ro de t&eacute;l&eacute;phone, de GSM, adresse email, www....Une <em>petite photo</em> est &eacute;galement possible : veuillez l'envoyer s&eacute;par&eacute;ment au <i>webmaster AT grusonia.be</i>. <br />
Une condition:  rapport avec des cactus/succulents.</p>";
  	$str 	.= "</div>";
	
	$str 	.= "<!-- einde blokje --></div>";
  
	
  	return $str;
}

//*************************************************

function getGruskaartBlokjes(){
	//return de info blokjes voor de rechterkolom van het genus
	
	
  	$str 	 = "<!-- start blokje --><div class='blokje ikoon' id='kaart'>";
	$str 	.= "<h2>Locatie toevoegen?</h2>";		
	$str 	.= "<p>het komt</p>";
  	$str 	.= "<!-- einde blokje --></div>";
  
	
  	return $str;
}
//*************************************************

function getOpendeurToevoegenBlokje(){
	//return de info blokjes voor de rechterkolom van het genus
	
	
  	$str 	 = "<!-- start blokje -->";
	$str 	.= "<div class='blokje ikoon' id='kaart'>";
	
	$str 	.= "<div class='nl'>";	
	$str 	.= "<h2>Opendeurdag toevoegen?</h2>";	
	//$str 	.= getTestKnop();	
	$str 	.= "<p>Wilt u ook uw opendeurdag op de website toevoegen? U moet geen lid van Grusonia zijn, uw evenement of opendeurdag moet enkel een 'plantaardig' karakter hebben!</p><p><a id='lienk_toevoegen' href='#'>Voeg opendeurdag toe</a></p>";
  	$str 	.= "</div>";
  
	$str 	.= "<!-- einde blokje --></div>";
  
	
  	return $str;
}

//*************************************************

?>