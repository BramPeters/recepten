<?php 

/*

FUNCTIES.INC.PHP

PHP functies allerhande
laatste versie: 1/12/2008



*/



/************************* ENTITEITEN ******************/


//gebruik een global keyword vooraleer ze te gebruiken in he script
	//HTML
	$strVerplicht="<span class='verplicht'>&#x25B2;</span>";
	//OPTION onderdelen
	$strSS = " selected='selected'"; 
	$strFO1 = "<option value='*' >---Allemaal---</option>\n"; // $firstOption=1
	$strFO2 = "<option value='*' >---Maak een keuze---</option>\n";// $firstOption=2
	$strFO3 = "<option value='0' >---Maak een keuze---</option>\n";// $firstOption=3
	$strFO4 = "<option value='' >---Maak een keuze---</option>\n";// $firstOption=4


/************************* ARRAYS ******************/


function overloopAssocArray($arr){
/*debug fucntie:
returned een string met html van key value paren van het array*/
$strArr="key => value <br />=========<br />";

  foreach($arr as $key => $value) {
  	$strArr.="$key => $value <br />";
  }
return $strArr;
}


/************************* DATES ******************/


$arrMaanden = array(1=>'januari',2=>'februari',3=>'maart',4=>'april',5=>'mei',6=>'juni',7=>'juli',8=>'augustus',9=>'september',10=>'oktober',11=>'november',12=>'december');
$arrWeekdagen= array(0=>"zondag",1=>"maandag",2=>"dinsdag",3=>"woensdag",4=>"donderdag",5=>"vrijdag",6=>"zaterdag");

//========huidige datum ========================

	$today=getdate(); //assoc array
	$vandaag = $today['mday'];
	$huidigeMaand = $today['mon'];
	$huidigJaar = $today['year'];
	$wdag = $today['wday']; //int dag vd week, zondag= 0, maandag = 1
	$strVandaag =  date('Y-m-d'); // string versie vb "2008-12-31"

///=========================================
function daysDifference($endDate, $beginDate)
{
/*
returned verschil in  dagen
date format string “YYYY-MM-DD”,
*/   
//explode the date by "-" and storing to array
   $date_parts1=explode("-", $beginDate);
   $date_parts2=explode("-", $endDate);
   //gregoriantojd() Converts a Gregorian date to Julian Day Count
   $start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
   $end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
   return $end_date - $start_date;
}
//=========================================
function vorigeMaandag($strDatum){
//returned een datumobject (timestamp) van de maandag vóór de ingegeven datum
// @strDatum		 een YYYY-MM-DD string
	$dag = strtotime($strDatum); //date object 
	$weekdag = intval(date('w', $dag)); //dag van week
	$aftrekken = ($weekdag==0)?6:$weekdag-1; //verschil
	$s = "$strDatum - $aftrekken days"; //string voor strtotime
	$vMaandag = strtotime($s);
	return $vMaandag;
}
/************************* MAIL ******************/

function send_message($to,$from,$cc,$subject,$message){
	//returned een boolean
		
		$additionalHeaders="";
		
		if(!empty($from)){ 
			$sender=$from;
		} 
		else{
			$sender="C-Files";
		}
		
		$additionalHeaders.="From:$sender";
		
		if((!empty($cc))||($cc!="")){ 
			$additionalHeaders.="\r\nCc:$cc";
		}
	// In case any of our lines are larger than 70 characters, we should use wordwrap()
	$message = wordwrap($message, 70);
	
	// Send
	if (mail($to, $subject, $message, $additionalHeaders)){
		return true;
	}
	else {return false;}
}

/*************************AANMAAK HTML ELEMENTEN ******************/

