/* 
JavaScript libary met algemene functies en Object augmentations.
Wordt door de cursist opgebouwd tijdens de PF en Adv -> dit bestand enkel bestemd voor instructeur!
Hier een volledige versie, gelinkt aan alle afgewerkte projecten en taken bestanden

alle info Jan Vandorpe

LAST UPDATE: 6/2010

inhoud:
	- Regular expressions
	- String 
	- Datum en tijd 
	- IS functies testen of een waarde van een bepaald type is
	- Math 
	- Array 
	- DOM Node 
	- Cookie 
	- Objecten, inheritance
	- Constructors
	- Events
	
*/

/************** DEBUG_LOG ****************************/

function debug_log(){
	//debug via console geeft geen fouten als firebug niet actief
	  if(typeof window.console != 'undefined' && typeof window.console.log != 'undefined'){
		  var i, str = '';
		  for(i=0;i<arguments.length;i++){str += arguments[i]; }
		  console.log(str);
	  }
}

/************** REGEX ****************************/

var re_integer= /^[-+]?[0-9]*\.?[0]*$/ ; //geheel getal
var re_decGetal= /^[-+]?[0-9]*\.?[0-9]+/ ; //floating point

var re_datum1=/^\d{4}-[0-9]|[0,1,2][0-9]-[0-9]|[0,1,2][0-9]|3[0,1]$/; //yyyy-mm-dd eenvoudig
//dd/MM/yyyy
var re_datum2=/^(((0?[1-9]|[12]\d|3[01])[\.\-\/](0?[13578]|1[02])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|[12]\d|30)[\.\-\/](0?[13456789]|1[012])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|1\d|2[0-8])[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|(29[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00)))$/;
var re_email1=/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;


//meer op regexlib.com




/**************** String functies *************/



//---------------------------------------------
//TRIM method: augmentation van het String object: Douglas Crockford
//verwijdert spaties voor en na een string, niet binnenin
//gebruik: mijnString.trim() 
String.prototype.trim = function () {
    return this.replace(/^\s*(\S*(\s+\S+)*)\s*$/, "$1"); 
}; 



/**************** Datum, tijd functies *************/



//----------datum arrays----------------------

//dagen volgens getDay() volgorde
var arrWeekdagen = new Array('zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag');

//vervang feb dagen voor een schrikkeljaar
var arrMaanden = new Array(['januari',31], ['februari',28], ['maart',31], ['april',30], ['mei',31], ['juni',30], ['juli',31], ['augustus',31], ['september',30], ['oktober',31], ['november',30], ['december',31]);

//globale datum objecten te gebruiken in je pagina
var vandaag 		= new Date();
var huidigeDag 		= vandaag.getDate(); //dag vd maand
var huidigeWeekDag 	= vandaag.getDay(); //weekdag
var huidigeMaand 	= vandaag.getMonth();
var huidigJaar 		= vandaag.getFullYear();

//---------------------------------------------

function isSchrikkeljaar(jaar){
/* test voor schrikkeljaar
@jaar: number, 4 digits, verplicht
return: boolean
*/
eindwaarde=false;

if (!isNaN(jaar)){
	if (jaar%4===0){
		eindwaarde=true;
		if(jaar%100===0){
			eindwaarde=false;
			if(jaar%400===0){
				eindwaarde=true;
			}
		}
	}
}
return eindwaarde;
}
//---------------------------------------------
function getVandaagStr(){
//returnt een lokale datumtijdstring

var strNu = "Momenteel: " + vandaag.toLocaleDateString() + ", " + vandaag.toLocaleTimeString();

return strNu;
}



/**************** IS functies *******************/



 function isGetal(waarde){
	return re_decGetal.test(waarde);// floating point number
 }
 //---------------------------------------------
 function isInteger(waarde){
	return re_integer.test(waarde);// integer              
 }
//---------------------------------------------
function isNumber(value){
//ultieme test voor getallen
//return boolean
	return typeof value === 'number' && isFinite(value); //isFinite=geldige JS functie
}
//---------------------------------------------
function isObject(iets){
//correcte test voor objecten
//return boolean
	return (iets && typeof iets === 'object');
}
//---------------------------------------------
function isArray(iets){
//correcte test voor arrays
//return boolean
	return (iets && typeof iets === 'object' && iets.constructor === Array)
}
//---------------------------------------------
function isFunction(iets){
//is een waarde een functie?
//return boolean
	return (iets && typeof iets === 'function')
}


/**************** MATH functies *******************/



function afronden(num, dec) {
	var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
	return result;
}


function deg2rad(deg){
	//zet graden om in radialen
	return (Math.PI/180)*deg;
	}
	
function rad2deg(rad){
	//zet radialen om in graden
	return (180/Math.PI)*rad;
	}
	
