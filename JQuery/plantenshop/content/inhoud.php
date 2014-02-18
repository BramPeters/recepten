<?php

/*
  content service via functies
  levert html fragmenten
 */

//=== includes, Classes===============================================================

require_once("services/plantenservice.php");

$PS = new PlantenService();

//=== ondersteunende functies========================================================================

function getScriptElements($arrScriptSources) {
    //returned een JS script element voor invoegen van specifieke scripts
    // @arrScriptSources	 array met url's of String met URL
    $str = "";
    if (is_array($arrScriptSources)) {
        foreach ($arrScriptSources as $source) {
            $str .= "<script type='text/javascript' src='" . $source . "'></script>";
        }
    } else {
        $str .= "<script type='text/javascript' src='" . $arrScriptSources . "'></script>";
    }
    return $str;
}

function getLinkElements($arrLinkSources) {
    //returned een link element voor invoegen van specifieke stylesheets
    // @arrLinkSources	 array met url's of String met URL
    $str = "";
    if (is_array($arrLinkSources)) {
        foreach ($arrLinkSources as $source) {
            $str .= "<link type='text/css' rel='stylesheet' href='" . $source . "' />";
        }
    } else {
        $str .= "<link type='text/css' rel='stylesheet' href='" . $arrLinkSources . "' />";
    }
    return $str;
}

//=== getInhoud FUNCTIES========================================================================

function getMenu() {
    //menu
    $str = "<ul id='menu'>
				<li><a href='index.php'>Home</a></li>
				<li><a href='index.php?page=shop'>Plantenshop</a></li>
                                <li><a href='index.php?page=ajaxshop'>AjaxShop</a></li>
				<li><a href='index.php?page=zorg'>Verzorging</a></li>
				<li><a href='index.php?page=galerij'>Galerij</a></li>
				<li><a href='index.php?page=about'>Over ons</a></li>
			</ul>";

    return $str;
}

//*************************************************
function getFoutePagina() {
    //foutbericht
    $str = "<div class='foutbericht'>";
    $str .= "Deze pagina kan niet gevonden worden. <a href='index.php'>Keer terug naar de startpagina</a>";
    $str .= "</div><!-- einde #foutbericht -->";

    return $str;
}

//*************************************************
function getHome() {
    //Home pagina
    $str = "
		<section>
		<h2>Onze keuzes</h2>
    	<p>Als zoon van een Vlaamse boomkweker ben ik in 1931 een kwekerij begonnen, met een oppervlakte van ongeveer 6000 m2. 	In de eerste jaren kweekte ik voornamelijk bomen en struiken en als hobby, vaste planten. In de loop der jaren werd ons assortiment uitgebreid zodat we nu het volledige areaal buitenplanten bezitten. De oppervlakte van de kwekerij is nu ruim 15.000 m2 en alle planten, bestemd voor de verkoop, worden in de pot gekweekt. Het assortiment bestaat uit ca. 4000 soorten  planten, waarop wij trots zijn en durven te beweren dat een dergelijke sortering niet gemakkelijk, waar dan ook, in Europa te vinden zal zijn. 
		</p>
  		</section>
  
  <!--start keuzes-->
  <section id='keuzes'>
    <h3>Een- en tweejarigen</h3>
	 <div>
    <p>Een- en tweejarigen kunt u zelf zaaien. Deze planten bloeien vaak meer en langer dan vaste planten en brengen kleur en variatie. Daarnaast kunnen zij goed leemtes vullen in de border. Een- en tweejarigen zijn te krijgen in vele verschillende vormen, van hele kleine tere plantjes tot klimmers die in onafzienbare tijd uw muur of schutting bedekken met een kleurige bloemenpracht. <a href='shop.php?soort_id=3'>Bekijk onze selectie Een- en tweejarigen</a></p>
  </div>
  <h3>Kruiden, vaste planten en heide</h3>
  <div>    
    <p>De groep vaste planten omvat kruidachtige planten die geen houtige takken vormen. Een groot deel van deze planten sterven in de winter bovengronds af, maar schieten elk jaar terug vanuit een overblijvend wortelstelsel. Een klein deel van de vaste planten zijn groenblijvend en zijn in de winter ook decoratief (een aantal zijn zelfs winterbloeiers). Vaste planten worden in pot gekweekt en kunnen dus het ganse jaar aangeplant worden. Ze staan in serre 5 en 6 alfabetisch gerangschikt.<a href='shop.php?soort_id=8'>kies een vaste plant</a></p>
  </div>
   <h3>Bomen en struiken</h3>
   <div>
   
    <p>Van oudsher is dit onze specialiteit. Bij ons vindt u dan ook een uitgelezen selectie van inheemse bomen en struiken ideaal voor alle 'echt' groen beplantingen.<a href='shop.php?soort_id=4'>zoek tussen bomen en struiken</a></p>
  </div>
   <h3>Klimplanten en gevelplanten</h3>
   <div>   
    <p>Een tuin kan niet zonder verticale accenten. Klimplanten zijn daarvoor de ideale versierders, ter verfraaiing van een muur, prieel of pergola of om een lelijk hekwerk aan het oog te onttrekken. Elke klimplant heeft wel iets aantrekkelijks, een rijke bloei, een mooi blad, opvallende bessen. Kortom in de meeste tuinen is er wel een plaatsje dat door een gepaste klimplant verfraaid kan worden. Bovendien zijn ze ook zeer geschikt voor kleine tuinen en zelfs voor geveltuintjes omdat ze zo weinig ruimte innemen in de grond. <a href='shop.php?soort_id=5'>beklim onze lijst</a></p>
     </div>
    
    <h3>Water- en vijverplanten</h3>
     <div><p>Waterplanten noemen we vaak vijverplanten, ze zijn een absolute noodzaak om tot een biologisch evenwicht te komen!  Waterplanten zijn dus planten die groeien in of onder het water. Tot deze categorie behoren drijfplanten, onderwaterplanten, moerasplanten en waterlelies. Zuurstofplanten zijn meestal ook onderwaterplanten (er zijn uitzonderingen). Andere buitenbeentjes zijn de (natte) oeverplanten... zij groeien niet graag in of onder het water maar houden vooral van een natte, vochtige bodem en planten we daarom meestal rondom de vijver aan. <a href='shop.php?soort_id=7'>trek uw laarzen aan voor onze keuze waterplanten</a></p>
  </div>
 </section>
 <!--einde keuzes-->
  	<section>
    <h2>Altijd groen</h2>
    <div class='kol_half'>De 'PlantenShop' in JungleCreek heeft meer dan 100 jaar ervaring in het kweken, verkopen en verhuren van planten, bomen - en bloemen. Zonder planten en bloemen mist uw huis, uw winkel, uw vergadering de zo noodzakelijke sfeervolle uitstraling. Of het nu gaat om uw stand op een vak- of publieksbeurs, een congres, een productpresentatie, een landelijke of regionale dealerbijeenkomst, een symposium, een modeshow of een feest voor uw personeel, groene planten en kleurrijke bloemen creëren een sfeervolle ambiance. Onze kleurenbrochure geeft een goede indruk van ons leveringsprogramma. Vanzelfsprekend adviseren wij U graag bij uw keuze.
    </div>
    <div class='kol_half'>Bijzonder fraai zijn onze moderne aluminium cilinderbakken met planten. Ook leverbaar zijn planten in rieten manden of terracotta potten, pergola's, houten scheidingswandjes, bruggetjes, banken etc. Bovendien kan Elka Plant uw bloemperken en tuinpartijen completeren met aantrekkelijke waterpartijen zoals kleine en grotere watervallen en vijvers in verschillende vormen en afmetingen, met daarin exclusief fonteinen en waterzuilen, compleet met onderwater verlichting. Zeer spectaculair is de speciale waterstraal, die vele meters overbrugt en - d.m.v. elektronische programmering - lange en korte 'stukjes' waterstraal kan spuiten. Neemt u contact met ons op, zodat wij gezamenlijk uw project kunnen bespreken. Het resultaat zal een perfecte presentatie zijn.
    </div>
  </section>";

    return $str;
}

