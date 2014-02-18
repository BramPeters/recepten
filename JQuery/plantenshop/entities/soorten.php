<?php

class Soort {

	private $soort;
	private $soort_id;
	
	//constructor
	public function __construct($soort_id,$soort){
	
		$this->setSoortId($soort_id);
		$this->setSoort($soort);
	}
	
	//setters

	public function setSoortId($soort_id){
			$this->soort_id=$soort_id;
	}
	public function setSoort($soort){
		$this->soort=$soort;
	}
	//getters

public function getSoortId(){
		return $this->soort_id;
	}
	public function getSoort(){
		return $this->soort;
	}
}


?>