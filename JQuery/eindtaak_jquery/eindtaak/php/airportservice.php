<?php 
//BUSINESS LAAG


require_once("airportdao.php");

class AirportService{

	public function geefJSONAlleAirports(){
	
		$airports = $this->geefArrayAlleAirports(); //array van airportobjecten
		$aps = array();

		foreach ($airports as $i => $airport) {
			$ap = array("airport_code" => $airport->getAirportCode(), "airport_name"=> $airport->getAirportName());
			array_push($aps,$ap);
		}
		
		//andere taken hier
		return json_encode($aps);
	}
	
	public function geefArrayAlleAirports(){
	
		$dao = new AirportDAO();
		$airports = $dao->getArrayAlleAirports(); //array
		//andere taken hier
		return $airports;
	}
	
	public function geefResultSetAirportsByCountryCode($country_code){
	
		$dao = new AirportDAO();
		$airports = $dao->getResultSetAirportsByCountryCode($country_code); //resultset
		//andere taken hier
		return $airports;
	}
	public function geefArrayAirportsByCountryCode($country_code){
	
		$dao = new AirportDAO();
		$airports = $dao->getArrayAirportsByCountryCode($country_code); //resultset
		//andere taken hier
		return $airports;
	}
	
	public function geefJSONAirportsByCountryCode($country_code){
	
		$airports = $this->geefArrayAirportsByCountryCode($country_code); //array van airportobjecten
		$aps = array();

		foreach ($airports as $i => $airport) {
			$ap = array("airport_code" => $airport->getAirportCode(), "airport_name"=> $airport->getAirportName());
			array_push($aps,$ap);
		}
		//andere taken hier
		return json_encode($aps);
	}
	
	
	public function geefArrayAlleCountries(){
	
		$dao = new AirportDAO();
		$countries = $dao->getArrayAlleCountries(); //array
		//andere taken hier
		return $countries;
	}
	public function geefJSONAlleCountries(){
	
		$countries = $this->geefArrayAlleCountries(); //array van countryobjecten
		$cns = array();

		foreach ($countries as $i => $country) {
			$cn = array("country_code" => $country->getCountryCode(), "country_name"=> $country->getCountryName());
			array_push($cns,$cn);
		}
		
		//andere taken hier
		return json_encode($cns);
	}
	
	public function geefArrayCountryByCountryCode($country_code){
	
		$dao = new AirportDAO();
		$country = $dao->getArrayCountryByCountryCode($country_code); //resultset
		//andere taken hier
		return $country;
	}
	
	public function geefJSONCountryByCountryCode($country_code){
	
		$countries = $this->geefArrayCountryByCountryCode($country_code); //array van airportobjecten
		$cns = array();

		foreach ($countries as $i => $country) {
			$cn = array("country_code" => $country->getCountryCode(), "country_name"=> $country->getCountryName());
			array_push($cns,$cn);
		}
		//andere taken hier
		return json_encode($cns);
	}
}



?>