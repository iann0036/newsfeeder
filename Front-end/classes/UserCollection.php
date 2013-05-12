<?php
	/*
	File name: /classes/UserCollection.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Provides a storage class for all users of the system for administration purposes
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DataCollection.php';
	require_once ROOT.'/classes/User.php';

	/**
	 * Provides a storage class for all users of the system for administration purposes
	 * 
	 * <code>
	 * $users = new UserCollection();
	 * 
	 * foreach ($users as $user)
	 *     echo $user->getUsername();
	 * </code>
	 * 
	 * @author Ian Mckay <im607@uowmail.edu.au>
	 */
	class UserCollection extends DataCollection {
	    
		/**
		 * Initializes UserCollection class
		 */
		public function __construct() {
			parent::__construct();
			
			$this->load();
		}
		
		/**
		 * Imports all users from the database 
		 */
		private function load() {
			$rows = $this->db->get('users');
			
			foreach($rows as $row)
				$this->data[] = new User($row['username'],$row['realname'],$row['layout'],$row['admin'],$row['email']);
		}
	}
?>