function willekeurig(minLimiet, maxLimiet){
	/*returnt een willekeurig getal tussen minLimiet en maxLimiet, optioneel argumenten*/
	var minLimiet = minLimiet || 0;
	var maxLimiet = maxLimiet || 100;
	return  Math.round(Math.random() * maxLimiet) + minLimiet	
	}


/**************** ARRAY functies *******************/
/*
	indexOf
	is native vanaf JS 1.6, maar wordt hier toegevoegd via augmentation indien niet aanwezig
	returnt de index (positie) van een waarde in een array, niet gevonden -1
	gebruik: mijnArray.indexOf('Jan')
	@elt	het gezochte item
	@from	indexpositie vanaf waar te zoeken
*/
if (!Array.prototype.indexOf)  
{  
  Array.prototype.indexOf = function(elt , from)  
  {  
	var len = this.length >>> 0;  
  
	var from = Number(arguments[1]) || 0;  
	from = (from < 0) ? Math.ceil(from) : Math.floor(from);  
	if (from < 0) from += len;  
	for (; from < len; from++)  
	 {  
	   if (from in this &&  
		   this[from] === elt)  
		 return from;  
	 }  
	return -1;  
 };  
}  

/*
	transpose
	zet rijen om in kolommen en omgekeerd voor een 2D array
	gebruik: mijnArray.transpose()
	
*/	
Array.prototype.transpose = function (){
		//transpose van een 2D array
		var l = this.length;
		//debug_log("l: "+l);
		//enkel indien 2D: test eerste item
		if (isArray(this[0])){
			var w = this[0].length;
			//debug_log("w: "+ w);
			if(l>0 && w>0){
				var transposed = [];
				for(var rij=0;rij<w;rij++){	
					var nieuweRij = [];
					for(var kol=0;kol<l;kol++){
						var waarde = this[kol][rij];
						//debug_log(waarde);
						nieuweRij.push(waarde);	
						}
					transposed.push(nieuweRij);
					}
				return transposed;
				}
			}
			else{
				if(window.console){
					debug_log("geen 2D array, niet transposed")
					}
				}
		}
//---------------------------------------------
function toonArray(arr){
//lijst van array items, callback nr enumerate vr objecten
//return string
//@arr	array
  var strItems="";
  var spatie = "";
  if(isArray(arr)){
	  var aL = arr.length;
	  
	  for (var i =0;i<aL;i++ ){
		  if(isArray(arr[i])){
			  //recursief
			  spatie = " ";
			  toonArray(arr[i])
			  }
		  if(isObject(arr[i])&& !isArray(arr[i])) { 
		  		strItems += enumerate(arr[i]) 
			}
		  else {	
		  	strItems += spatie +  arr[i] + "\n"; 
			}
	  }
  }
  else {throw new Error("geen array")}
  return strItems;
}	
//---------------------------------------------
/*
zit een needle (item) in  een haystack (array)?
*/
function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}



/**************** DOM functies *******************/





function leegNode(objNode){
/* verwijdert alle inhoud/children van een Node
	@ objNode: node, verplicht, de node die geleegd wordt
*/
	while(objNode.hasChildNodes()){
		objNode.removeChild(objNode.firstChild)
	}
}
//---------------------------------------------

function zoekParent(n,strE){
/*
*returnt de eerstvolgende parentNode van een bepaald elementtype
*
*@param n	startNode van wie de parent gezocht wordt
*@param strE	string elementtype, vb "TR"; caps afhankelijk van html of xhtml
*@return Node/null
*/	
while(n=n.parentNode){ //zolang dit lukt nemen we onmiddellijk de parentNode	
	if(n.nodeName.toLowerCase()==strE.toLowerCase()){return n;}
}
return null;
}
//---------------------------------------------

function getElementsByClassName(classname, startElement) {
/* zoekt elementen van een bepaalde CCS clss
*
* @classname: 		string
* @startElement: 	DOM element, optional, om de zoektocht in te koreten anders doorloppt alle elementen
* 
return	collection (array van nodes)
*/
	var eBegin = (startElement||document)
    var a = [];
    var re = new RegExp('\\b' + classname + '\\b');
    var els = eBegin.getElementsByTagName("*");
    var j = els.length;
	  for(var i=0; i<j; i++)
        if(re.test(els[i].className)){ a.push(els[i]);}
    return a;
}

//---------------------------------------------
/*
ex quirksmode.org
berekent de werkelijke waarde van een CSS prop voor een element
gebruik de CSS name, dus 'font-size', niet 'fontSize'
*/
function getStyle(el,styleProp)
{
	var x = document.getElementById(el);
	if (x.currentStyle)
		var y = x.currentStyle[styleProp];
	else if (window.getComputedStyle)
		var y = document.defaultView.getComputedStyle(x,null).getPropertyValue(styleProp);
	return y;
}