//*************************************************
function getAbout() {
//about pagina

    $str = "<article>
<h2>Wie zijn we en wat doen we?</h2>

<section class='no-toc overbodig'>
<div id='toc'>Hier komt de automatische inhoudstafel. Het feit dat u dit leest duidt op een probleem: activeer dan Javascript en ververs de pagina</div>
</section>
<section id='bedrijf'>

  <h2>Ons bedrijf</h2>
  <section id='wie'>
  <h3 >Wie zij we?</h3>
  <p>De huidige bedrijfsleider Jan De Man stichtte  in 1975 de vasteplantenkwekerij in Oostende. Na de studies van softwareingenieur aan het hoger rijksinstituut voor tuinbouw te Diksmuide en een vijtal jaren werken in een boomkwekerij annex tuinaanlegbedrijf startte hij met zijn levenswerk. Met enkele duizenden plantjes afkomstig van gekregen vaste planten van kennissen en familie werden in de tuin (1000m²) van het schamele huurpand in het Mostenveld de eerste centjes verdiend. </p>
  <p>De catalogus (oplage 3.500 stuks) groeit verder uit tot een zeer intensief gebruikt hulpmiddel voor tuinarchitecten, tuinaanleggers,tuincentra, steden en gemeenten, studenten tuinbouw, particulieren.</p>
  <p>Momenteel stelt de kwekerij een 15-tal personen te werk. 3 familieleden, een 12-tal vaste arbeidskrachten; in de drukke perioden aangevuld met een aantal werkwillige piekarbeiders of jobstudenten. </p>
  </section>
  <section id='team'>
  <h3>Ons team</h3>
  <!--dynamische team inhoud hier-->
  </section>
  <section id='contact'>
  <h3>Contacteer ons</h3>
  <p>Tel. 059 55 20 78 Fax. 059 70 40 99</p>
  <p><a href='mailto:info@deplantenshop.be'>info@deplantenshop.be</a></p>
  </section>
  <section id='waar'>
  <h3 >Waar vind je ons?</h3>
  <p>Archimedesstraat 4-6<br />
    8400 Oostende</p>
  <p>kaart komt hier</p>
	</section>
</section>
<section id='nieuws'>
  <h2>Nieuws</h2>
  
  
  <section id='opendeur2009'>
  <h3>Opendeurdagen 2009 </h3>
  <p>19 en 20 september, 10-18h, 's middags doorlopend open. Doorlopend toepassingen van vaste planten: </p>
  <ul>
    <li>In een wilde en speelse vorm (prairietuinen) en een strakke en sobere vorm (bloembakken)</li>
    <li>Geleide uitleg over ons waterrecirculatiesysteem </li>
    <li>Standje met bijzondere één- en tweejarigen (Lieve Adriaenssens / Silene) </li>
    <li>Standje met boekenverkoop 'De prairietuin' (auteurs: Laurence Machiels &amp; Jan Spruyt – ISBN 978-90-5856-277-7) </li>
  </ul>
  <p>Mogelijkheid tot aankopen. Bestellingen kunnen worden klaargezet als ze een week op voorhand aan ons worden overgemaakt (www/tel/fax/mail). </p>
  </section>
  <section id='opendeur2008'>
  <h3>Opendeurdagen 2008 </h3>
  <p>zaterdag 20 &amp; zondag 21 september <br />
    Opnieuw werden we getrakteerd op goed weer en een mooie opkomst. Doorlopend waren er ook volgende extra's: </p>
  <ul>
    <li>Voordrachten over de kwekerij in 't algemeen, met een nadruk op voorbije investering i.f.v. waterrecirculatie. </li>
    <li>Voordrachten over prairiebeplantingen (Jan Spruyt) </li>
    <li>Stand van Het Kruidenonderonsje met culinaire, geneeskrachtige en cosmetische producten op basis van vaste planten (Laura &amp; Karine) </li>
    <li>Cursus bloemschikken (Ludo Annaert &amp; Stef Roosen) </li>
  </ul>
  <p>Bedankt en tot volgend jaar. Uitzonderlijk viel 'Op de Siertoer' dit jaar op zo.14/09 i.p.v. samen met zondag van onze opendeur. </p>
	</section>
</section>
<section id='materialen'>
<h2>Materialen</h2>
<section id='potten'>
<h3>Terracota bloempotten</h3>
<p>Hier vindt u de prijzen voor onze terracotta boempotten:</p>
<table class='cursus'>
  <thead>
    <tr>
      <th>type</th>
      <th>grootte</th>
      <th>prijs</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Coppa</td>
      <td>50x50cm</td>
      <td>94,00</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>50x68cm</td>
      <td>116,00</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>67x68cm</td>
      <td>209,00</td>
    </tr>
    <tr>
      <td>Vasa</td>
      <td>38x33cm</td>
      <td>33,00 </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>46x39cm</td>
      <td>61,00</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>53x49cm</td>
      <td>91,00</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>70x60cm</td>
      <td>223,00 </td>
    </tr>
  </tbody>
</table>
</section>
<section id='aarde'>
<h3 >Potgrond</h3>
<p>We hebben volgende soorten bloemaarde in voorraad:</p>
<table class='cursus'>
  <thead>
    <tr>
      <th>type</th>
      <th>prijs</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>potgrond voor kuipplanten (50l)</td>
      <td>7,95</td>
    </tr>
    <tr>
      <td>potgrond voor geraniums (50l)</td>
      <td>9,95</td>
    </tr>
    <tr>
      <td>Universele potgrond (25l)</td>
      <td>4,95</td>
    </tr>
    <tr>
      <td>Universele potgrond (50l)</td>
      <td>7,95</td>
    </tr>
    <tr>
      <td>Cactusaarde (10l)</td>
      <td>7,00</td>
  </tbody>
</table>
</section>
</section>
<section id='links'>
  <h2>Links</h2>
  <ul>
    <li><a target='_blank' href='http://www.detuinenvanhoegaarden.be'>www.detuinenvanhoegaarden.be</a></li>
    <li><a target='_blank' href='http://www.bdb.be'>bodemkundige dienst van België</a></li>
    <li><a target='_blank' href='http://www.openbaargroen.be'>www.openbaargroen.be</a></li>
    <li><a target='_blank' href='http://microscoop-expert.nl'>microscoop-expert.nl</a></li>
    <li><a target='_blank' href='http://www.hetbloemenatelierhetgroenenest.be'>www.hetbloemenatelierhetgroenenest.be</a></li>
  </ul>
</section>
</article>";

    return $str;
}

