<?php
//datalaag

require_once("city.php"); //pad steeds vanuit de controller
require_once("country.php"); //pad steeds vanuit de controller
require_once("airport.php"); //pad steeds vanuit de controller

require_once("abstractdao.php"); //connectiegegevens
//require_once("exceptions/missingdataexception.php");
//require_once("exceptions/duplicatekeyexception.php");

class AirportDAO extends AbstractDAO{

	//elke functie heeft een atomaire data-taak: één ding
	
	
	
	
	
	public function getResultSetAirportsByCountryCode($country_code){
		// returnt de resultset van alle planten met een query waarin alle velden parameters kunnen geven
					
			$country_code 	= (empty($country_code))?"%":$country_code;
			
			
			/*
			default 
			
			SELECT * FROM airports where country_code like "%";
			*/
			
			$sqlAirports =  "SELECT *";
			$sqlAirports .= " FROM airports a ";
			$sqlAirports .= " WHERE country_code LIKE '".$country_code ."' ";
			
			//echo $sqlAlleCriteria;
			// oppassen: de querystring wordt bovenaan de pagina getoond: op dat ogenblik gaat er iets mis met de css van de tabel, dus gewoon de qs neutraliseren en alles is weer OK
			
			
			$db = $this->createConnection(); //uit abstractdao.php
			$result = $db->query($sqlAirports);
			$db->close();
			return $result;	

	}	
	
	public function getArrayAirportsByCountryCode($country_code){
		// returnt een array van plantobjecten (alle)
		$airports = array();
		$db = $this->createConnection(); //uit abstractdao.php
		$country_code 	= (empty($country_code))?"%":$country_code; //default waarde

		$sqlAirports =  "SELECT *";
		$sqlAirports .= " FROM airports a ";
		$sqlAirports .= " WHERE country_code LIKE '".$country_code ."' ";
		
		$result = $db->query($sqlAirports);
		if($result){ 
			$aantalrecords=$result->num_rows;
			$aantalVelden=$result->field_count;
			//echo "$aantalrecords";
			while ($row = $result->fetch_array()){
				//airport object
				$airport = new Airport($row["airport_code"],$row["airport_name"],$row["city_name"],$row["country_code"],$row["latitude"],$row["longitude"],$row["world_area_code"],$row["city_name_geo_name_id"],$row["country_name_geo_name_id"]);
				//toevoegen aan het array
				array_push($airports,$airport);		
			}
			$result->close();
		}
		$db->close();
		return $airports;
	}	

	
	public function getArrayAlleAirports(){
		// returnt een array van airportobjecten (alle)
		$airports = array();
		$db = $this->createConnection(); //uit abstractdao.php
		$result = $db->query("select * from airports");
		if($result){ 
			$aantalrecords=$result->num_rows;
			$aantalVelden=$result->field_count;
			//echo "$aantalrecords";
			while ($row = $result->fetch_array()){
				//airport object
				$airport = new Airport($row["airport_code"],$row["airport_name"],$row["city_name"],$row["country_code"],$row["latitude"],$row["longitude"],$row["world_area_code"],$row["city_name_geo_name_id"],$row["country_name_geo_name_id"]);
				//toevoegen aan het array
				array_push($airports,$airport);		
			}
			$result->close();
		}
		$db->close();
		return $airports;
	}	
	
	
	public function getArrayAlleCities(){
		// returnt een array van cityobjecten (alle)
		$cities = array();
		$db = $this->createConnection(); //uit abstractdao.php
		$result = $db->query("select * from cities");
		if($result){ 
			$aantalrecords=$result->num_rows;
			$aantalVelden=$result->field_count;
			//echo "$aantalrecords";
			while ($row = $result->fetch_array()){
				//airport object
				//$geo_name_id,$latitude,$longitude
				$city = new City($row["geo_name_id"],$row["latitude"],$row["longitude"]);
				//toevoegen aan het array
				array_push($cities,$city);		
			}
			$result->close();
		}
		$db->close();
		return $cities;
	}	
	
	public function getArrayAlleCountries(){
		// returnt een array van countryobjecten (alle)
		$countries = array();
		$db = $this->createConnection(); //uit abstractdao.php
		$result = $db->query("select * from countries");
		if($result){ 
			$aantalrecords=$result->num_rows;
			$aantalVelden=$result->field_count;
			//echo "$aantalrecords";
			while ($row = $result->fetch_array()){
				//country object
				//$country_code,$country_name
				$country = new Country($row["country_code"],$row["country_name"]);
				//toevoegen aan het array
				array_push($countries,$country);		
			}
			$result->close();
		}
		$db->close();
		return $countries;
	}
	
	public function getArrayCountryByCountryCode($country_code){
		// returnt een array van plantobjecten (alle)
		$countries = array();
		$db = $this->createConnection(); //uit abstractdao.php
		$country_code 	= (empty($country_code))?"%":$country_code; //default waarde

		$sqlCountries =  "SELECT *";
		$sqlCountries .= " FROM countries c ";
		$sqlCountries .= " WHERE country_code LIKE '".$country_code ."' ";
		
		$result = $db->query($sqlCountries);
		if($result){ 
			$aantalrecords=$result->num_rows;
			$aantalVelden=$result->field_count;
			//echo "$aantalrecords";
			while ($row = $result->fetch_array()){
				//country object
				//$country_code,$country_name
				$country = new Country($row["country_code"],$row["country_name"]);
				//toevoegen aan het array
				array_push($countries,$country);		
			}
			$result->close();
		}
		$db->close();
		return $countries;
	}	

	
	public function getCityByCode($geo_name_id){
		// returnt één cityobject
		
		$db = $this->createConnection(); //uit abstractdao.php
		$sqlCity =  "SELECT *";
		$sqlCity .= " FROM cities c ";
		$sqlCity .= " WHERE geo_name_id LIKE '".$geo_name_id ."' ";
		
		$city = null;
		
		$result = $db->query(sqlCity);
		if($result){ 
			$aantalrecords=$result->num_rows;
			$aantalVelden=$result->field_count;
			//echo "$aantalrecords";
			while ($row = $result->fetch_array()){
				//airport object
				//$geo_name_id,$latitude,$longitude
				$city = new City($row["geo_name_id"],$row["latitude"],$row["longitude"]);
					
			}
			$result->close();
		}
		$db->close();
		return $city;
	}	
	public function getCountryByCode($country_code){
		// returnt één countryobject
		
		$db = $this->createConnection(); //uit abstractdao.php
		$sqlCountry =  "SELECT *";
		$sqlCountry .= " FROM countries c ";
		$sqlCountry .= " WHERE country_code LIKE '".$country_code ."' ";
		
		$country = null;
		
		$result = $db->query(sqlCountry);
		if($result){ 
			$aantalrecords=$result->num_rows;
			$aantalVelden=$result->field_count;
			//echo "$aantalrecords";
			while ($row = $result->fetch_array()){
				//airport object
				//$country_code,$country_name
				$country = new Country($row["country_code"],$row["country_name"]);
					
			}
			$result->close();
		}
		$db->close();
		return $country;
	}	
	
	
//einde class	
}

?>