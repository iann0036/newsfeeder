<?php
	/*
	File name: /classes/CPHCollection.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Provides a storage class for all cphs of the sheet
	Last Modified: 2:26 PM 10/08/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DataCollection.php';
	require_once ROOT.'/classes/ArticleCollection.php';
	require_once ROOT.'/classes/Weather.php';
	
	/**
	 * Provides a storage class for all cphs of the sheet
	 * 
	 * <code>
	 * $cphs = new CPHCollection();
	 * 
	 * foreach ($cphs as $cph)
	 *     echo $cph['wid'];
	 *     echo $cph['column'];
	 *     echo $cph['order'];
	 * </code>
	 * 
	 * @author Ian Mckay <im607@uowmail.edu.au>
	 */
	class CPHCollection extends DataCollection {
	    
		/**
		 * Initializes CPHCollection class
		 */
		public function __construct($sheetid) {
			parent::__construct();
			
			$this->load($sheetid);
		}
		
		/**
		 * Imports all cphs and cph_feeds from the database 
		 */
		private function load($sheetid) {
			$this->db->where('sheetid',$sheetid);
			$rows = $this->db->get('cph');
			foreach ($rows as $row) {
			    $this->db->where('cphid',$row['id']);
			    $rowfeeds = $this->db->get('cph_feeds');
			    if (count($rowfeeds)>0) {
				$feeds = array();
				foreach ($rowfeeds as $rowfeed)
				    $feeds[] = $rowfeed['feedid'];
				$this->data[] = array(
				    'wid' => $row['wid'],
				    'column' => $row['column'],
				    'order' => $row['order'],
				    'feeds' => $this->getFeeds($feeds),
				    'feedids' => $feeds
				);
			    } else {
				$this->db->where('cphid',$row['id']);
				$weather = $this->db->get('cph_weather');
				$this->data[] = array(
				    'wid' => $row['wid'],
				    'column' => $row['column'],
				    'order' => $row['order'],
				    'weather' => $this->getWeather($weather[0]['location'])
				);
			    }
			}
		}
		
		private function getWeather($location) {
		    $weather = new Weather($location);
		    
		    return array(
			"c" => $weather->getCurrentC(),
			"icon" => $weather->getForecastIcon(),
			"search" => $weather->getSearchterm(),
			"location" => $weather->getCity()
		    );
		}
		
		private function getFeeds($feeds) {
		    $articles = array();
		    $articlecollection = new ArticleCollection($feeds);
		    
		    while ($articlecollection->more()) {
			$articles[] = $articlecollection->next();
		    }
		    
		    return $articles;
		}
	}
?>