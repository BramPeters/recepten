// TOC widget voor ui.js

var TOC = function(){
	
	

//+++ TOC CLASS CONSTRUCTOR +++++++++++++++++++++++++++++++++	

	function Toc(naam){

		//private vars
		this.koppen 		= ["h1","h2","h3","h4","h5","h6"]; // alle mogelijke koppen
		this.startLevel 	= 2;
		this.koppenMetId 	= [];			//collection van Hx koppen die een id hebben	
		
		}
	//++++++++++++++++++++++++++++++++++++++++++++++++++
	Toc.prototype.info= function(e){
			return "Hi, TOC Widget hier";
		}
	//++++++++++++++++++++++++++++++++++++++++++++++++++	
	Toc.prototype.start= function(el){
		/*
		maakt de inhoudstafel
		*/
		if(el){
			//el.innerHTML = this.naam;	//debug
			debug_log("inhoudstafel gestart op element " + el.id)
			// voorbereiding
			var alleElementen 	= document.getElementsByTagName("*"); 	//collection van alle elementen
			this.koppenMetId 	= this.getKoppenMetId(alleElementen);  
			//debug_log("aantal koppen: ",this.koppenMetId.length)
			//maak de inhoudstafel
			var inhoudstafel 	= this.maakToc();
			//debug_log(inhoudstafel)
			el.innerHTML 		= "";			//clean element
			el.appendChild(inhoudstafel);
			//el.innerHTML ="test"
			//terug nr boven link
			//this.topLink();
			
			
		}
		else  throw new Error('toc: geen targetelement om toc naartoe te schrijven');
		}
		
	//++++++++++++++++++++++++++++++++++++++++++++++++++
	
	Toc.prototype.stop= function(el){
		el.innerHTML = "widget gestopt";
		}
		
	//++++++++++++++++++++++++++++++++++++++++++++++++++
	Toc.prototype.maakToc = function(){
		
		var inhoud 			= document.createDocumentFragment();	//documentFragment kan eender welke brok DOM bevatten: voor inhoud van de LI
		var aantalKmi		= this.koppenMetId.length;				//aantal 
		var stUl 			= {element	:"ul"};						//settings voor ul 
		var stLi 			= {element	:"li"};						//settings voor li
		var lijst 			= new  El(stUl);						//startlijst
		var huidigeNode 	= lijst;								//huidigeNode = flexibele werkNode waaraan nieuwe LI items vastgehaakt worden
		var level 			= this.startLevel;						//beginniveau
		var prevLevel 		= level;								//vorige niveau
		//debug_log("aantalKmi: " + aantalKmi);

		try {
			
		  //lus doorheen de koppen in dezelfde volgorde
		  for (var i=0;i<aantalKmi;i++){
			  
			  	var kop = this.koppenMetId[i];
				var lie = new El(stLi);	
				level 	= this.getKopLevel(kop);
				/*
				//debug	
				inhoud.appendChild(document.createTextNode("("+level+")" ));
				debug_log("("+i+")" + 'level =' + level + " ,id: "+ koppenMetId[i].id + " ,tekst: "+ koppenMetId[i].firstChild.nodeValue);			  
				*/
				
				if(level>prevLevel){
				//niveau dieper: maak nieuwe lijst en zet als huidigeNode
				  var uul = new  El(stUl);
				  huidigeNode.lastChild.appendChild(uul); //voeg UL toe aan laatste LI
				  huidigeNode = uul;  	
				}
				if(level<prevLevel && i!=aantalKmi-1){
				  //niveau hoger: spring uit huidige lijst en ga een UL hoger
				  huidigeNode = huidigeNode.parentNode.parentNode; //zet huidige node op hogere UL
				 }
				 
				//voor alle items 
				inhoud.appendChild(makeLienk(kop));
				lie.appendChild(inhoud);
				huidigeNode.appendChild(lie)	
				
				prevLevel=level;
		
			}//einde for
			return lijst;
		}
		catch(e){
			//debug_log(e.message)
		}
		
		//geneste functie om specifieke hyperlink te maken
		function makeLienk(k){
				var url 	= '#' + k.id;
				var tekst 	= k.firstChild.nodeValue;  
				var lienk 	= new El({element:"a", attribs:{href:url}})
				lienk.appendChild(document.createTextNode(tekst));
				return lienk; 
			}
	}
	
	//++++++++++++++++++++++++++++++++++++++++++++++++++
	Toc.prototype.getKoppenMetId = function(collection){
			var kmi = [];
			var col = collection || document.getElementsByTagName('*'); //collection of alles
		//overloop alle elementen in volgorde
			//console.time("koppenTimer");
			for(var i=0;i<col.length;i++){
				var e		= col[i];
				var aidee 	= e.id; // 
				var tag 	= e.tagName.toLowerCase();
				
				for (var k=0;k<this.koppen.length;k++){
					if((this.koppen[k]==tag)&&(aidee!="")){
						kmi.push(e); 	// voeg toe aan collectie
						break; 			//breek af zodra gevonden
					}	
				}
			}
			//console.timeEnd("koppenTimer");
			//debug_log(kmi.length);
			return kmi;
	}
	
	//++++++++++++++++++++++++++++++++++++++++++++++++++
	Toc.prototype.getKopLevel = function(kop){
		return parseInt(kop.tagName.substring(1));
	}	
	
	//++++++++++++++++++++++++++++++++++++++++++++++++++
	Toc.prototype.topLink = function(){
		//maakt een fixed link "terug nr boven"
		//nog in te vullen
		}
	//+++ EINDE TOC WIDGET +++++++++++++++++++++++++++++++++++++++++++		
	

//=======PUBLIEK OBJECT======================
	return new Toc();
}