//********************
function maakKolomTitels($arr, $item, $header, $alle){
/*
maakt een TD/TH string van arrayitems
$arr				het array
$item				integer 0-x: de kolom van het twee-dim array
$header			true/false: is het in een <header> el? zoja dan th ipv td
$alle				boolean: indien true, negeer dan het tonen attrib
*/
	$strRij="";
	if($alle){
		for ($i=0;$i<count($arr);$i++){ //voor elke kolom
			
			$strRij .= ($header)?maakHeaderCel($arr[$i][$item],null):maakCel($arr[$i][$item],null);
			/*$strRij .= ($header)?"<th>":"<td>";
			$strRij .= "{$arr[$i][$item]}";
			$strRij .= ($header)?"</th>":"</td>";*/
		 }
	}
	else{
		for ($i=0;$i<count($arr);$i++){ //voor elke kolom
			if($arr[$i][3]==1){	
				$strRij .= ($header)?maakHeaderCel($arr[$i][$item],null):maakCel($arr[$i][$item],null);
				/*$strRij .= ($header)?"<th>":"<td>";
				$strRij .= "{$arr[$i][$item]}";
				$strRij .= ($header)?"</th>":"</td>";*/
		 	}
		 }
	}
	return $strRij;
} 
//********************
function maakTabel($inhoud, $klasse, $id){
/*returned een TABLE element
$inhoud		eender welke inhoud 
$klasse		CSS class/null 
$id		id/null 
*/
	$c = ($klasse==""||$klasse==null)?null:"class='$klasse'";
	$i = ($id==""||$id==null)?null:"id='.$id'";
	return "<table $c $i>".$inhoud."</table>\n";
}
//********************
function maakTHead($inhoud, $klasse){
/*returned een THEAD element
$inhoud		eender welke inhoud 
$klasse		CSS class/null 
*/
	$c = ($klasse==""||$klasse==null)?null:"class='$klasse'";
	return "<thead $c>".$inhoud."</thead>\n";
}
//********************
function maakTBody($inhoud, $klasse, $id){
/*returned een TBODY element
$inhoud		eender welke inhoud 
$klasse		CSS class/null 
*/
	$c = ($klasse==""||$klasse==null)?null:"class='$klasse'";
	$i = ($id==""||$id==null)?null:"id='.$id'";
	return "<tbody $c $i>".$inhoud."</tbody>\n";
}
//********************
function maakRij($inhoud, $klasse, $title=null){
/*returned een TR element
$inhoud		eender welke inhoud 
$klasse		CSS class/null
$title			title attrib/null
*/
	$c = ($klasse==""||$klasse==null)?null:"class='$klasse'";
	$t = ($title==""||$title==null)?null:"title='$title'";
	
	return "<tr $c $t>".$inhoud."</tr>\n";
}
//********************
function maakCel($inhoud, $klasse){
/*returned een TD element
$inhoud		eender welke inhoud 
$klasse		CSS class/null
*/
	$c = ($klasse==""||$klasse==null)?null:"class='$klasse'";
	return "<td $c>".$inhoud."</td>\n";
	
}
//********************
function maakHeaderCel($inhoud, $klasse){
/*returned een TH element
$inhoud		eender welke inhoud 
$klasse		CSS class/null
*/
	$c = ($klasse==""||$klasse==null)?null:"class='$klasse'";
	return "<th $c>".$inhoud."</th>\n";
}
//********************

function maakHidden($name,$waarde){
/*returned een INPUT TYPE HIDDEN element
$inhoud		eender welke inhoud 
*/
	return"<input type='hidden' name='".$name."' id='".$name."' value='".$waarde."'/>\n";
}