//*************************************************
function getPlanten($soort_id, $kleur, $hoogte_min, $hoogte_max) {
    //Plantenlijst via PHP
    //non-ajax

    global $PS;

    //======Componenten===================

    $tbl_Planten = $PS->geefTabelPlantenAdvanced($soort_id, $kleur, $hoogte_min, $hoogte_max); //tabel
    $soortendropdown = $PS->geefDDAlleSoorten(); //dropdown
    $kleurendropdown = $PS->geefDDAlleKleuren(); //array van kleuren
    //keuzelijst object. method parse() returnt HTML
    $soorten_dd = $soortendropdown->parse();
    $kleuren_dd = $kleurendropdown->parse();

    //======output===================

    $str = "<section>
			<h2>Ons plantenaanbod</h2>
    		<p>Om te kunnen bestellen moet je een geregistreerde klant zijn: <a href='index.php?page=registreer'>registreer hier</a></p>
			</section>";


    //zoeken 
    $str .= "<section>
			<div id='zoeken'>
      		<p><a id='adv_zoeken_link' href='#'>geavanceerd zoeken</a></p>
			
			<form name='frm1' id='frm1' class='cmxform' action='index.php' method='get'>
			<input type='hidden' name='page' value='shop' />
			<div><label for='soort_id'>Soorten: </label>" . $soorten_dd . "</div>";

    //adv zoeken
    $str .= "<!--start geavanceerd zoeken -->
				<div id='adv_zoeken' >"; // 

    $str .= "<div><label for='kleur'>kleur: </label>" . $kleuren_dd . "</div>";
    $str .= "<div>
					<label for='hoogte'>hoogte tussen: </label>
					<div class='controlbox vert'>
					<input type='text' id='hoogte_min' name='hoogte_min' size='4' class='kort'  /> en
					<input type='text' id='hoogte_max' name='hoogte_max' size='4' class='kort' />
					</div>
					</div>";

    $str .= "<div>
					<label></label>
					<div class='controlbox vert'>

					<!--start slider -->
                                        <div id='slider-range-hoogte' class='slider'></div

					<!--einde slider -->
					
					</div>
					</div>";

    $str .= "</div>
				<!--  einde geavanceerd zoeken -->";


    $str .= "<div><label></label><div class='controlbox hor'><input type='submit' value='zoeken' /><input type='reset' /></div></div>
      		</form>
    
			</div>
			</section>";

    //de tabel
    $str .= "<section>" . $tbl_Planten . "</section>";

    return $str;
}

