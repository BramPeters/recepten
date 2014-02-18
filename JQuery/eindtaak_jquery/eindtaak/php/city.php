<?php

class City {

	private $geo_name_id;
	private $latitude;
	private $longitude;
	
	//constructor
	public function __construct($geo_name_id,$latitude,$longitude){
	
		$this->setGeoNameId($geo_name_id);
		$this->setLatitude($latitude);
		$this->setLongitude($longitude);
		
	}
	
	//setters
	public function setGeoNameId($geo_name_id){
		$this->geo_name_id = $geo_name_id;
	}
	public function setLatitude($latitude){
		$this->latitude=$latitude;
	}
	public function setLongitude($longitude){
		$this->longitude=$longitude;
	}
	//getters
	public function getGeoNameId(){
		return $this->geo_name_id;
	}
	public function getLatitude(){
		return $this->latitude;
	}
	public function getLongitude(){
		return $this->longitude;
	}
	
}


?>