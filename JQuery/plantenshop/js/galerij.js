// JavaScript Document
// voor fotogalerij pagina

$(window).load(function(){
   $('figure').knipoog({bgColor:"cyan", color:"navy", location:"bottom"});
   //knoppen
   $('.knop').button();
   //event handler voor knoppen
   $('#af').on("click",function(){
       $('figure').knipoog("disable");
   });
   $('#aan').on("click",function(){
       $('figure').knipoog("enable");
   });
   $('#boven').on("click", function(){
      $('figure').knipoog("option", "location", "top");
   });
   $('#stop').bind("click", function(){
      $('figure').knipoog("destroy"); 
   });
});

/*
Elk element van bevat achtereenvolgens:
	de bestandsnaam van de grote foto zonder ".jpg"
	de naam van de plant
	de naam van de auteur van de foto
	de Flickr node van de auteur
	een begeleidende tekst

Alle foto's in dit array zijn afkomstig uit Flickr, de naam van de auteur en zijn Flickcr node zijn vermeld
je kan de auteur dus vinden door de node achteraan toe te voegen:  http://www.flickr.com/photos/node/

*/
var arrGalerij = [
				  ["erica_arborea", "Erica arborea", "finieddu","52683828@N00","Boomheide. De grootste heide-soort. In de heide- en veentuin. In wisselende beplanting in bakken."],
				  ["helleborus_orientalis", "Helleborus orientalis","ille43","ilvys","Bosrandplant. Van de oude Griekse plantennaam helleboros. Degelijke wintergroene planten. Voor een mooi kleurrijk effect in de wintertuin."],
				  ["holodiscus", "Holodiscus orientalis", "Calypso orchid","msanseve","Pluimspirea. ideaal te combineren met vaste planten"],
				  ["kniphofia", "Kniphofia Vuurbal","gardeninginaminute","gardeninginaminute","De mooiste kniphofiasoort"],
				  ["lupine", "Kenai Peninsula Lupine","John Frisch","johnfrisch","Prachtige lentebloeier"],
				  ["koningsvaren", "Koningsvaren","imbala","imbala", "prachtige varen voor halfschaduw. Verlangt een vochtige bodem"],
				  ["verbena", "Verbena", "There and back again","ascott","Prachtige paarse bloem. small hoge plant ideaal als opvulling tussen lage planten. Zon vereist."],
				  ["salvia_fulgens", "Salvia fulgens ","Greggy's stuff","28188015@N05","Superrode bloemen. bosrandplant, geef voldoende humus."],
				  ["salvia_patens", "Salvia patens ","Mark Creeten","gigadesign","Welke andere plant kan dit blauw evenaren? enkel indien ze heel goed beschermd zijn, zijn ze overblijvend. Bloeit non-stop"],
				  ["tricyrtis", "Tricyrtis","wontolla65","wontolla_jcb","Arme-mensen orchidee. Vele mensen hebben er succes mee iop een zonnige plek. Niet te droog"],
				  ["geranium_psilostemon", "Geranium psilostemon","Monica Meeneghan","wink717","Oersterke vaste plant, kleur de hele zomer lang"],
 				  ["cornus_cousa", "Cornus cousa","David Fourer","dfourer","Witte kormoelje. Schaduwplant voor de vroege zomer"],
  				  ["althea", "Althea", "Luigi FDV","luigistrano","de klassieke grote Hibiscus: verlangt volle zon en een goed doorlatende grond"],
  				  ["salvia_involucrata", "Salvia involucrata","Lila Rache","purple_rache","Roze salvia"],
				  ["lelies", "Lelies","David Fourer","dfourer","Lelies zijn een klassieker in de tuin, ze brengen spektakel en structuur. Goede verzorging is nodig"]
		  		];