//**************************************************************************************
function getAjaxPlanten() {
    //Plantenlijst via Ajax

    global $PS;

    //======Componenten===================

    $tbl_Planten = "
        <table id='plantenlijst' class='omlijnd'>
            <thead>
                <tr>
                    <th>Soort</th>
                    <th>Kleur</th>
                    <th>Hoogte</th>
                    <th>Beginbloei</th>
                    <th>Eindbloei</th>
                    <th>Prijs</th>
                    <th>Rubriek</th>
                </tr>  
            </thead>
            <tbody></tbody>
        </table>
    "; //tabel
    $soortendropdown = $PS->geefDDAlleSoorten(); //dropdown
    $kleurendropdown = $PS->geefDDAlleKleuren(); //array van kleuren
    //keuzelijst object. method parse() returnt HTML
    $soorten_dd = $soortendropdown->parse();
    $kleuren_dd = $kleurendropdown->parse();

    //======output===================

    $str = "<section>
			<h2>Ons plantenaanbod</h2>
    		<p>Om te kunnen bestellen moet je een geregistreerde klant zijn: <a href='index.php?page=registreer'>registreer hier</a></p>
			</section>";


    //zoeken 
    $str .= "<section>
			<div id='zoeken'>
      		<p><a id='adv_zoeken_link' href='#'>geavanceerd zoeken</a></p>
			
			<form name='frm1' id='frm1' class='cmxform' action='index.php' method='get'>
			<input type='hidden' name='page' value='shop' />
			<div><label for='soort_id'>Soorten: </label>" . $soorten_dd . "</div>";

    //adv zoeken
    $str .= "<!--start geavanceerd zoeken -->
				<div id='adv_zoeken' >"; // 

    $str .= "<div><label for='kleur'>kleur: </label>" . $kleuren_dd . "</div>";
    $str .= "<div>
					<label for='hoogte'>hoogte tussen: </label>
					<div class='controlbox vert'>
					<input type='text' id='hoogte_min' name='hoogte_min' size='4' class='kort'  /> en
					<input type='text' id='hoogte_max' name='hoogte_max' size='4' class='kort' />
					</div>
					</div>";

    $str .= "<div>
					<label></label>
					<div class='controlbox vert'>

					<!--start slider -->
                                        <div id='slider-range-hoogte' class='slider'></div

					<!--einde slider -->
					
					</div>
					</div>";

    $str .= "</div>
				<!--  einde geavanceerd zoeken -->";


    $str .= "<div><label></label><div class='controlbox hor'><input type='submit' value='zoeken' /><input type='reset' /></div></div>
      		</form>
    
			</div>
			</section>";

    //de tabel
    $str .= "<section>" . $tbl_Planten . "</section>";

    return $str;
}

//*************************************************
function getRegistreer() {
    //Home pagina

    global $PS;

    //======Componenten===================

    $soortendd = $PS->geefDDAlleSoortenMultiple(); //dropdown multiple select
    //keuzelijst object. method parse() returnt HTML
    $soortendropdown = $soortendd->parse();


    //======inhoud===================	


    $str = "<section>
				<h2>Registreer</h2>
    			<p>Verplichte velden zijn aangeduid met een asterisk (<abbr class='verplicht' title='verplicht'>*</abbr>).</p>
  				</section>";

    $str .= "<section>
		<!--start foutBox-->
                <div class='foutBox' id='fouten'><h2>Fouten</h2><ul></ul></div>
                <!--einde foutBox-->
                
				  <form id='regForm' name='regForm' method='get' action='reflect_data.php'>
					<fieldset>
					  <legend>Uw persoonlijke gegevens</legend>
					  <div>
						<label for='vnaam'>Voornaam<abbr class='verplicht' title='verplicht'>*</abbr>:</label>
						<input type='text' title='vul hier uw voornaam in' placeholder='voornaam'  id='vnaam' name='vnaam'  />
					  </div>
					  <div>
						<label for='fnaam'>Familienaam<abbr class='verplicht' title='verplicht'>*</abbr>:</label>
						<input type='text' title='vul hier uw familienaam in' placeholder='familienaam' id='fnaam' name='fnaam'  />
					  </div>
					  <div>
						<label for='straat'>Straat:</label>
						<input type='text' title='uw straat  met huisnummer'  placeholder='straat + huisnummer'  id='straat' name='straat' />
					  </div>
					  <div>
						<label for='gemeente'>Gemeente:</label>
						<input type='text' title='de gemeente waar u woont'  placeholder='gemeente' id='gemeente' name='gemeente'  />
					  </div>
					  <div>
						<label for='postnr'>Postnummer<abbr class='verplicht' title='verplicht'>*</abbr>:</label>
						<input type='text' title='het postnummer van uw gemeente' placeholder='postnummer' id='postnr' name='postnr'  />
					  </div>
					  <div>
						<label for='tel'>Telefoon:</label>
						<input type='text' title='uw vaste of mobiele telefoon' placeholder='telefoonnummer' id='tel' name='tel'  />
					  </div>
					  <div>
						<label for='geboren'>Geboortedatum<abbr class='verplicht' title='verplicht'>*</abbr>:</label>
						<input type='text' title='uw geboortedatum in het formaat 1956-12-31' placeholder='geboortedatum'  id='geboren' name='geboren'  />
					  </div>
					  <div>
						<label>geslacht<abbr class='verplicht' title='verplicht'>*</abbr>:</label>
						<label class='labelRadio' for='man'>
						  <input type='radio'  title='uw sexe' id='man'  name='sexe' value='m' />
						  Man </label>
						<label class='labelRadio' for='vrouw' >
						  <input type='radio' title='uw sexe' id='vrouw' name='sexe' value='v' />
						  Vrouw </label>
					  </div>
					</fieldset>";

    $str .= "<fieldset>
					  <legend>Uw groene keuzes</legend>
					  <div>
						<label>uw ruimte  is een <abbr class='verplicht' title='verplicht'>*</abbr>:</label>
						<div class='controlbox'>
						<label class='labelCheckbox' for='ruimte_bedrijf'>
						  <input type='checkbox' title='U heeft een bedrijfsterrein dat u wil beplanten' id='ruimte_bedrijf' name='ruimte[]' value='bedrijf'   />
						  Bedrijfsterrein </label>
						<label class='labelCheckbox' for='ruimte_tuin'>
						  <input type='checkbox'  title='U heeft een tuin aan uw huis' id='ruimte_tuin' name='ruimte[]' value='tuin'  />
						  Tuin </label>
						<label class='labelCheckbox' for='ruimte_terras' >
						  <input type='checkbox' title='U bezit een terras waarop potplanten kunnen pronken' id='ruimte_terras' value='terras' name='ruimte[]' />
						  Terras </label>
						<label class='labelCheckbox' for='ruimte_balkon' >
						  <input type='checkbox' title='U heeft een balkon waarop u enkele potplanten kunt zetten'   id='ruimte_balkon' value='balkon' name='ruimte[]' />
						  Balkon </label>
					  </div>
					    </div>
					  <div>
						<label for='agree'>U zoekt vnl</label>";

    $str .= $soortendropdown;

    $str .= "</div></fieldset>";

    $str .= "<fieldset>
					  <legend>Aanmelding</legend>
					  <div>
						<label for='username'>gebruikersnaam<abbr class='verplicht' title='verplicht'>*</abbr>:
						            <!-- start dialogbutton-->
            <br><a href = '#' id='dialog_link_username'>Meer uitleg</a>
            <!-- einde dialogbutton-->
						</label>
						<input type='text' title='de gebruikersnaam waarmee u wil aanmelden'   id='username' name='username'  />
					  </div>
					  <div>
						<label for='ww1'>wachtwoord<abbr class='verplicht' title='verplicht'>*</abbr>:</label>
						<input type='password' title='uw wachtwoord' id='ww1' name='ww1'  />
					  </div>
					  <div>
						<label for='ww2'>herhaal wachtwoord:</label>
						<input type='password' title='herhaal uw wachtwoord'  id='ww2' name='ww2'  />
					  </div>
					</fieldset>";

    $str .= "<fieldset>
					  <legend>Promoties</legend>
					  <div>
						<label for='promos'>hou mij op de hoogte van promoties via email</label>
						<input type='checkbox' id='promos' title='ik wens op de hoogte gehouden te worden van uw promoties' name='promos' />
					  	<input  type='email' title='mijn emailadres'   id='email' name='email'  disabled='disabled' />
					  </div>
					</fieldset>";

    $str .= "<fieldset>
					  <legend>Bevestig</legend>
					  <div>
						<input class='submit' type='submit' value='Bevestig'/>
						<input class='cancel' type='reset' value='Annuleer'/>
					  </div>
					</fieldset>
				  </form>
                                  		<!--start foutBox-->
                <div class='foutBox'><a href='#fouten'>sommige ingevulde gegevens zijn foutief!</a></div>
                <!--einde foutBox-->
				  ";
    $str .= getUsernameDialog();


    return $str;
}

