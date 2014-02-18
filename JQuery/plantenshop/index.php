<?php

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

/* algemene controller */

//error_reporting(E_ALL); //commentarieer
@define('__ROOT__', dirname(dirname(__FILE__) . "/mvc_2013"));
require_once(__ROOT__ . "/data/plantendao.php");
require_once(__ROOT__ . "/data/soortendao.php");
require_once(__ROOT__ . "/man/templateManager.php");
require_once(__ROOT__ . "/content/inhoud.php");
//require_once "content/dyn_elementen.php";
//default waarden
$tpl['title'] = "de Plantenshop, een vdab jQuery tutorial";   // title in head
$tpl['body_id'] = "";  // id van body tag
$tpl['links'] = getMenu(); // inhoud linkerkolom
$tpl['rechts'] = "";  // inhoud rechterkolom
$tpl['paginaScripts'] = "";  // pagina specifiek scripts //gebruikt ondersteunende functies in inhoud.php
$tpl['paginaStylesheets'] = "";  // pagina specifiek link element
$tpl['dyn'] = "";  // om verborgen dynamische elementen op te roepen via script, 
//********welke pagina**********************

if (isset($_GET['page'])) {
    //specifieke pagina
    $page = $_GET['page'];

    switch ($page) {
        case "about":
            /*             * * About pagina ** */
            $tpl['title'] = "de Plantenshop: wie zijn we en wat doen we?";
            $tpl['body_id'] = "about";
            //content
            $tpl['rechts'] = getAbout();
            $tpl['paginaScripts'] = getScriptElements("js/about.js");

            break;

        case "shop":
            /*             * * Planten pagina, PHP, non-ajax ** */

            //init zoekvariabelen
            $soort_id = (isset($_GET['soort_id'])) ? $_GET['soort_id'] : '%';
            $kleur = (isset($_GET['kleur'])) ? $_GET['kleur'] : '%';
            $hoogte_min = (isset($_GET['hoogte_min'])) ? intval($_GET['hoogte_min']) : 0;
            $hoogte_max = (isset($_GET['hoogte_max'])) ? intval($_GET['hoogte_max']) : 5000;


            $tpl['title'] = "de Plantenshop: ons aanbod";
            $tpl['body_id'] = "shop";
            //content
            $tpl['rechts'] = getPlanten($soort_id, $kleur, $hoogte_min, $hoogte_max);
            $tpl['paginaScripts'] = getScriptElements(array("js/vendor/jquery/Datatables-1.9.4/media/js/jquery.dataTables.min.js", "js/shop.js"));
            $tpl['paginaStylesheets'] = getLinkElements("js/vendor/jquery/Datatables-1.9.4/media/css/jquery.dataTables.css");
            break;
        
        case "ajaxshop":
            /*             * * Planten pagina, ajax ** */

            //init zoekvariabelen
            $soort_id = (isset($_GET['soort_id'])) ? $_GET['soort_id'] : '%';
            $kleur = (isset($_GET['kleur'])) ? $_GET['kleur'] : '%';
            $hoogte_min = (isset($_GET['hoogte_min'])) ? intval($_GET['hoogte_min']) : 0;
            $hoogte_max = (isset($_GET['hoogte_max'])) ? intval($_GET['hoogte_max']) : 5000;


            $tpl['title'] = "de Plantenshop: ons aanbod";
            $tpl['body_id'] = "shop";
            //content
            $tpl['rechts'] = getAjaxPlanten();
            $tpl['paginaScripts'] = getScriptElements(array("js/vendor/jquery/Datatables-1.9.4/media/js/jquery.dataTables.min.js","js/vendor/jquery/Datatables-1.9.4/media/js/dataTables.fnReloadAjax.js", "js/ajaxshop.js"));
            $tpl['paginaStylesheets'] = getLinkElements("js/vendor/jquery/Datatables-1.9.4/media/css/jquery.dataTables.css");
            break;

        case "zorg":
            /*             * * Verzorging pagina ** */
            $tpl['title'] = "de Plantenshop: welke zorg moet je je planten geven?";
            $tpl['body_id'] = "zorg";
            //content
            $tpl['rechts'] = getVerzorging();
            $tpl['paginaScripts'] = getScriptElements("js/zorg.js");
            break;

        case "galerij":
            /*             * * Fotogalerij ** */
            $tpl['title'] = "de Plantenshop: fotogalerij";
            $tpl['body_id'] = "galerij";
            //content
            $tpl['rechts'] = getGalerij();
            $tpl['paginaScripts'] = getScriptElements(array("js/vendor/jquery/lightbox/js/lightbox-2.6.min.js","js/vendor/jquery/js/jquery.ui.knipoog.js","js/galerij.js"));
            $tpl['paginaStylesheets'] = getLinkElements("js/vendor/jquery/lightbox/css/lightbox.css");



            break;

        case "registreer":
            /*             * * Registreer formulier pagina ** */

            $tpl['title'] = "de Plantenshop: registreer u als klant";
            $tpl['body_id'] = "registreer";
            //content
            $tpl['rechts'] = getRegistreer();
            $tpl['paginaScripts'] = getScriptElements(array("js/vendor/jquery/jquery-validation-1.11.1/dist/jquery.validate.min.js", "js/registreer.js"));
            break;

        default:
            //foutieve pagina gaat nr home?
            $tpl['title'] = "de Plantenshop: fout";
            $tpl['body_id'] = "fout";
            $tpl['rechts'] = getFoutePagina();
    }//einde switch
} else {
    /*     * * homepagina ** */
    $tpl['body_id'] = "home";
    //content
    $tpl['rechts'] = getHome();
    $tpl['paginaScripts'] = getScriptElements("js/home.js");
}



//***** uitvoering *******************

$tm = new TemplateManager();
$html = $tm->template($tpl);
echo $html;
?>