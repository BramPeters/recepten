// JavaScript Document
// JS bestand voor About pagina

var lijst = ['roger', 'evelyn', 'hilde', 'jan'];

//alert('dom tree nog niet geladen: onmiddelijke uitvoering');
$(function(){
//alert('dom tree geladen: de id van het body element is: '+ $('body')[0].id);
//$('a').addClass('rood');
//$('#bedrijf a').addClass('rood');
//$('a').addClass('rood').filter('a[target]').addClass('groen').end().addClass('onderlijnd');
$('tbody tr:odd').addClass('oneven');
$('tbody tr:even').addClass('even');
$('a[href^="http"]').on('click',function(){alert('U staat op het punt de pagina te verlaten'); });
$('<a href="#about"title="terug naar boven">terug naar boven</a>').insertBefore(/*'h2, h3, h4, h5, h6'*/':header:gt(1)').button({ icons:{secondary:'ui-icon-circle-triangle-n'}});

//lijst
//var $uul = $('<ul>').append('<li>eerste</li>').append('<li>tweede</li>');$('#team').after($uul);
//var $uul = $('<ul>'); var strDeLijst =''; $.each(lijst,function(n, value){strDeLijst += '<li>' + value +'</li>';}); $uul.html(strDeLijst); $('#team').after($uul);

//keuzelijst met JSON gegevens
var $container = $('<div id ="teamboks">');
var $diefrechts = $('<div id="teamgegevens">');
var $keuzelijst = $('<select id="teamkeuzelijst">');
var strDeOptions = '<option value="">--- het team ---</option>';
/* oorspronkelijke versie
 $.each(lijst,function(n, value){
    strDeOptions += '<option>' + value + '</option>'; 
});
$keuzelijst.html(strDeOptions);
*/

//versie met custom wrapper method
$keuzelijst.vulSelect(lijst, "-- kies een teamlid --");


$container.append($keuzelijst).prepend($diefrechts);
$('#team').after($container);

//inhoudsopgave
var root = $('article')[0];
var $list = $('<ol>');
$('#toc').empty().append(walkTree(root,$list,enterNode,exitNode));

//**** AJAX call nr JSON gegevens team ****************

$('#teamkeuzelijst')
.change(function(){
  var waarde = $(this).val();
  //console.log(waarde+' gekozen');
  $.getJSON('services/ajax_json_team.php', 
    {teamlid:waarde}, 
    function(jeeson){
        var strHTML = "";
        if(jeeson.naam){
            strHTML += "<img src='images/"+jeeson.foto+"' />";
            strHTML += "<h3>"+jeeson.naam+"</h3>";
            strHTML += "<p>leeftijd: "+jeeson.leeftijd+"</p>";
            strHTML += "<p>functie: "+jeeson.functie+"</p>";
        }
        $('#teamgegevens').html(strHTML);
    }
);
});


$.zegDankUTegen('Bram');
$('<li>').html($.vandaag()).prependTo('footer ul');

});//end of doc.ready

var arrKoppen = ["h1","h2","h3","h4","h5","h6"];
var arrSections = ["article", "section", "aside", "nav"];
var getal = 1;

var walkTree = function (root, $list, enter, exit) 
{
  var node = root;
  start: while (node) {
	 
	$list = enter(node,$list);
	if (node.firstChild) {
	  node = node.firstChild;
	  continue start;
	}
	while (node) {
	  $list = exit(node,$list);
	  if (node.nextSibling) {
		node = node.nextSibling;
		continue start;
	  }
	  if (node === root)
		node = null;
	  else
		node = node.parentNode;
	}
  }
  return $list;
};

var checkNode = function(node){
    // controleert of deze node in aanmerking komt voor de inhoudsopgave
    // enkel als elementNode, in de lijst sectionElms en geen no-toc
    var strNotoc = "no-toc";
    return (node.nodeType ===1 && arrSections.indexOf(node.tagName.toLowerCase())>=0 && node.className.indexOf(strNotoc)===-1);
};

function enterNode(node,$list){
    //bouwt $list op bij het binnengaan van een node
    if(checkNode(node)){
        var $nieuw = $('<li>').attr("tabindex",getal.toString());
        var $a = $('<a>').attr({
            href : "#"+getal.toString(),
            id : "o"+getal.toString()
        });
        
        
        node.setAttribute("id", getal.toString());
        getal++;
        //console.log(node+" "+node.text+" "+node.value+" "+$a.text);
        $a.text(zoekKnoppen(node));
        $nieuw.append($a);
        
        if($list[0].tagName ==="LI"){
            var $nieuweLijst = $('<ol>').append($nieuw);
            $list.append($nieuweLijst);
            $list = $nieuw;
            
        
        }else{
            $list.append($nieuw);
            $list =$nieuw;
        }
    }
    return $list;
}

var exitNode = function(node,$list){
    //bij het verlaten van de node
    if(checkNode(node)){
        if($list[0].tagName==="OL"){$list =$list.parent()}
        $list = $list.parent();
    }
    return $list;
};

var zoekKnoppen = function(node){
    var $node = $(node);
    var koptekst = "";
    //zoek de hoogste kop, return inhoud
    $.each(arrKoppen,function(i,v){
        var $kop = $(v, $node);
        if($kop.length > 0){
            koptekst = $kop.first().text();
            return false;
        }
    });
    //console.log(koptekst);
    return koptekst;
};