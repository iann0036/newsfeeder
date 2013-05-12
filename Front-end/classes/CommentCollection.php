<?php
	/*
	File name: /classes/CommentCollection.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Provides a storage class for Comments on a particluar item
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DatabaseConnection.php';
	require_once ROOT.'/classes/DataCollection.php';
	
	/**
	 * Provides a storage class for Comments on a particluar item
	 * 
	 * <code>
	 * $comments = new CommentCollection(1);
	 * 
	 * foreach($comments as $comment) {
	 *     echo $comment['author'];
	 *     echo $comment['via'];
	 *     echo $comment['date'];
	 *     echo $comment['comment'];
	 *     echo '<img src="'.$comment['author'].'" />';
	 * }
	 * </code>
	 * 
	 * @author Ian Mckay <im607@uowmail.edu.au>
	 */
	class CommentCollection extends DataCollection {
		/**
		 * The item which the comments are in
		 * @var int 
		 */
		private $itemid;

		/**
		 * Initializes CommentCollection class
		 * @param int $itemid the id of the item the comments reside in
		 */
		public function __construct($itemid) {
			parent::__construct();
		
			$this->itemid = $itemid;
			$this->load();
		}
		
		/**
		 * Imports comments for a particular item from the database 
		 */
		private function load() {
			$comments = array();
			
			$this->db->where('itemid', $this->itemid);
			$rows = $this->db->get('comments');
			
			foreach($rows as $row) {
				$comments['author'] = $row['author'];
				$comments['via'] = $row['via'];
				$comments['date'] = $row['date'];
				$comments['comment'] = $row['comment'];
				$comments['avatar'] = $row['avatar'];
				$this->data[] = $comments;
			}
		}
	}
?>