//********************
function maakLabel($inhoud,$verplicht=0){
/*returned een LABEL element
$inhoud		eender welke inhoud 
*/
global $strVerplicht;
	$v = ($verplicht==1)?$strVerplicht:"";
	return"<label>" . $inhoud . $v . "</label>";
}
//********************
function maakDiv($inhoud, $klasse, $title=null){
/*returned een DIV element
$inhoud		eender welke inhoud 
$klasse		CSS class/null
*/
	$c = ($klasse==""||$klasse==null)?null:"class='$klasse'";
	$t = ($title==""||$title==null)?null:"title='$title'";
	return "<div $c $t>".$inhoud."</div>";
}
//********************
function maakTekstInput($value, $name, $id=null, $width=null, $class=null,$disabled=false){
/*returned een INPUT type text  element
$value		value attrib
$name 		name attribuut, verplicht
$id			id attrib
$width		width attrib, integer
$disabled			boolean, true=> disabled='disabled'

*/
	$dis=($disabled===true)?"disabled='disabled'":"";

	if (!$name||$name=="") {
        throw new Exception('name argument verplicht');
    }
    else {
		$n = "name='$name'";
		$i = ($id==null||$id=="")?"id='$name'":"id='$id'";
		$w =($width==null||$width==""||!is_numeric($width))?null:"width='$width'";
		
		//$v = ($value==null)?"":$value;
		$val = "value='$value'";
		
		$strInput="<input type='text' $n $i $w $val class='".$class."' $dis />";
		return $strInput;
	}
}
//********************
function maakTekstArea($value, $name, $id, $cols,$rows,$disabled=false,$class=null){
/*returned een TEXTAREA   element
$value		value attrib
$name 		name attribuut, verplicht
$id			id attrib
$cols			aantal karakters hor, integer/null
$rows		aantal karakters vert, integer/null
$disabled			boolean, true=> disabled='disabled'

*/
	$dis=($disabled===true)?"disabled='disabled'":"";

	if (!$name||$name=="") {
        throw new Exception('name argument verplicht');
    }
    else {
		$n = "name='$name'";
		$i = ($id==null||$id=="")?"id='$name'":"id='$id'";
		$c =($cols==null||$cols==""||!is_numeric($cols))?null:"cols='$cols'";
		$r =($rows==null||$rows==""||!is_numeric($rows))?null:"rows='$rows'";
		
		$v = ($value==null)?"":$value;
	
		
		$strInput="<textarea $n $i $c $r class='".$class."' $dis>$v</textarea>";
		return $strInput;
	}
}

