<?php
	/*
	File name: /classes/Weather.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Calls the Weather API for weather data
	Last Modified: 9:26 AM 23/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT'])); 
	require_once ROOT.'/misc/init.php';
	
	/**
	 * Calls the Weather API for weather data
	 * 
	 * <code>
	 * $weather = new Weather();
	 * 
	 * echo $weather->getCity();
	 * echo $weather->getCurrentIcon();
	 * echo $weather->getCurrentF();
	 * echo $weather->getCurrentC();
	 * echo $weather->getCurrentCondition();
	 * echo $weather->getCurrentHumidity();
	 * echo $weather->getCurrentWindCondition();
	 * for ($i=1; $i<5; $i++) {
	 *     echo $weather->getForecastDay();
	 *     echo $weather->getForecastCondition();
	 *     echo $weather->getForecastHigh();
	 *     echo $weather->getForecastLow();
	 *     echo $weather->getForecastIcon();
	 * }
	 * </code>
	 * 
	 * @author Ian Mckay <im607@uowmail.edu.au>
	 */
	class Weather {
	    	/**
		 * The JSON output of the request to the Weather API
		 * @var string
		 */
		private $json;
		
	    	/**
		 * The 'forecast_information' section of the XML
		 */
		private $information = array();

		/**
		 * Initializes Weather class, loads Weather API data
		 * @param string $location location of the weather forecast
		 */
		public function __construct($location) {
		    $this->json = json_decode(file_get_contents('http://free.worldweatheronline.com/feed/weather.ashx?q='.$location.'&format=json&num_of_days=2&key=af1018d06c143508121008'));
		    //die(var_dump($this->json));
		    $this->information['search'] = $location;
		    $this->information['city'] = $this->json->data->request[0]->query;
		    $this->information['c'] = $this->json->data->current_condition[0]->temp_C;
		    $this->information['icon'] = str_replace("http:","http:",$this->json->data->current_condition[0]->weatherIconUrl[0]->value);
		}

		/**
		 * Get the city
		 * @return string returns the city 
		 */
		public function getSearchterm() {
		    return $this->information['search'];
		}
		
		/**
		 * Get the city
		 * @return string returns the city 
		 */
		public function getCity() {
		    return $this->information['city'];
		}

		/**
		 * Get the current weather's icon
		 * @return string returns URL to current weather's icon
		 */
		public function getCurrentIcon() {
		    return 'http://www.google.com'.$this->current[0]->icon['data'];
		}

		/**
		 * Get the current weather's farenheight temperature
		 * @return string returns the current weathers farenheight temperature
		 */
		public function getCurrentF() {
		    return '71'.'&deg; F';
		}

		/**
		 * Get the current weather's celcius temperature
		 * @return string returns the current weathers cencius temperature
		 */
		public function getCurrentC() {
		    return $this->information['c'].'&deg; C';
		}

		/**
		 * Get the current weather's condition
		 * @return string returns the current weathers condition
		 */
		public function getCurrentCondition() {
		    return $this->current[0]->condition['data'];
		}

		/**
		 * Get the current weather's humidity
		 * @return string returns the current weathers humidity
		 */
		public function getCurrentHumidity() {
		    return $this->current[0]->humidity['data'];
		}
		
		/**
		 * Get the current weather's wind condition
		 * @return string returns the current weathers wind condition
		 */
		public function getCurrentWindCondition() {
		    return $this->current[0]->wind_condition['data'];
		}

		/**
		 * Get the name of a day
		 * @param int $daysahead amount of days ahead to look (1-4)
		 * @return string returns a forecasted day
		 */
		public function getForecastDay($daysahead) {
		    return $this->forecast_list[$daysahead+1]->day_of_week['data'];
		}
		
		/**
		 * Get the forecasted condition
		 * @param int $daysahead amount of days ahead to look (1-4)
		 * @return string returns a forecasted condition
		 */
		public function getForecastCondition($daysahead) {
		    return $this->forecast_list[$daysahead+1]->condition['data'];
		}

		/**
		 * Get the forecasted highest temperature
		 * @param int $daysahead amount of days ahead to look (1-4)
		 * @return string returns a forecasted highest temperature
		 */
		public function getForecastHigh($daysahead) {
		    return $this->forecast_list[$daysahead+1]->high['data'];
		}

		/**
		 * Get the forecasted lowest temperature
		 * @param int $daysahead amount of days ahead to look (1-4)
		 * @return string returns a forecasted lowest temperature
		 */
		public function getForecastLow($daysahead) {
		    return $this->forecast_list[$daysahead+1]->low['data'];
		}

		/**
		 * Get the forecasted icon
		 * @return string returns a forecasted icon URL
		 */
		public function getForecastIcon() {
		    return $this->information['icon'];
		}
	}
?>
