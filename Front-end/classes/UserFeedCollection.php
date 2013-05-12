<?php
	/*
	File name: /classes/UserFeedCollection.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Provides a storage class for Feeds that a user has added
	Last Modified: 10:40 PM 16/09/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DatabaseConnection.php';
	require_once ROOT.'/classes/DataCollection.php';
	require_once ROOT.'/classes/User.php';
	
	/**
	 * Provides a storage class for Feeds that a user has added
	 * 
	 * <code>
	 * $feeds = new UserFeedCollection();
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
	class UserFeedCollection extends DataCollection {
		
		/**
		 * Initializes UserFeedCollection class
		 */
		public function __construct() {
			parent::__construct();
			
			$this->load();
		}
		
		/**
		 * Imports feeds for a particular user from the database 
		 */
		private function load() {
			$feed = array();
			$rows = array();
			
			$this->db->where('userfeeds`.`username',$_SESSION['nf_user']);
			$this->db->join('userfeeds','feeds`.`id','userfeeds`.`feedid');
			$fields = array('feeds`.`id','feeds`.`name','feeds`.`url','feeds`.`category');
			$rows = $this->db->get('feeds',NULL,$fields,true);
				
			foreach($rows as $row) {
				$feed['id'] = $row['id'];
				$feed['name'] = $row['name'];
				$feed['url'] = $row['url'];
				$feed['category'] = $row['category'];
				$this->data[] = $feed;
			}
		}
		
		/**
		 * Removes a userfeed from the database
		 * @param int $feedid the id of the feed to remove
		 */
		public function removeFeed($feedid) {
			$this->db->where('username',$_SESSION['nf_user']);
			$this->db->where('feedid', $feedid);
			$this->db->delete('userfeeds');
		}
	}
?>