//********************
function makeSelectFromQuery($db, $qs, $selectName, $valueFieldInt, $textFieldInt, $titleFieldInt, $selectedVal, $firstOption,$disabled=false){
/*
returned een SELECT element ahv een querystring
de db conn moet gemaakt zijn!

fields via een fetch_row, dus integer

opmerking: optionale arguments moeten best altijd meegegeven worden met een null waarde:


$db					database via connenection
$qs					SQL statement, verplicht, string
$selectName		name en id voor de SELECT, verplicht, string
$valueFieldInt		index van het field voor het VALUE attrib van een OPTION element, verplicht, integer
$textFieldInt		index van het field voor de tekstinhoud, verplicht, integer
$titleFieldInt		index van het field voor het title attribuut, tekstinhoud, optioneel, integer
$selectedVal		value voor de option dat een selected='selected' meekrijgt indien identiek, optioneel, string
$firstOption		integer of null , steeds selected ($selectedInt	wordt genegeerd), optioneel, string
$disabled			boolean, true=> disabled='disabled'

*/

	global $strSS,$strFO1,$strFO2,$strFO3,$strFO4;
	
 	$strFO=null;
	
	$dis=($disabled===true)?"disabled='disabled'":"";
	
	if($titleFieldInt===null){$titleFieldInt==$valueFieldInt;}
	
	if($firstOption!==null){
		//als er een eerste option element nodig is
		switch ($firstOption) {
				case 1:
					$strFO=$strFO1;
					break;
				case 2:
					$strFO=$strFO2;
					break;
				case 3:
					$strFO=$strFO3;
					break;
				case 4:
					$strFO=$strFO4;
					break;
				}
		//$selectedVal = null;	
		}
	
	$strSelect = "\n<select name='".$selectName."' id='".$selectName."' $dis>\n"; //begin opbouw
	
	$strSelect .= $strFO; //plaats een eventueel eerste option element

	$r = $db->query($qs);

        if($r){
		
			if(!is_null($selectedVal)){
			
					while ($rij=$r->fetch_row())
					{
						$strSelect .=  "<option value='".$rij[$valueFieldInt]."' title='".$rij[$titleFieldInt]."'";
						
						if($rij[$valueFieldInt]==$selectedVal){$strSelect .=  $strSS;}
						
						$strSelect .=  ">".$rij[$textFieldInt]."</option>\n";
					}
			}
			else {
					while ($rij=$r->fetch_row())
					{
						$strSelect .=  "<option value='".$rij[$valueFieldInt]."'  title='".$rij[$titleFieldInt]."'>".$rij[$textFieldInt]."</option>\n";
					}
			}
		
			$r->close();
		}
		$strSelect .= "</select>\n";
		
	return $strSelect;
}
//********************
function makeSelectFromAssocArray( $array, $selectName,$selectedVal=null, $firstOption=null,$disabled=false, $class=null ){

/* genereert een option string van het array, meegegeven en 
selecteert de optie die overeenkomt met de huidge waarde 
converteert alles nr kleine letters

$array						assoc array waarvan de key de VALUE wordt en de waarde de TEXT in de option
$selectName				name en id voor de SELECT, verplicht, string
$selectedVal				value voor de option dat een selected='selected' meekrijgt indien identiek, optioneel, string
$firstOption				integer of null , steeds selected ($selectedInt	wordt genegeerd), optioneel, string
sdisabled					boolean, true=> disabled='disabled'

*/
global $strSS,$strFO1,$strFO2,$strFO3;
$strFO=null;
$dis=($disabled===true)?"disabled='disabled'":"";
	
	if(!is_null($firstOption)){
		//als er een eerste option element nodig is
		switch ($firstOption) {
				case 1:
					$strFO=$strFO1;
					break;
				case 2:
					$strFO=$strFO2;
					break;
				case 3:
					$strFO=$strFO3;
					break;
				}
		}
	//echo $selectedVal;

	$strSelect = "\n<select name='".$selectName."' id='".$selectName."' $dis>\n";//begin opbouw
	$strSelect .= $strFO; //plaats een eventueel eerste option element
	
	foreach ($array as $key => $value){
		$strSelect .="<option value='".$key."' ";
		
		if(!is_null($selectedVal)){			
				if ("$key"=="$selectedVal"){ //omzetten in string
					$strSelect .= $strSS;
				}
		}
		$strSelect .=">".strtolower($value)."</option>\n";
	}
	$strSelect .= "</select>\n";
	return $strSelect ;
}
//********************
function makeSelect($strOptions,$selectName, $class=null){

/* genereert een SELECT string waarvan de option door een andere fucntie aangeleverd moeten worden

$strOptions	Alle OPTION elementen als string
$selectName		het name attrib
$class		het class attrib

*/
	$strSelect = "\n<select name='".$selectName."' id='".$selectName."' class='".$class."'>\n";//begin opbouw
	$strSelect .= $strOptions;
	$strSelect .= "</select>\n";
	return $strSelect ;
}
//********************
function makeOptionsFromArray($huidigeWaarde, $tekstArray){

/* genereert een option string van het array, meegegeven en 
selecteert de optie die overeenkomt met de huidge waarde 
converteert alles nr kleine letters

$huidigeWaarde	de hudige geselecteerde waarde
$tekstArray		array
*/

$strOptions="";
	
foreach ($tekstArray as $el){
	$strOptions.="<option ";

	if (strtolower($el)==strtolower($huidigeWaarde)){
		$strOptions.="selected='selected'";
	}
	$strOptions.=">".strtolower($el)."</option>\n";
}

return $strOptions;
}
//*********************

