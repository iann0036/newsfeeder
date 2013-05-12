<?php
	/*
	File name: /classes/FeedCollection.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Provides a storage class for Feeds in a particular sheet
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DatabaseConnection.php';
	require_once ROOT.'/classes/DataCollection.php';
	
	/**
	 * Provides a storage class for Feeds in a particular sheet
	 * 
	 * <code>
	 * $feeds = new FeedCollection(1);
	 * 
	 * $feeds->removeFeed(2);
	 * 
	 * foreach ($feeds as $feed) {
	 *     echo $feed['id'];
	 *     echo $feed['name'];
	 *     echo $feed['url'];
	 *     echo $feed['category'];
	 *     echo $feed['enabled'];
	 * }
	 * </code>
	 * 
	 * @author Ian Mckay <im607@uowmail.edu.au>
	 */
	class FeedCollection extends DataCollection {
		/**
		 * The sheetid for this collection of feeds
		 * @var int 
		 */
		private $sheetid;
		
		/**
		 * Initializes FeedCollection class
		 * @param int $sheetid the id of the sheet this collection of feeds belong to
		 */
		public function __construct($sheetid) {
			parent::__construct();
		
			$this->sheetid = $sheetid;
			$this->load();
		}
		
		/**
		 * Imports feeds for a particular sheet from the database 
		 */
		private function load() {
			$feed = array();
			$rows = array();
			
			$this->db->orderBy('category','ASC');
			$catrows = $this->db->get('feeds',NULL,$fields);
			for ($i=0; $i<count($catrows); $i++) {
			    if ($catrows[$i]['category']!=NULL)
				$rows[] = $catrows[$i];
			}
			
			$this->db->where('userfeeds`.`username',$_SESSION['nf_user']);
			$this->db->join('userfeeds','feeds`.`id','userfeeds`.`feedid');
			$fields = array('feeds`.`id','feeds`.`name','feeds`.`url','feeds`.`category');
			$rows = array_merge($rows,$this->db->get('feeds',NULL,$fields,true));
				
			foreach($rows as $row) {
				$feed['id'] = $row['id'];
				$feed['name'] = $row['name'];
				$feed['url'] = $row['url'];
				$feed['category'] = $row['category'];
				$feed['enabled'] = false;
				$this->data[] = $feed;
			}
		}
		
		/**
		 * Removes a feed from the database
		 * @param int $feedid the id of the feed to remove
		 */
		public function removeFeed($feedid) {
			$this->db->where('sheetid', $this->sheetid);
			$this->db->where('feedid', $feedid);
			$this->db->delete('sheetfeeds');
		}
	}
?>