<?php
/*
	formcontent voor modal dialogs e.a.

*/

//=== includes, Classes===============================================================

require_once("data/grusoniadao.php"); //pad steeds vanuit de controller
require_once("man/displayManager.php"); 
require_once("man/HTMLManager.php"); 

$Grus 	= new GrusoniaDAO();
$DM 	= new DisplayManager();



//=== getForm FUNCTIES========================================================================



//*************************************************

function getFormMailBestuurslid(){
	//mailtje nr bestuurslid
		$str ="
<!--dialog form-->

<div id='dialog_frm' title='stuur een mailtje naar een bestuurslid' style='display:none'>
  <form class='ui-widget ui-widget-content dialog' id='frm_data' name='frm_data'>
  <input type='hidden' name='bid' id='bid' value='' />
    <fieldset>
      <legend>bericht aan <span id='bnaam'></span></legend>
	  <p class='tekst'>Velden met een <span class='verplicht'>!</span> zijn verplicht in te vullen</p>
      <div >
        <label for='naam'>uw naam<span class='verplicht'>!</span></label>
        <input class='lang' type='text' name='naam' id='naam' alt='uw volledige naam' title='uw volledige naam'  >
      </div>
     <div>
        <label for='email'>uw emailadres<span class='verplicht'>!</span></label>
        <input class='lang' type='text' name='email' id='email' alt='uw emailadres' title='uw emailadres' />
      </div>
	   <div>
        <label for='bericht' class='info'>uw bericht</label>
        <textarea name='bericht' id='bericht' alt='uw bericht' title='uw bericht' rows='10' cols='10'></textarea>
      </div>
	 </fieldset>  
    <fieldset id='fs_as' >
      <legend>anti-spam vraag <span class='verplicht'>!</span></legend>
	  <p>Deze vraag dient om spammers buiten te houden, dank u voor uw moeite! <br />Beantwoorden met &eacute;&eacute;n <b>woord</b>, in kleine letters</p>
      <div id='as'>
        <label for='aw' class='boven as' ></label>
        <input class='lang'  type='text' name='aw' id='aw' alt='bent u een me? dit is een anti-spam vraag' title='bent u een mens? dit is een anti-spam vraag' />
      </div>
    </fieldset>
  </form>
  <!--einde dialog form-->
  ";
	
	//return statement nodig voor output include in een variabele
	
	return $str; 
}

//*************************************************

function getFormInfokaart_nl(){
	//locatie toevoegen infokaart
		$str ="
<!--dialog form-->

<div id='dialog_frm' title='locatie toevoegen' style='display:none'>
  <form class='ui-widget ui-widget-content dialog' id='frm_data' name='frm_data'>
    <fieldset>
      <legend>locatiegegevens</legend>
	  <p class='tekst'>Velden met een <span class='verplicht'>!</span> zijn verplicht in te vullen</p>
      <div >
        <label for='titel'>titel<span class='verplicht'>!</span></label>
        <input class='lang' type='text' name='titel' id='titel' alt='Titel voor aanduiding van de locatie, dat kan uw naam zijn, een bedrijfsnaam, etc..' title='Titel voor aanduiding van de locatie, dat kan uw naam zijn, een bedrijfsnaam, etc..'  >
      </div>
      <div>
        <label for='straat' >straat + huisnr<span class='verplicht'>!</span></label>
        <input class='lang' type='text' name='straat' id='straat' alt='straat + huisnummer' title='straat + huisnummer' />
      </div>
	  <div>
        <label for='postnr'>Postnummer<span class='verplicht'>!</span></label>
        <input class='lang' type='text' name='postnr' id='postnr' alt='straat + huisnummer' title='straat + huisnummer' />
      </div>
	  <div>
        <label for='gemeente' >gemeente<span class='verplicht'>!</span></label>
        <input class='lang' type='text' name='gemeente' id='gemeente' alt='straat + huisnummer' title='straat + huisnummer' />
      </div>
	   <div>
        <label for='land' >land</label>
        <input class='lang' type='text' name='land' id='land' alt='land' title='land' />
      </div>
       <div>
        <label for='info'>andere info</label>
        <textarea name='info' id='info' alt='info' title='info: email, telefoon, etc...' rows='4' cols='10'></textarea>
      </div>
    </fieldset>
	  <fieldset>
      <legend>andere</legend>
	   <div>
        <label for='email'>uw emailadres<span class='verplicht'>!</span></label>
        <input class='lang' type='text' name='email' id='email' alt='uw emailadres' title='uw emailadres' />
      </div><div>
        <label for='opmerkingen' class='info'>opmerkingen vr de webmaster</label>
        <textarea name='opmerkingen' id='opmerkingen' alt='opmerkingen voor de webmaster' title='voor de webmaster' rows='4' cols='10'></textarea>
      </div>
	 </fieldset>  
    <fieldset id='fs_as' >
      <legend>anti-spam vraag <span class='verplicht'>!</span></legend>
	  <p>Deze vraag dient om spammers buiten te houden, dank u voor de moeite. <br />Beantwoorden met &eacute;&eacute;n woord, in kleine letters</p>
      <div id='as'>
        <label for='aw' class='boven as' ></label>
        <input class='lang'  type='text' name='aw' id='aw' alt='bent u een me? dit is een anti-spam vraag' title='bent u een mens? dit is een anti-spam vraag' />
      </div>
    </fieldset>
  </form>
  <!--einde dialog form-->
  ";
	
	//return statement nodig voor output include in een variabele
	
	return $str; 
}
//*************************************************