/**************** COOKIES *******************/





function setCookie(naam,waarde,dagen){
/*plaatst een cookie

naam: cookienaam;
waarde: de inhoud van het cookie
dagen: optioneel, het aantal dagen dat het cookie geldig blijft vanaf nu
		indien afwezig wordt het een session cookie
*/
	var verval = "";
	if(dagen){
		// vandaag 	uit global var bovenaan
		var vervalDatum = new Date(vandaag.getTime()+dagen*24*60*60*1000);
		verval = vervalDatum.toUTCString();
	}
document.cookie = naam + "=" + waarde + ";expires=" + verval;
}
//---------------------------------------------
function getCookie(naam){
/*leest een cookie

naam: cookienaam
*/
	var zoek = naam + "=";
	if (document.cookie.length>0){
		var begin = document.cookie.indexOf(zoek);
		if (begin!=-1){
			begin += zoek.length;
			var einde = document.cookie.indexOf(";", begin);
			if (einde==-1){
				einde = document.cookie.length;
			}
			return document.cookie.substring(begin, einde);
		}
	}
}
//---------------------------------------------
function clearCookie(naam){
/*
verwijdert een cookie

naam: cookienaam
*/	
	setCookie(naam,"",-1);
}



/************** OBJECTEN, INHERITANCE  ****************************/




function clone(object){
		/*kloont een nieuw object van een ander*/
		function F(){}
		F.prototype=object;
		return new F;
		}
//---------------------------------------------
function extend(subClass, superClass){
	/* leidt een Class af van een andere */
	var F = function(){}
	F.prototype = superClass.prototype;
	subClass.prototype = new F();
	subClass.prototype.constructor = subClass;
	//nieuwe prop superclass !letop lowercase
	subClass.superclass = superClass.prototype;
	if(subClass.prototype.constructor==Object.prototype.constructor){
		superClass.prototype.constructor = superClass;
		}
	}
//---------------------------------------------
function overschrijf(optObj, setObj){
		/*
		overschrijft alle properties van setObj met optObj, recursief
		@optObj		object, de doorgegeven opties
		@setObj		object, het te wijzigen settingsobject, nodig vr recursie
		*/
		 if(optObj && setObj){
			 
		 for(var key in optObj){
			
			 if(isObject(optObj[key]) && !isArray(optObj[key])){
				 //enkel voor zuivere objecten, geen arrays
				setObj[key] = setObj[key] || {}; //indien afwezig maak leeg object
				overschrijf(optObj[key], setObj[key]); 
			  }
			  else{
				setObj[key] = optObj[key];
			  }  
		 }
		 }else{throw new Error ('overschrijf: argumenten tekort');}
	}
			
//---------------------------------------------
function enumerate(o){
	//maakt een overzichtslijst van properties van een object, recursief
	//dependencies isObject
	//return string
	var strProps = "";		  
		  if(isObject(o)){
			  for (var key in o){
				  if(o.hasOwnProperty(key)){ //geen inherited props
					if(isObject(o[key])){
						strProps += key + " : \n" + enumerate(o[key]);	
						}
					else{
					  strProps += " " + key + " : " + o[key] + "\n";
					}
				  }	
			  }
		  }
		  else {throw new Error("geen object")}
		  return strProps;
}

//---------------------------------------------
function objectToArray(obj){
	//converteert een JS object nr een array, recursief
	//return array
	//interne fucntie
	var isObjectOrArray = function(o){
		//object of een array
		return (typeof o === 'object');
		}
	//zeker weten dat dit een object of een array is
	if(obj && isObjectOrArray(obj)){
		var lijst = [];
		//overloop properties en key en waarde om in subarray
		for(var key in obj){
			var k = key.toString();
			var v = obj[key];
			//recursie voor arrays en objecten
			if(isObjectOrArray(obj[key])){
				v = objectToArray(obj[key]);
				}
			lijst.push([k,v]);
			}
		return lijst;
		}
	}
	
