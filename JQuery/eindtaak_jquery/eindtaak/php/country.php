<?php

class Country {

	private $country_code;
	private $country_name;
	
	
	//constructor
	public function __construct($country_code,$country_name){
	
		$this->setCountryCode($country_code);
		$this->setCountryName($country_name);
		
	}
	
	//setters
	public function setCountryCode($country_code){
		$this->country_code =$country_code;
	}
	public function setCountryName($country_name){
		$this->country_name=$country_name;
	}
	
	//getters
	public function getCountryCode(){
		return $this->country_code ;
	}
	public function getCountryName(){
		return $this->country_name;
	}
	
}


?>