function makeNumOptions($waarde, $min, $max){
/* geneert een string van numerieke option elementen met deze = waarde geselecteerd */

$strOptions="";

if (is_int($min) && is_int($max)){

	if(!empty($waarde)){
		
		$waarde=($waarde<$min)?$min:$waarde; //indien kleiner dan min, neem min
		$waarde=($waarde>$max)?$max:$waarde; //indien groter dan max, neem max
	
	}
	for ($i=$min;$i<=$max;$i++){
	
		$strOptions.="<option ";
		
		if (!empty($waarde)){
			if($i==$waarde){$strOptions .= "selected='selected'";	}
		}
		
		$strOptions.=">".$i."</option>\n";
	}
}
return $strOptions;
}

//********************

function makeABCOptions($waarde, $case, $laatsteletter){

/* geneert een string van ABC,... of abc,.. option elementen met de = $waarde geselecteerd */
// $case = 'l' / 'u' hoofd- kleine letters
// $laatsteletter = optionele laatste letter


$strOptions="";
$numEinde=25;

if(strtolower($case)=='l'||strtolower($case)=='u'){

	if(!empty($laatsteletter)||$laatsteletter!=""){
		$numEinde=ord(strtolower($laatsteletter))-97;
	}
	
	$toevoeging=($case=='l'?97:65); // startpunt voor Ucase/lcase
		
		for ($i=0;$i<=$numEinde;$i++){
			$strOptions.="<option ";
		
			if ($i+97==ord(strtolower($waarde))){
				$strOptions.="selected='selected'";
			}
		
			$strOptions.=">".chr($i+$toevoeging)."</option>";
		}
}
return $strOptions;
}

//********************

function makeYesNoDropdown($selectName,$yesValue,$noValue, $currentValue){
/* geneert een Select met zichtbare waarden en values 1/0 */
// $selectName : de naam van de select tag
// $YesValue,$NoValue : de woorden  die gebruikt worden in de dropdown: ja, nee, oui, non,...
// $currentValue : waarde uit db


$strOptions="";
$strYesSelected=($currentValue==1)?" selected='selected'":"";
$strNoSelected=($currentValue==0)?" selected='selected'":"";

if (!is_null($selectName)&&($selectName!="")){
	
	$strOptions.="<select name='".$selectName."' id='".$selectName."' >";
	$strOptions.="<option value='1'".$strYesSelected.">".$yesValue."</option>";
	$strOptions.="<option value='0'".$strNoSelected.">".$noValue."</option>";
	$strOptions.="</select>";
	}
return $strOptions;
}

//*********************

function makeCheckbox($waarde, $name, $id=null, $disabled=false){
//functie makeCheckbox
/* geneert een input type checkbox met een Boolean waarde 0/1,
gebruikt $name voor control */


//echo "$name met waarde $waarde heeft disabled op $disabled staan";

	$dis=($disabled===true)?"disabled='disabled'":"";

	if (!$name||$name=="") {  throw new Exception('name argument verplicht');   }
    else {
	
		if($waarde==0||$waarde==1){
	
			$n = "name='$name'";
			$i = ($id==null||$id=="")?"id='$name'":"id='$id'";
			
			if ($waarde==1){ 	$v = " value='1' checked='checked'";	}
			else {					$v = " value='0'";	}
			
			$strCheckbox ="<input type='checkbox' $n $i $v $dis />";
		}
		else{	 throw new Exception('waarde $waarde moet 0/1 zijn');	}
	
}

return $strCheckbox;
}


//*********************

function makeRadiobutton($waarde, $name, $id, $disabled=false){
//functie makeRadiobutton
/* geneert een input type radio met een Boolean waarde 0/1,
gebruikt $name voor control 
maar kan een aparte id hebben

*/

$strRadio="";

if (is_int($waarde)){

	if ($waarde==0||$waarde==1){
		
		$strRadio="<input type='radio' name='".$name."' ";

		if ($waarde==1){
			$strRadio.= " value='1' checked='checked'";
			}
		else {
			$strRadio.= " value='0'";
		}
		if ($disabled==true){
			$strRadio.= " disabled='disabled'";
			}
		
		$strRadio.=" />";
		}
	
}
else {$strRadio="fout";}
return $strRadio;
}
/*************************VANALLES******************/

