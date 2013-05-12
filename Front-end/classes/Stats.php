<?php
	/*
	File name: /classes/Stats.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Generates front page statistics
	Last Modified: 3:30 PM 29/03/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DatabaseConnection.php';
	require_once ROOT.'/classes/User.php';

	/**
	 * Generates front page statistics
	 * 
	 * <code>
	 * $stats = new Stats();
	 * 
	 * echo $stats->getCommentCount();
	 * echo $stats->getUserCount();
	 * echo $stats->getSheetCount();
	 * echo $stats->getFeedCount();
	 * echo $stats->getItemCount();
	 * echo $stats->getPrevCommentCount();
	 * echo $stats->getPrevUserCount();
	 * echo $stats->getPrevSheetCount();
	 * echo $stats->getPrevFeedCount();
	 * echo $stats->getPrevItemCount();
	 * </code>
	 * 
	 * @author Ian Mckay <im607@uowmail.edu.au>
	 */
	class Stats {
		/**
		 * An instance of a database connection
		 * @var DatabaseConnection 
		 */
		private $db;
		/**
		 * The amount of comments in the system
		 * @var int
		 */
		private $comments;
		/**
		 * The amount of users in the system
		 * @var int
		 */
		private $users;
		/**
		 * The amount of sheets in the system
		 * @var int
		 */
		private $sheets;
		/**
		 * The amount of feeds in the system
		 * @var int
		 */
		private $feeds;
		/**
		 * The amount of items in the system
		 * @var int
		 */
		private $items;
		/**
		 * The previous amount of comments in the system
		 * @var int
		 */
		private $prev_comments;
		/**
		 * The previous amount of users in the system
		 * @var int
		 */
		private $prev_users;
		/**
		 * The previous amount of sheets in the system
		 * @var int
		 */
		private $prev_sheets;
		/**
		 * The previous amount of feeds in the system
		 * @var int
		 */
		private $prev_feeds;
		/**
		 * The previous amount of items in the system
		 * @var int
		 */
		private $prev_items;
		
		/**
		 * Initializes Stats class, creates new database connection 
		 */
		public function __construct() {
			$this->db = new DatabaseConnection();
			
			$this->load();
		}
		
		/**
		 * Imports statistics from the database 
		 */
		private function load() {
			$this->db->orderBy('id',true);
			$stats = $this->db->get('stats',2);
			$this->users = $stats[0]['users'];
			$this->sheets = $stats[0]['sheets'];
			$this->feeds = $stats[0]['feeds'];
			$this->items = $stats[0]['items'];
			$this->comments = $stats[0]['comments'];
			$this->prev_users = $stats[1]['users'];
			$this->prev_sheets = $stats[1]['sheets'];
			$this->prev_feeds = $stats[1]['feeds'];
			$this->prev_items = $stats[1]['items'];
			$this->prev_comments = $stats[1]['comments'];
		}
		
		/**
		 * Returns the amount of comments in the system
		 * @return int returns the amount of comments
		 */
		public function getCommentCount() {
			return $this->comments;
		}

		/**
		 * Returns the amount of users in the system
		 * @return int returns the amount of users
		 */
		public function getUserCount() {
			return $this->users;
		}
		
		/**
		 * Returns the amount of sheets in the system
		 * @return int returns the amount of sheets
		 */
		public function getSheetCount() {
			return $this->sheets;
		}
		
		/**
		 * Returns the amount of feeds in the system
		 * @return int returns the amount of feeds
		 */
		public function getFeedCount() {
			return $this->feeds;
		}
		
		/**
		 * Returns the amount of items in the system
		 * @return int returns the amount of items
		 */
		public function getItemCount() {
			return $this->items;
		}	
		
		/**
		 * Returns the previous amount of comments in the system
		 * @return int returns the previous amount of comments
		 */
		public function getPrevCommentCount() {
			return $this->prev_comments;
		}

		/**
		 * Returns the previous amount of users in the system
		 * @return int returns the previous amount of users
		 */
		public function getPrevUserCount() {
			return $this->prev_users;
		}
		
		/**
		 * Returns the previous amount of sheets in the system
		 * @return int returns the previous amount of sheets
		 */
		public function getPrevSheetCount() {
			return $this->prev_sheets;
		}
		
		/**
		 * Returns the previous amount of feeds in the system
		 * @return int returns the previous amount of feeds
		 */
		public function getPrevFeedCount() {
			return $this->prev_feeds;
		}
		
		/**
		 * Returns the previous amount of items in the system
		 * @return int returns the previous amount of items
		 */
		public function getPrevItemCount() {
			return $this->prev_items;
		}	

	}
?>
