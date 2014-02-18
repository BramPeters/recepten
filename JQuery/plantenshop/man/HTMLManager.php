<?php

//**********CLASSES voor HTML elementen********************************************************//

//BASE CLASS voor html elementen

class HTMLElement {
	
	protected $id;			//id attrib
	protected $CSSclass;	//CSS class
	
	public function getId(){
		return $this->id;
	}	
	public function getCSSclass(){
		return $this->CSSclass;
	}
	public function setId($id){
		$this->id = (string) $id; //type casting
	}	
	public function setCSSclass($CSSclass){
		$this->CSSclass = (string) $CSSclass;
	}
	
	public function parse(){
	//abstract method in te vullen door de subclasses
	}

}//einde base Class

//*****************************************************************************************//

class Dropdown extends HTMLElement{
	//eenvoudig: geen multiple en geen optiongroups
	
	private $defaultValue = array(); //tweedelige array van waarde=tekst
	private $selected;
	protected $values = array(); //array van tweedelige arrays van waarde=tekst
	
	/*constructor
	* @return SELECT element
	* @param string $name de naam en id van het element
	* @param array $values	een array van waarden, string en number
	* @param string[optional] $selected	 waarde waarmee vergeleken wordt en die geselecteerd moet zijn. Opletten: hoofdlettergevoelig!
	* @param string[optional] $class	CSS class
	* @param string[optional] $firstOption	 tekst voor eerste waarde
	* @param boolean[false] $valueIsLabel  true: hde value van de option is identiek aan de tekst in het label, dus net alsof er geen value attr is

	*/
	public function __construct($name, array $values, $CSSclass=null, $title=null, $selected=null, $firstOption=null, $valueIsLabel=false, $multiple=false){
	
		//verplichte attribs
		$this->setId($name);
		$this->setName($name); 
		$this->setValues($values);
		$this->setValueIsLabel($valueIsLabel);
		$this->setMultiple($multiple);
		$this->title = ""; //default
	
		//optionele argumenten
		if($selected!==null) 	$this->selected=$selected;
		if($CSSclass!==null) 	$this->setCSSclass($CSSclass);
		if($title!==null) 		$this->setTitle($title);
		if($firstOption!==null) $this->setFirstOption($firstOption);
		
	}
	
	//setters
	public function setName($name){
		$this->name = (string) $name;
	}	
	
	private function setValues(array $values = array()){
	//leeg? onmogelijk: minstens één option element
		if(count($values)==0) throw new Exception('het array values is leeg: moet minstens één item bevatten');
		//produceer options
		foreach ($values as $key => $value){
			$this->values[$key] = $value;
		}
	}
	
	private function setFirstOption($label, $value=null){
		//stel de defaultValue in
		$this->defaultValue = array($label,$value); 
	}
	public function setValueIsLabel($valueIsLabel){
		$this->valueIsLabel = (boolean) $valueIsLabel;
	}	
	public function setMultiple($multiple){
		//indien multiple meot er geen eerste  defaultValue zijn: 'maak een keuze'
		$this->multiple = (boolean) $multiple;	
	}	
	public function setTitle($title){
		$this->title = (string) $title;
	}
	
	//getters
	public function getValues(){
		return $this->values;
	}	
	public function getDefaultValue(){
		return $this->defaultValue;
	}	
	public function getSelected(){
	//voorlopig enkele voor een single-select
		return $this->selected;
	}
	public function getName(){
		return $this->name;
	}
	public function getValueIsLabel(){
		return $this->valueIsLabel;
	}
	//aanmaken 
	private function makeOption($label, $value=null, $selected=false){
		//return een option element
		// indien de value gelijk moet zijn aan het label, zoals <option value='rood'>rood</option>, moet je de value ook doorgeven als het argument $label in parse()
		//if(($label==null)||($label=='')) throw new Exception('het option element moet een label hebben');
		$o  = "<option";
		$o .= " value='" . $value. "'";
		if($selected==true) $o .= " selected='selected'";
		$o .= ">" . $label;
		$o .= "</option>\r\n";
		return $o;
	}
	
	public function parse(){
		//aanmaken select
		//controles
		if($this->getName()=='') throw new Exception('een \'name\' is verplicht voor dit element');
		//opbouwen
		$e = "<select id='".$this->getId()."' name='".$this->getId()."' title='".$this->title."' ";
		if($this->getCSSclass()!==null)  $e .= " class='".$this->getCSSclass()."'";
		if($this->multiple===true)  $e .= " multiple='multiple' ";
		$e .= ">\r\n"; //einde starttag
		
		//eventueel defaultValue indien geen multiple
		$dv = $this->getDefaultValue();
		if(($this->multiple===false) && (count($dv)!=0)) $e .=  $this->makeOption($dv[0], $dv[1],false);
		
		//andere option elementen
		foreach($this->values as $value => $label){
			$s = ($this->getSelected()==$label)?true:false;
			$v = ($this->getValueIsLabel()==true)?$label:$value; //vervang de value door het label indien gevraagd
			$e .=  $this->makeOption($label, $v, $s);
		}
		$e .= "</select>\r\n"; //eindtag
		
		return $e;
	}
}

//*****************************************************************************************//
class Tabel extends HTMLElement{
//een TABLE element

	private $koppen	= array(); //een array van arrays: elk array item is zelf een array ->  rijen met cellen
	private $footer = array();
	private $rijen 	= array();
	