//functie escapeSmart

if(!function_exists('escapeSmart')){
// Quote variable to make safe
function escapeSmart($value)
{
   // Stripslashes
   if (get_magic_quotes_gpc()) {
       $value = stripslashes($value);
   }
   // Quote if not integer
   if (!is_numeric($value)) {
       $value = mysql_escape_string($value);
   }
   return $value;
}
}

//functie escapeInput

function escapeInput($input) { 
    if (!get_magic_quotes_gpc()) { 
        $input = addslashes($input); 
        } 
    return $input; 
    } 

// function redirect

function redirect($time, $topage) {
    echo "<meta http-equiv=\"refresh\" content=\"{$time}; url={$topage}\" />";
    }

//function is_email

function is_email($emailadres){   
    if (strlen($emailadres) < 7) {
        return false;
        }
    if (ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,5})$", $emailadres)) {
		// laatste deel was ([a-zA-Z]{2,4})$
		//aangepast tot 5 om 'local' toe te laten als domain
        return true;
        } 
    else {
        return false;
        }
    }

//functie maakt bestelformulier per soort ????????????? WAAR WORDT DIT GEBRUIKT??
function bestel_per_soort($soort){
    $sql = "select artID, naam, omschrijving, prijs, promoprijs from artikel where soort = '$soort'";
    $r = mysql_query($sql);
    while (list($artID, $naam, $omschrijving, $prijs, $promoprijs) = mysql_fetch_row($r)){
        $artID = escapeInput($artID);
	    $naam = escapeInput($naam);
	    $omschrijving = escapeInput($omschrijving);
	    $prijs = escapeInput($prijs);
	    $promoprijs = escapeInput($promoprijs);
        if ($omschrijving == "" || $omschrijving == "NULL"){
	        $omschrijving = "&nbsp;";
		    }
	    if ($promoprijs != 0){
	        $prijs = $prijs - $promoprijs;
		    }
	    $td = "<td class='$soort'>";
	    $tdn = "<td class='$soort' width='160px'>";
	    $tdo = "<td class='$soort' width='220px'>";
        print ("<tr>$td<input size=\"1\"type=\"text\" name=\"$artID\" maxlength=\"2\"></td>$tdn$naam</td>$tdo$omschrijving</td>$td$prijs</td></tr>"); 
	    }
	}

//functie maakt bestelformulier per soort met 2 radiobuttons????????????? WAAR WORDT DIT GEBRUIKT??
function bestel_radio($soort){
    $sql = "select artID, naam, omschrijving, prijs, promoprijs from artikel where soort = '$soort'";
    $r = mysql_query($sql);
    while (list($artID, $naam, $omschrijving, $prijs, $promoprijs) = mysql_fetch_row($r)){
        $artID = escapeInput($artID);
	    $naam = escapeInput($naam);
	    $omschrijving = escapeInput($omschrijving);
	    $prijs = escapeInput($prijs);
	    $promoprijs = escapeInput($promoprijs);
        if ($omschrijving == ""|| $omschrijving == "NULL"){
	        $omschrijving = "&nbsp;";
		    }
	    if ($promoprijs != 0){
	        $prijs = $prijs - $promoprijs;
		    }
	    $td = "<td class='$soort'>";
	    $tdn = "<td class='$soort' width='160px'>";
	    $tdo = "<td class='$soort' width='220px'>";
		$opt = $artID + 1000;
		$opties= "<INPUT TYPE='RADIO' NAME=\"$opt\" VALUE='r' CHECKED />rijst<BR><INPUT TYPE='RADIO' NAME='$opt' VALUE='p' />patat";
        print ("<tr>$td<input size=\"1\"type=\"text\" name=\"$artID\" maxlength=\"2\"></td>$tdn$naam</td>$td$opties</td>$tdo$omschrijving</td>$td$prijs</td></tr>"); 
	    }
	
	}
	
?>