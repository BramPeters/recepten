<?php

class Plant {

	private $art_code;
	private $plantennm;
	private $kleur;
	private $hoogte;
	private $bl_b;
	private $bl_e;
	private $prijs;
	private $soort_id;
	
	//constructor
	public function __construct($art_code,$plantennm,$kleur,$hoogte,$bl_b,$bl_e,$prijs,$soort_id){
	
		$this->setArtCode($art_code);
		$this->setPlantennm($plantennm);
		$this->setKleur($kleur);
		$this->setHoogte($hoogte);
		$this->setBl_B($bl_b);
		$this->setBl_E($bl_e);
		$this->setPrijs($prijs);
		$this->setSoortId($soort_id);

	}
	
	//setters
	public function setArtCode($art_code){
		$this->art_code =$art_code;
	}
	public function setPlantennm($plantennm){
		$this->plantennm=$plantennm;
	}
	public function setKleur($kleur){
		$this->kleur=$kleur;
	}
	public function setHoogte($hoogte){
		$this->hoogte=$hoogte;
	}
	public function setBl_B($bl_b){
		$this->bl_b=$bl_b;
	}
	public function setBl_E($bl_e){
		$this->bl_e=$bl_e;
	}
	public function setPrijs($prijs){
		$this->prijs=$prijs;
	}
	public function setSoortId($soort_id){
		$this->soort_id=$soort_id;
	}
	//getters

	public function getArtCode(){
		return $this->art_code ;
	}
	public function getPlantennm(){
		return $this->plantennm;
	}
	public function getKleur(){
		return $this->kleur;
	}
	public function getHoogte(){
		return $this->hoogte;
	}
	public function getBl_B(){
		return $this->bl_b;
	}
	public function getBl_E(){
		return $this->bl_e;
	}
	public function getPrijs(){
		return $this->prijs;
	}
	public function getSoortId(){
		return $this->soort_id;
	}
}


?>