	/*constructor
	* @return TABLE element
	* @param string $id de  id van het element
	* @param array $values	een array van waarden, mixed
	* @param array $koppen[optional] een array van string (tekst en HTML): de titels voor de tabel
	* @param array $voet[optional] een array van string (tekst en HTML): de footer voor de tabel
	* @param string[optional] $class	CSS class

	*/
	public function __construct($id, array $values, $koppen=null, $voet=null, $CSSclass=null){
	
		//verplichte argumenten
		$this->setId($id);
		$this->setValues($values);
	
		//optionele argumenten
		if($CSSclass!==null)	$this->setCSSclass($CSSclass);
		if($koppen!==null) 		$this->setKoppen($koppen); 
		if($voet!==null) 		$this->setFooter($voet); 
	
	}
	
	//setters
	
	private function setValues(array $values = array()){
	//verplicht
		if(count($values)==0) throw new Exception('het array values is leeg: moet minstens één item bevatten');
		foreach ($values as $value){
			array_push($this->rijen,$value);
		}
	}
	private function setKoppen(array $koppen = array()){
	//optioneel
			foreach ($koppen as $kopRij){
				array_push($this->koppen,$kopRij);
			}
	}
	private function setFooter($footer= array()){
	//optioneel
			foreach ($footer as $footRij){
				array_push($this->footer,$footRij);
			}
	}
	
	//getters
	private function getThead(){
		if(count($this->koppen)!=0){
			$th = "<thead>\r\n";
			
			foreach($this->koppen as $kopRij){
				if (is_array($kopRij)){
					$th .= "<tr>";
					foreach($kopRij as $cel){
							$th .= "<th>" . $cel . "</th>"; 
					}
					$th .= "</tr>\r\n";
				}
				else throw new Exception('het $koppen array moet zelf uit array elemente bestaan');
				}
			$th .= "</thead>\r\n";
			return $th;
		}
	}
	
	private function getTfoot(){
		if(count($this->footer)!=0){
			
			$tf = "<tfoot>\r\n";
			foreach($this->footer as $footRij){
				if (is_array($footRij)){
					$tf .= "<tr>";
					foreach($footRij as $cel){
							$tf .= "<td>" . $cel . "</td>"; 
					}
					$tf .= "</tr>\r\n";
				}
				else throw new Exception('het $footer array moet zelf uit array elemente bestaan');
			}
			$tf .= "</tfoot>\r\n";
			return $tf;
		}
	}
	
	private function getTbody(){
		if(count($this->rijen)!=0){
			$tb = "<tbody>\r\n";
			foreach($this->rijen as $waardenRij){
				if (is_array($waardenRij)){
					$tb .= "<tr>";
					foreach($waardenRij as $cel){
							$tb .= "<td>" . $cel . "</td>"; 
					}
					$tb .= "</tr>\r\n";
				}
				else throw new Exception('het $rijen array moet zelf uit array elementen bestaan');
			}
			$tb .= "</tbody>\r\n";
			return $tb;
		}
	}
	
	//aanmaken 
	public function parse(){
		//controles
		if($this->getId()=='') throw new Exception('een \'id\' is verplicht voor dit element');
		//opbouwen
		$t = "<table id='".$this->getId()."' ";
		if($this->getCSSclass()!==null)  $t .= "class='".$this->getCSSclass() . "' ";
		$t .= ">\r\n"; //einde starttag
		//thead (optioneel)
		$thead= $this->getThead();
		if($thead!==null) $t .= $thead;
		//tfoot (optioneel)
		$tfoot= $this->getTfoot();
		if($tfoot!==null) $t .= $tfoot;
		//tbody
		$t .= $this->getTbody();
		//eindtag
		$t .= "</table>\r\n"; 
		
		return $t;
	}

}


//*****************************************************************************************//
class Lijst extends HTMLElement{
//een UL of OL element

	
	private $type 	= "ul";
	private $items 	= array();
	private $rijen 	= array();
	/*constructor
	* @return UL of OL element met LI elementen
	* @param string $ulol een UL of een OL element, default UL
	* @param array $values	een array van waarden, mixed
	* @param string $id de  id van het element
	* @param string[optional] $CSSclass	CSS class

	*/
	public function __construct( $ulol, array $values, $id, $CSSclass=null){
	
		//verplichte argumenten
		$this->setLijst($ulol);
		$this->setId($id);
		$this->setValues($values);
	
		//optionele argumenten
		if($CSSclass!==null)	$this->setCSSclass($CSSclass);
		
	
	}
	
	//setters
	
	private function setValues(array $values = array()){
	//verplicht
		if(count($values)==0) throw new Exception('het array values is leeg: moet minstens één item bevatten');
		foreach ($values as $value){
			array_push($this->rijen,$value);
		}
	}
	private function setLijst($ulol){
	//verplicht maar default
			if($ulol=="ul"||$ulol=="ol") $this->type=$ulol;	
	}
	public function getType(){
		return $this->type;
	}	
	
	//aanmaken 
	public function parse(){
		//controles
		if($this->getId()=='') throw new Exception('een \'id\' is verplicht voor dit element');
		
		//opbouwen
		
		$lijst = "<". $this->getType(). " id='".$this->getId()."' ";
		if($this->getCSSclass()!==null)  $lijst .= "class='".$this->getCSSclass() . "' ";
		$lijst .= ">\r\n"; //einde starttag
		foreach ($this->rijen as $value){
			$lijst .= "<li>" . $value . "</li>";
		}
		//eindtag
		$lijst .= "\r\n</". $this->getType(). ">\r\n"; 
		
		return $lijst;
	}

}
?>