//*************************************************
function getVerzorging() {
    //Verzorging pagina
    $str = "<section>
				<h2>Vaste planten</h2>
				<p>Een groot voordeel van vaste planten en kruiden is dat ze weinig onderhoud vragen. Zeker als u voldoende verzorgingsmaatregelen treft.<br />
				Een beginnersfout is vaak om eerst de planten te kiezen, en zich dan pas af te vragen hoe de grond in de tuin is. Hoewel de grondsoort een vast gegeven is, kun je die natuurlijk wel verbeteren. Laat de aanwezige grond altijd het uitgangspunt zijn bij de plantkeuze. Alle planten groeien het beste en bloeien het mooist als de grond voldoende lucht bevat en vocht kan vasthouden. Anders gezegd: als de bodem goed van structuur is.</p>
				</section>";

    $str .= "<section>
				<p><label><input type='checkbox' id='toonWaterplanten'/> info inclusief waterplanten</label></p>
                                <p>Soms is goede verzorging onvoldoende: een aantal ziektes belagen onze tuinplanten.<a href='#' id='toonZiektes'>Meer weten over ziektes?</a></p>
				<!--start div verzorging-->
				<div id='verzorging'>
                                <!-- start UL toegevoegd door tabs-->
                                <ul>
                                    <li><a href='#bodem'>Bodem en voedsel</a></li>
                                    <li><a href='#vermeerderen'>Vermeerderen</a></li>
                                    <li><a href='#licht'>Zon of schaduw</a></li>
                                    <li><a href='#waterplanten'>Waterplanten</a></li>
                                </ul>
                                <!-- einde UL toegevoegd door tabs-->
				<div id='bodem'>
				<h3>Zorg voor een vochtige wortelkluit</h3>
				<p> Vaste planten worden tegenwoordig afgeleverd in potten. Ze zien er misschien niet altijd even florissant uit, maar de kans dat de planten in de tuin onmiddellijk doorgroeien is bijna 100%. Een ander voordeel is dat in feite het hele jaar door geplant kan worden. Maar de voorkeur van de vakman gaat uit naar planten in het najaar. De ervaring leert echter, dat tuinliefhebbers vrijwel steeds het nieuwe groeiseizoen afwachten en dus gaan planten in april en mei.</p>
				<p>Het voordeel van planten in het najaar is groot: de planten groeien voor de winter nog vast en zijn in de volgende zomer beter bestand tegen droogteperioden. En van allerlei vroegbloeiende vaste planten heb je in het eerste het beste voorjaar al direct plezier! Uiteraard geldt hierop een uitzondering, namelijk de soorten die niet echt winterhard zijn. Zorg ervoor dat bij het planten de wortelkluit van te voren goed vochtig is gemaakt.</p>
				<h3>Compost zorgt voor goede lucht</h3>
				<p> Zandgrond kan verbeterd worden door compost door de bovenste grondlaag te mengen. De grond wordt zo meer samenhangend en kan meer water opnemen. Kleigrond wordt juist losser van structuur als er compost wordt toegevoegd en zal daardoor luchtiger worden. Omdat wortels niet alleen voedsel opnemen maar ook ademhalen, is de luchtigheid van de grond heel belangrijk voor het welzijn van de planten. Door wat extra koemest door de compost te mengen, zijn de planten verzekerd van voldoende voeding.</p>
				<h3>Een steuntje op z'n tijd</h3>
				<p>Alles staat of valt dus met een goede structuur van de grond, de juiste standplaats en de geschikte onderlinge afstand van de planten. Maar er zijn ook nogal wat planten die niet zo erg stevig zijn en daarom steun nodig hebben. Het meest natuurlijk is om daarvoor rijshout te gebruiken. Rijshout zijn vertakte twijgen van bijvoorbeeld iep of els die tussen de planten worden gezet. Door de einden naar binnen om te buigen ontstaat een goede steun. Ook zijn allerlei kant-en-klare steunen te koop die goed voldoen.</p>
				<p> Snijd in het najaar niet van alle vaste planten de oude stengels af en maak de tuin niet helemaal bladvrij. De bladeren verteren ook ter plekke wel en beschermen bovendien de planten. In het najaar wegharken, naar de composthoop brengen en in het voorjaar weer terug, is zinloos: pas in het voorjaar wegharken is een betere oplossing.</p>
				</div>
				<div id='vermeerderen'>
				<p>Vaste planten zijn kruidachtige planten die in de zomer boven de grond een bladrozet en onder de grond een wortelgestel vormen. In de winter sterft het bovengrondse deel af om in het voorjaar weer uit te lopen. Na een jaar of 3 is een vaste plant tot een volwassen afmeting gekomen. Na die tijd zal het hart van de plant verhouten en afsterven. De buitenkant van de plant breidt zich verder uit met jonge uitlopers. </p>
				<p>Als een vaste plant voor het eerste jaar in de tuin staat zal hij minder hoog worden als dezelfde plant die al enkele jaren op dezelfde plaats staat. Een plant die nog niet zolang in de tuin geplant is zal, omdat deze minder hoog wordt ook minder slappe stengels hebben en dus minder snel omwaaien. Al deze gegevens zorgen ervoor dat bij het beplanten van een border de vaste planten na ongeveer 3 tot 5 jaar aan verjonging toe zijn.</p>
				<h3>Verjongen</h3>
				<p>Dit verjongen wordt gedaan door middel van scheuren. Om vaste planten te scheuren moet de plant met de gehele kluit uit de aarde geschept worden. Nadat de aarde van de kluit is afgeschut is goed te zien hoe de kluit eruit ziet. De buitenste jonge delen kunnen van de kluit afgescheurd worden en opnieuw in de tuin geplant. Bij oude planten kan het zijn dat de kluit al dusdanig verhout is dat deze alleen met een spade doorgestoken kan worden. De nieuwe jonge plantjes zullen weer rijk bloeien in het eerstvolgende seizoen.</p>
				<h3>Scheuren</h3>
				<p>Het leuke van het scheuren van vaste planten is dat er van één moederplant soms wel 25 nieuwe planten gedeeld kunnen worden. Negen van de tien vaste planten kunnen op deze manier vermeerderd worden. Deze manier van vermeerderen is ook ideaal om het assortiment in eigen tuin op een betaalbare manier aan te vullen. Planten door scheuren vermeerderd zijn soortecht. Dat wil zeggen, ze vertonen dezelfde eigenschappen als de moederplant. Op ruilbeurzen, via vrienden en kennissen kunnen op deze manier plantensoorten uitgewisseld en aangevuld worden.</p>
				<h3>Zaaien</h3>
				<p>Veel vaste planten kunnen door zaaien vermeerderd worden. Bij zaaien is echter de kans groot dat de nieuwe zaailing andere eigenschappen heeft dan de moederplant. Als er een blauwkleurige plant gezaaid is kan het gebeuren dat er een witte of roze plant uit het zaad opgroeit. Kwekers maken dankbaar gebruik van dit gegeven. Op deze manier ontstaan er steeds weer nieuwe soorten, die door kwekers, na getest te zijn op de eigenschappen, als nieuwe soort op de markt gebracht worden.</p>
				</div>
				<div id='licht'>
				<p>In elke tuin komt wel een plek met schaduw voor. Een schaduwtuin kan met verschillende bladvormen en bladkleuren een heel evenwichtige en rustgevende uitstraling hebben. Schaduwplanten bloeien over het algemeen in het voorjaar. Logisch, want dan is er nog voldoende licht omdat de meeste bomen en struiken dan nog kaal zijn. Gelukkig zijn er ook planten die later in het seizoen bloeien; een goed voorbeeld is de Hosta, een plant die flink wat schaduw kan verdragen en in de zomer bloeit.</p>
				<p> Wilt u schaduwplanten aanschaffen, kijk dan op het plantenetiket in de pot naar het symbool met een halfzwart zonnetje (4 uur zon). Planten met geheel zwart gemaakt zonnetje hebben zelfs aan 2 uur zon per dag genoeg.</p>
				<h3> Voorjaarsbloeiers in de schaduw</h3>
				<p> De kerstroos (Helleborus) begint al in februari te bloeien. De meeste soorten hebben prachtig blad dat ook in de zomer veel sierwaarde heeft. In maart volgt het leverbloempje (Hepatica) gevolgd door longkruid (Pulmonaria) en maagdenpalm (Vinca). Kaukasische vergeet-mij-niet (Brunnera) is in de schaduw een heel dankbare plant. Ook sleutelbloemensoorten (Primula) kunnen flink wat schaduw verdragen en bloeien tot in mei. Ook treurend hartje (Dicentra) en dovenetel doen het goed in de schaduw.</p>
				<p> Tip: Veel vaste planten bloeien met witte bloemen. Wit valt op plekken met veel schaduw beter op dan bijvoorbeeld blauw. Ze kunnen dan ook een schaduwplek doen 'oplichten'.</p>
				<h3> Zomerbloeiers in de schaduw</h3>
				<p> Veel ooievaarsbeksoorten (Geranium) kunnen flink wat schaduw verdragen. Heel bekend zij de roze bloeiende Geranium endressii en de Geranium macrorrhizum die in een iet te koude winter zelfs zijn groene blad houdt. Vrouwenmantel (Alchemilla mollis) is een van de makkelijkste vaste planten en kan zowel in de zon als in de schaduw staan. Ruit (Thalictrum) is een decoratieve, ijle vaste plant die flink hoog wordt. </p>
				<p> Tip: Ooievaarsbeksoorten, Kaukasische vergeet-mij-niet (Brunnera) en vrouwenmantel gaan vaak weer opnieuw bloeien en krijgen nieuw fris blad als u ze na de bloei flink terugknipt.</p>
				<h3> Nazomerbloeiers in de schaduw</h3>
				<p> Schildpadbloem (Chelone obliqua) is een stevige vaste plant die niet snel omvalt. De zilverkaars (Cimicifuga) wordt flink hoog en valt in de nazomer met zijn witte bloemen goed op. De blauwe monnikskap (Aconitum carmichaellii) bloeit soms nog in oktober en is ook nog eens een prachtige snijbloem. </p>
				<p> Tip: Er zijn ook vaste planten met bont of geelachtig blad die een border een stuk levendiger kunnen maken. Vooral hosta's hebben een heel mooie tekening. Let bij TuinTotaal eens op vaste planten met een afwijkende bladkleur. Op het kaartje in de pot staat altijd of ze met zon of met schaduw genoegen nemen.</p>
				</div>
				<div id='waterplanten'>
				<p> Om de waterplanten in de vijver optimaal te laten groeien en bloeien is het raadzaam om een aantal keren per jaar ( bijvoorbeeld 4x ) het water te ( laten ) testen. Water bevat een aantal belangrijke waardes voor de planten in de vijver.</p>
				<p>De GH waarde is de hardheid van het water, deze is zeer belangrijk voor de normale planten zoals: zuurstofplanten, lelies, waterplanten en moerasplanten. De optimale waarde ligt tussen de 8 en 12 graden. Wanneer deze waarde te laag is ( lager als 8 ) zullen de planten niet optimaal groeien en kunnen de zuurstofplanten zelfs verslijmen ! De GH waarde kunt u gemakkelijk verhogen ( bijmesten ) met Maerl of GH +. Wanneer deze waarde hoger is als 12 bevat het water voldoende voeding en hoeft u niet bij te mesten.</p>
				<p>De KH waarde is de carbonaathardheid van het water. Dit is een belangrijke waarde voor zuurstofplanten. De KH is tevens een buffer voor de PH. Een goede KH waarde zorgt voor een stabiele PH waarde. De optimale waarde zit tussen de 5 en 11. Wanneer deze waarde te laag is,zullen de zuurstofplanten niet optimaal groeien of zelfs verslijmen .De KH waarde kunt u gemakkelijk verhogen met KH +.</p>
				</div>
				
				</div>
				<!--einde verzorging-->
				</section>";

    return $str;
}