function getFormOpendeurToevoegen(){
	//opendeurdag toevoegen 
	global $Grus;
	global $DM;
	
	$arrCactusclubs 	= $Grus->getArray_cactusclubs(); //array
	//dropdown	__construct($name, array $values, $CSSclass=null, $title=null, $selected=null, $firstOption=null, $valueIsLabel=false, $multiple=false){
	$dd_cc 	= new DropDown("club_id", $arrCactusclubs,null,null,null,null,true,null); //value = label
	$cc_dd	= $dd_cc->parse();
	
	$str = "
<!--dialog form-->

<div id='dialog_frm' title='opendurdag toevoegen' style='display:none'>
  <form class='ui-widget ui-widget-content dialog' id='frm_data' name='frm_data'>
    <fieldset>
      <legend>bij wie en waar?</legend>
	  <p class='tekst'>Velden met een <span class='verplicht'>!</span> zijn verplicht in te vullen</p>
      <div >
        <label for='wie'>voornaam + naam<span class='verplicht'>!</span></label>
        <input class='lang' type='text' name='wie' id='wie' alt='Bij wie wordt de opendeur gegeven? / wie is de organisator?' title='Bij wie wordt de opendeur gegeven? / wie is de organisator?'  >
      </div>
      <div>
        <label for='adres' >straat huisnr,<br />postnr gemeente<span class='verplicht'>!</span></label>
        <input class='lang' type='text' name='adres' id='adres' alt='volledig adres, vb: cactustraat 111, 8400 Oostende' title='volledig adres, vb: cactustraat 111, 8400 Oostende' />
      </div>
	   <div>
        <label for='email'>email</label>
        <input class='lang required_group' type='text' name='email' id='email' alt='een emailadres waar inlichtingen kunnen bekomen worden' title='een emailadres waar inlichtingen kunnen bekomen worden' />
      </div>
	  <div>
        <label for='tel'>telefoon<span class='verplicht'>!</span></label>
        <input class='lang required_group' type='text' name='tel' id='tel' alt='het telefoonnr waar u te bereiken bent' title='het telefoonnr waar u te bereiken bent' />
      </div>
    </fieldset>
	<fieldset>
      <legend>het evenement</legend>
	  
	  <div>
        <label for='type_evenement' class='info'>type evenement</label>
       <select name='type_evenement' id='type_evenement'><option>opendeurdag</option><option>beurs</option></select>
      </div>
	 <div>
        <label for='start_datum'>startdatum<span class='verplicht'>!</span></label>
        <input class='lang datum' type='text' name='start_datum' id='start_datum' alt='de eerste dag' title='de eerste dag' />
      </div>
	  <div>
        <label for='eind_datum'>einddatum<span class='verplicht'>!</span></label>
        <input class='lang datum' type='text' name='eind_datum' id='eind_datum' alt='de laatste dag (niet invullen indien slechts 1 dag)' title='de laatste dag (niet invullen indien slechts 1 dag)' />
      </div>
	  <div>
        <label for='uur'>uur<span class='verplicht'>!</span></label>
        <input class='lang' type='text' name='uur' id='uur' alt='het beginuur (9u.) of de duurtijd (9u-17u)' title='het beginuur (9u.) of de duurtijd (9u-17u)' />
      </div>
	  <div>
        <label for='tekst' class='info'>meer uitleg?<br />(kort!)</label>
        <textarea name='tekst' id='tekst' alt='eventuele begeleidende tekst' title='eventuele begeleidende tekst' rows='4' cols='10'></textarea>
      </div>
	 </fieldset>  
    <fieldset id='fs_as' >
      <legend>anti-spam vraag <span class='verplicht'>!</span></legend>
	  <p>Deze vraag dient om spammers buiten te houden, dank u voor de moeite. <br />Beantwoorden met &eacute;&eacute;n woord, in kleine letters</p>
      <div id='as'>
        <label for='aw' class='boven as' ></label>
        <input class='lang'  type='text' name='aw' id='aw' alt='bent u een me? dit is een anti-spam vraag' title='bent u een mens? dit is een anti-spam vraag' />
      </div>
    </fieldset>
  </form>
  <!--einde dialog form-->
  ";
	
	//return statement nodig voor output include in een variabele
	
	return $str; 
}

//*************************************************
?>