/************** CONSTRUCTORS  ****************************/




	//+++ El CLASS CONSTRUCTOR ++++++++++++++++++++++++++++++++++++
	
	function El(opties){
		/*
		HTML element factory
		dependency: overschrijf(), addEvent(), removeEvent(), cssKlasse() in nuttig_lib
		@opties: object, optioneel, kan bevatten als props
		- element	: string, de tagname, default div
		- style		: object, voor het style attrib, dus inline stylerules als props van het object,
		- attribs	: object, alle andere attribs als props van het object, met uitzondering van CLASS, dat wordt apart meegegeven als
		- cssClass	: Array van Strings, één of meerdere class waarden
		- events	: Array van objecten. Elk te koppelen event is een item in dit array en bestaat uit een object met twee properties: 'type' voor het type event, en 'fn' een referentie naar de eventhandler of anonieme functie.

		
		*/
		var defaultSettings = { 
			element	:	"div",
			style	:	{},
			attribs	:	{},
			events	:	[]
		}
		
		var opties 		=  opties || {}; 
		var settings 	=  defaultSettings; 
		
		//opties instellen
		overschrijf(opties, settings);	//nuttig_lib functie
		
		//element aanmaken
		var e = document.createElement(settings.element);	
		
		//settings toepassen
		//ATTRIBUTEN,uitgezonderd class en style
		for(var key in settings.attribs){
			var sleutel = key.toString();
			if(sleutel!="class"||sleutel!="style"){
				e.setAttribute(sleutel, settings.attribs[key]);
			}
		}
		//CSS class
		if(settings.cssClass) 	e.cssKlasse('add',settings.cssClass);
		//inline STYLE
		var styleRules 	= "";	//CSS tekst opbouwen uit settinsg.style
		for (var key in settings.style){
			styleRules += key + ":" + settings.style[key] + ";"; 
			}
		e.setAttribute("style", styleRules);
		//debug_log(styleRules);
		
		//event handlers koppeling volgens John Resig methods
		for(var i=0;i<settings.events.length;i++){
			 addEvent(e,settings.events[i].type, settings.events[i].fn)
			}
		
		return  e;
       }
	   
//---------------------------------------------

//+++ Element AUGMENTATION +++++++++++++++++++++++++++++++++++++++++++++
	
	Element.prototype.cssKlasse = function(actie, cssClass){
		/*
		Augmentation van Element = geldige DOM node, geen eigen object
		method om css class tokens toe te voegen of te verwijderen aan een element, bv element.cssKlasse('add','groen')
		
		@actie		string, verplicht, de handeling: "add" of "remove"
		@cssClass	array van strings, minstens één item
		
		vb: mijnDiv.cssKlasse("add", ["rood", "belangrijk"])
		
		*/
		//debug_log(cssClass + typeof cssClass + cssClass.constructor + isArray(cssClass));
		
		if(actie && cssClass && isArray(cssClass)){
			//huidige waarde van CLASS, mogelijk undefined indien geen attrib
			var klasTekst 	= this.className;
			var regs = [];
			for(var i=0;i<cssClass.length;i++){
					regs[i] = new RegExp('\\b'+ cssClass[i] + '\\b');
				}
			var sp = (klasTekst=="")?"":" ";
			//debug_log(klasTekst)
			switch (actie){
				case "add":
					for(var i=0;i<regs.length;i++){
						if(i>0) sp=" ";
						if(regs[i].test(klasTekst)==false){
							
							this.className += sp + cssClass[i];
						}
					}
					break;
				case "remove":
						for(var i=0;i<cssClass.length;i++){
							var vervangTekst  = klasTekst.match(' ' + cssClass[i])?' ' + cssClass[i]:cssClass[i];
     				 		this.className = Element.className.replace(vervangTekst,'');
						}
					break;
				default:
					throw new Error ('cssKlasse: ongekende actie');
			}//einde switch
			return Element;
		}
		else {
			throw new Error ('cssKlasse: foutieve argumenten ');
		}
	}
	



/************** EVENTS  ****************************/
/*
	addEvent/removeEvent fucnties door John Resig 
		http://ejohn.org/blog/flexible-javascript-events/
	naar aanleiding van de wedstrijd dr Pter Paul Koch 2005
		http://www.quirksmode.org/blog/archives/2005/09/addevent_recodi.html
	supports bijna alles en is kort
	
	@obj	object, element waarop het event werkt
	@type	de naam van het event, 'click'
	@fn		fucntion, de event handler
	
	vb:
	
	addEvent( document.getElementById('foo'), 'click', doSomething );
	addEvent( obj, 'mouseover', function(){ alert('hello!'); } );
	removeEvent( object, eventType, function );
	
	*/
function addEvent( obj, type, fn ) {
	  if ( obj.attachEvent ) {
		obj['e'+type+fn] = fn;
		obj[type+fn] = function(){obj['e'+type+fn]( window.event );}
		obj.attachEvent( 'on'+type, obj[type+fn] );
	  } else
		obj.addEventListener( type, fn, false );
	}
//---------------------------------------------
function removeEvent( obj, type, fn ) {
	  if ( obj.detachEvent ) {
		obj.detachEvent( 'on'+type, obj[type+fn] );
		obj[type+fn] = null;
	  } else
		obj.removeEventListener( type, fn, false );
	}
	
