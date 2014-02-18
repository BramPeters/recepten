// VALIDATOR widget voor ui.js
/*
Principe: validator wordt opgestrat op een form element. Alle formvelden in dat element worden getest volgens de CLASS die ze hebben: als deze classes overeen komen met een property van het object fouten
*/

var VALIDATOR = function(){
	
	/*fouten object bevat alle te valideren fouten met telkens het foutbericht*/
	var fouten = {
	
	required:{
		/* enkel voor input type="text" */
		msg: "verplicht veld",
		test: function (elem){
			var eName = elem.nodeName.toLowerCase();
			//var eType = elem.getAttribute('type').toLowerCase();//werkt wel in IE	
			/*if (eName == "input" && 
					(elem.getAttribute('type').toLowerCase()=="text"|| 
														   elem.getAttribute('type').toLowerCase()=="password")){	*/	
				return (elem.value!=""); //return de boolean van deze test
			/*	}
			else {throw new Error('Deze functie is specifiek voor een INPUT type TEXT/PASSWORD element')}*/
			}
		},
		
	aantal:{
		msg: "aantal verwacht",
		test: function(elem){
				//aantal is op zich niet verplicht, maar als er inhoud is, dan moet het een getal zijn
				if(elem.value != ""){
					return  !isNaN(elem.value);
				} else {return true;}
				
				
			}
		},
		
	datum:{
		msg: "datum ongeldig (d/m/yyyy)",
		test: function(elem){
				//re voor datum patronen, kies er eentje
				var re_datum0 = /^\d{2}\/\d{2}\/\d{4}$/; //dd/mm/yyy te eenvoudig 55/88/9999 mogelijk
				var re_datum1 = /^\d{4}-[0-9]|[0,1,2][0-9]-[0-9]|[0,1,2][0-9]|3[0,1]$/; // yyyy-mm-dd
				var re_datum2= /^([0-9]|[0,1,2][0-9]|3[0,1])\/([\d]|1[0,1,2])\/\d{4}$/;	// dd/mm/yyyy
				var re_datum3 = /^[\d]|1[0,1,2]\/[0-9]|[0,1,2][0-9]|3[0,1]\/\d{4}$/; 	// mm/dd/yyyy
				
				var re = re_datum2; //wissel hier de gewenste regex
				/*				
				var okee = re_datum2.test(elem.value);
				debug_log("datumtest %s valideert %s", elem.value,okee);
				*/
				if(elem.value != ""){
					return re.test(elem.value);
				} else {return true;}
			}
		},
	email:{
		msg: "geen geldig emailadres",
		test: function(elem){
				//re voor datum patronen, kies er eentje
				var re =/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
				/*				
				var okee = re_email.test(elem.value);
				debug_log("emailtest %s valideert %s", elem.value,okee);
				*/
				if(elem.value != ""){
					return re.test(elem.value);
				} else {return true;}
			}
		}
		
	
	}
	//private fucntion
	function soortEl(el){
		/*
		returnt de tagName van een element in kleine letters
		om minder fouten te krijgen gebruiken we nodeName
		*/
		if(el && el.nodeName){
			return el.nodeName.toLowerCase();
		}
		else{
			throw new Error('kan nodeName niet lezen: geen DOM element')
			}
	}

//+++ Validator CONSTRUCTOR ++++++++++++++++++++++++++++++++++++++
	
	var Validator = function(){
		
		this.form; 	//wordt ingevuld door start()
		this.debug = false;
		  
		};
	
	//++++++++++++++++++++++++++++++++++++++++++++++++++
	Validator.prototype.info= function(e){
			return "Hi, VALIDATOR Widget hier";
		}		
	//++++++++++++++++++++++++++++++++++++++++++++++++++
	Validator.prototype.start = function(frmEl){
		/*
		initialisatie van de app
		*/
		if(frmEl && soortEl(frmEl)=="form"){
			var ss = {url:"validator.css",type:"stylesheet",id:"ui_validator_stylesheet", media:"screen"};
			UI.addModule(ss);
			
			this.form = frmEl;
			var self = this; // in een event handler wordt this het targetElement
			this.form.onsubmit = function(){
				try {
				  
				  var v = self.valideer();
				  if(self.debug===true) return false;
				  else return v;
				}
				catch(e){alert(e);return false} //en manier om bij JS fouten toch geen submit te doen
				}
			}
		else{
			throw new Error('element is geen form: kan validator niet toepassen')
			}
	}
	//++++++++++++++++++++++++++++++++++++++++++++++++++
	Validator.prototype.valideerVeld = function(elem){
	  //valideert één veld volgens zijn class
	  var errors=[];
	  for (var fout in fouten){
		  
		  var re = new RegExp("(^|\\s)" + fout + "(\\s|$)"); //regex voor de class
		  
		  //heeft dit elem een dergelijke fouten class?
		  if(re.test(elem.className)){
			  //is hij geslaagd voor de test van die foutenclass?
			  var okee = fouten[fout].test(elem);
			  //debug_log("het element %s met name %s wordt gevalideerd voor %s: %s",elem.nodeName,elem.name, fout, okee);
			  if(!okee){
			   errors.push(fouten[fout].msg); //voeg fout toe aan 
			  }
		  }
	  }
	  
	  if(errors.length>0){ this.showErrors(elem, errors);} //toon de fouten voor dat element	
	  return !(errors.length>0); //return false indien fouten
	}
	
	//----------------------------------------------------------------------------
	Validator.prototype.valideer =  function(){
	
	  var valid = true; //optimistisch geen fouten
	  //lus doorheen alle form elementen van het formulier
	  //kan dit wel? niet alle teste
	  for(var i=0;i<this.form.elements.length;i++){
		var el = this.form.elements[i];
		var soort = soortEl(el);
		if(soort!="fieldset" && soort!="legend") {
			//verwijder alle foutboodschappen als er zijn
			this.hideErrors(el);
			
			var okee = this.valideerVeld(el); //returnt Boolean
			debug_log("het element %s met name %s valideert %s",soort,el.name, okee);
			if(okee===false){	valid = false;  }
		}
	  }//einde for
	  return valid //valid;
	}
//----------------------------------------------------------------------------
  Validator.prototype.showErrors = function(elem, errors){
	  //toont alle fouten voor één element
	  //zoek de nextSibling van het veld
	  //debug_log("errors %s",errors.length);
	  var broertje = elem.nextSibling;
	  //debug_log("element %s; broertje: %s",elem.nodeName,broertje.nodeName);
	  //als er geen sibling is of de sibling bestaat maar is geen foutencontainer dan maken we er eentje
	  if(!broertje || !(broertje.nodeName == "UL" && broertje.className == "fouten" )){
		  broertje = document.createElement('ul');
		  broertje.className = "fouten";
		  elem.parentNode.insertBefore(broertje, elem.nextSibling);
		  }
	  //plaats alle foutberichten erin
	  for(var i=0;i<errors.length;i++){
		  var li = document.createElement('li');
		  li.innerHTML = errors[i];
		  broertje.appendChild(li);
		  }
	  }
//----------------------------------------------------------------------------

	Validator.prototype.hideErrors = function(elem){
	  //verbergt alle foutboodschappen voor een elem
	  var broertje = elem.nextSibling;
	  if(broertje && broertje.nodeName == "UL" && broertje.className == "fouten" ){
		  elem.parentNode.removeChild(broertje);
		  }
	}
//=======PUBLIEK OBJECT======================
	return new Validator();
	
	
}