//*************************************************
function getGalerij() {
    //Fotogalerij pagina
    $str = "
		<section>
		<h2>Fotogalerij</h2>
    	<p>Enkele soorten:</p>";

    //extra knoppen hier
    $str .= "<p>
            <span id='stop' class='knop'>stop</span>
            <span id='boven' class='knop'>boven</span>
            <span id='aan' class='knop'>aan</span>
            <span id='af' class='knop'>af</span>  
            </p>";

    $str .= "</section>";
    $str .= "
		<div id='thumblist'>
		<figure id='fig1'>
		<a href='images/planten/lupine.jpg' rel='lightbox[planten]' title='Kenai Peninsula Lupine, prachtige lentebloeier'>
    	<img src='images/planten/th_lupine.jpg' /></a>
    	<figcaption><b>Kenai Peninsula Lupine</b><br> prachtige lentebloeier</figcaption></figure>
    	<figure id='fig2'>
		<a href='images/planten/koningsvaren.jpg' rel='lightbox[planten]' title='Koningsvaren, Prachtige varen voor halfschaduw. Verlangt een vochtige bodem'>
    	<img src='images/planten/th_koningsvaren.jpg' /></a>
    	<figcaption><b>Koningsvaren</b><br>Prachtige varen voor halfschaduw. Verlangt een vochtige bodem</figcaption>	
    	</figure>
		<figure id='fig3'>
		<a href='images/planten/geranium_psilostemon.jpg' rel='lightbox[planten]' title='Geranium psilostemon,  Oersterke vaste plant, kleur de hele zomer lang'>
    	<img src='images/planten/th_geranium_psilostemon.jpg' /></a>	
    	<figcaption><b>Geranium psilostemon</b><br> Oersterke vaste plant, kleur de hele zomer lang</figcaption>
		</figure>
		<figure id='fig4'>
		<a href='images/planten/verbena.jpg' rel='lightbox[planten]' title='Verbena, Prachtige paarse bloem. small hoge plant ideaal als opvulling tussen lage planten. Zon vereist.'>
    	<img src='images/planten/th_verbena.jpg' /></a>
    	<figcaption><b>Verbena</b><br> Prachtige paarse bloem. small hoge plant ideaal als opvulling tussen lage planten. Zon vereist.</figcaption>
    	</figure>
		<figure id='fig5'>
		<a href='images/planten/tricyrtis.jpg' rel='lightbox[planten]' title='Tricyrtis, Vele mensen hebben er succes mee iop een zonnige plek. Niet te droog'>
    	<img src='images/planten/th_tricyrtis.jpg' /></a>	
    	<figcaption><b>Tricyrtis</b><br> Arme-mensen orchidee. Vele mensen hebben er succes mee iop een zonnige plek. Niet te droog</figcaption></figure>
		<figure id='fig6'>
		<a href='images/planten/salvia_patens.jpg' rel='lightbox[planten]' title='Salvia patens, Welke andere plant kan dit blauw evenaren? enkel indien ze heel goed beschermd zijn, zijn ze overblijvend.'>
    	<img src='images/planten/th_salvia_patens.jpg' /></a>	
		<figcaption><b>Salvia patens</b><br>Welke andere plant kan dit blauw evenaren? enkel indien ze heel goed beschermd zijn, zijn ze overblijvend.</figcaption>
    	</figure>
		<figure id='fig7'>
		<a href='images/planten/salvia_involucrata.jpg' rel='lightbox[planten]' title='Salvia involucrata, Roze salvia'>
    	<img src='images/planten/th_salvia_involucrata.jpg' /></a>
		<figcaption><b>Salvia involucrata</b><br> Roze salvia</figcaption>	
    	</figure>
		<figure id='fig8'>
		<a href='images/planten/salvia_fulgens.jpg' rel='lightbox[planten]' title='Salvia fulgens, Superrode bloemen. bosrandplant, geef voldoende humus.'>
    	<img src='images/planten/th_salvia_fulgens.jpg' /></a>	
		<figcaption><b>Salvia fulgens</b><br>Superrode bloemen. bosrandplant, geef voldoende humus.</figcaption>
    	</figure>
		<figure id='fig9'>
		<a href='images/planten/lelies.jpg' rel='lightbox[planten]' title='Lelies zijn een klassieker in de tuin, ze brengen spektakel en structuur. Goede verzorging is nodig'>
    	<img src='images/planten/th_lelies.jpg' /></a>	
		<figcaption><b>Lelies</b><br>Lelies zijn een klassieker in de tuin, ze brengen spektakel en structuur. Goede verzorging is nodig</figcaption>	
    	</figure>
		<figure id='fig10'>
		<a href='images/planten/holodiscus.jpg' rel='lightbox[planten]' title='Holodiscus of Pluimspirea, Ideaal te combineren met vaste planten'>
    	<img src='images/planten/th_holodiscus.jpg' /></a>	
		<figcaption><b>Holodiscus of Pluimspirea</b><br>Ideaal te combineren met vaste planten</figcaption>
    	</figure>
		<figure id='fig11'>
		<a href='images/planten/helleborus_orientalis.jpg' rel='lightbox[planten]' title='Helleborus orientalis, Bosrandplant. Degelijke wintergroene planten. Voor een mooi kleurrijk effect in de wintertuin.'>
		<img src='images/planten/th_helleborus_orientalis.jpg' /></a>
		<figcaption><b>Helleborus orientalis</b><br>Bosrandplant. Degelijke wintergroene planten. Voor een mooi kleurrijk effect in de wintertuin.</figcaption>
    	</figure>
		<figure id='fig12'>
		<a href='images/planten/erica_arborea.jpg' rel='lightbox[planten]' title='Erica arborea of Boomheide, De grootste heide-soort. In de heide- en veentuin. In wisselende beplanting in bakken.'>
    	<img src='images/planten/th_erica_arborea.jpg' /></a>
		<figcaption><b>Erica arborea of Boomheide</b><br>De grootste heide-soort. In de heide- en veentuin. In wisselende beplanting in bakken.</figcaption>		
    	</figure>
		<figure id='fig13'>
		<a href='images/planten/cornus_cousa.jpg' rel='lightbox[planten]' title='Cornus cousa, Witte kormoelje. Schaduwplant voor de vroege zomer'>
    	<img src='images/planten/th_cornus_cousa.jpg' /></a>
		<figcaption><b>Cornus cousa</b><br>Witte kormoelje. Schaduwplant voor de vroege zomer</figcaption>	
    	</figure>
		<figure id='fig14'>
		<a href='images/planten/althea.jpg' rel='lightbox[planten]' title='Althea, De klassieke grote Hibiscus: verlangt volle zon en een goed doorlatende grond'>
    	<img src='images/planten/th_althea.jpg' /></a>
		<figcaption><b>Althea</b><br>De klassieke grote Hibiscus: verlangt volle zon en een goed doorlatende grond</figcaption>
    	</figure>
		<figure id='fig15'>
		<a href='images/planten/kniphofia.jpg' rel='lightbox[planten]' title='Kniphofia Vuurbal, De mooiste kniphofiasoort'>
    	<img src='images/planten/th_kniphofia.jpg' /></a>
		<figcaption><b>Kniphofia 'Vuurbal'</b><br>De mooiste kniphofiasoort</figcaption>
    	</figure>
		</div>";

    return $str;
}

function getUsernameDialog() {

    $str = "<!-- ui-dialog -->
   			<div id='dialog_username' class='dialoogvenster' title='Uw gebruikersnaam'>
    		<p>Uw gebruikersnaam is een unieke naam waarmee u wil aanmelden op het systeem. <br />andere gebruikers kennen je onder die naam, niet je echte naam. Die enkel bekend bij de beheerder van de website</p>
    		<p>Kies bij voorkeur een korte, gemakkelijke naam waarmee je je kunt identificeren, bijvoorbeeld <i>'jean smits'</i>, <i>'lieselot'</i> of <i>'Superwoman'</i></p>
    		<p>De gebruikersnaam moet uniek zijn, als iemand anders ze al heeft zal je gevraagd worden een andere te kiezen</p>
			</div>
  			<!-- ui-dialog -->";

    return $str;
}

?>