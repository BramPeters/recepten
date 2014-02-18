<?php

class Airport {

	private $airport_code;
	private $airport_name;
	private $city_name;
	private $country_code;
	private $latitude;
	private $longitude;
	private $world_area_code;
	private $city_name_geo_name_id;
	private $country_name_geo_name_id;
	
	//constructor
	public function __construct($airport_code,$airport_name,$city_name,$country_code,$latitude,$longitude,$world_area_code,$city_name_geo_name_id,$country_name_geo_name_id){
	
		$this->setAirportCode($airport_code);
		$this->setAirportName($airport_name);
		$this->setCityName($city_name);
		$this->setCountryCode($country_code);
		$this->setLatitude($latitude);
		$this->setLongitude($longitude);
		$this->setWAC($world_area_code);
		$this->setCityGeoId($city_name_geo_name_id);
		$this->setCountryGeoId($country_name_geo_name_id);

	}
	
	//setters
	public function setAirportCode($airport_code){
		$this->airport_code =$airport_code;
	}
	public function setAirportName($airport_name){
		$this->airport_name=$airport_name;
	}
	public function setCityName($city_name){
		$this->city_name=$city_name;
	}
	public function setCountryCode($country_code){
		$this->country_code=$country_code;
	}
	public function setLatitude($latitude){
		$this->latitude=$latitude;
	}
	public function setLongitude($longitude){
		$this->longitude=$longitude;
	}
	public function setWAC($world_area_code){
		$this->world_area_code=$world_area_code;
	}
	public function setCityGeoId($city_name_geo_name_id){
		$this->city_name_geo_name_id=$city_name_geo_name_id;
	}
	public function setCountryGeoId($country_name_geo_name_id){
		$this->country_name_geo_name_id=$country_name_geo_name_id;
	}
	//getters
	public function getAirportCode(){
		return $this->airport_code;
	}
	public function getAirportName(){
		return $this->airport_name;
	}
	public function getCityName(){
		return $this->city_name;
	}
	public function getCountryCode(){
		return $this->country_code;
	}
	public function getLatitude(){
		return $this->latitude;
	}
	public function getLongitude(){
		return $this->longitude;
	}
	public function getWAC(){
		return $this->world_area_code;
	}
	public function getCityGeoId(){
		return $this->city_name_geo_name_id;
	}
	public function getCountryGeoId(){
		return $this->country_name_geo_name_id;
	}
	
}


?>