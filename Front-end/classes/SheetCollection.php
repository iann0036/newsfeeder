<?php
	/*
	File name: /classes/SheetCollection.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Provides a storage class for Sheets that belong to a user
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DatabaseConnection.php';
	require_once ROOT.'/classes/DataCollection.php';
	require_once ROOT.'/classes/User.php';
	
	/**
	 * Provides a storage class for Sheets that belong to a user
	 * 
	 * <code>
	 * $sheets = new SheetCollection();
	 * 
	 * $sheets->add('New Sheet');
	 * 
	 * $sheets->remove(2);
	 * 
	 * foreach ($sheets as $sheet) {
	 *     echo $sheet['id'];
	 *     echo $sheet['name'];
	 *     echo $sheet['updated'];
	 * }
	 * </code>
	 * 
	 * @author Ian Mckay <im607@uowmail.edu.au>
	 */
	class SheetCollection extends DataCollection {
		/**
		 * An instance of a user
		 * @var User
		 */
		private $user;
		
		/**
		 * Initializes SheetCollection class, determines user
		 */
		public function __construct() {
			parent::__construct();
		
			$this->user = new User();
			$this->load();
		}
		
		/**
		 * Imports sheets for a particular user from the database 
		 */
		private function load() {
			$sheet = array();
			
			$this->db->where('username',$this->user->getUsername());
			$rows = $this->db->get('sheets');
			foreach($rows as $row) {
				$sheet['id'] = $row['id'];
				$sheet['name'] = $row['name'];
				$sheet['updated'] = $row['updated'];
				$this->data[] = $sheet;
			}
		}
		
		/**
		 * Adds a sheet to the datbase
		 * @param string $name the name of the new sheet
		 */
		public function add($name) {
			$data = array(
			    'name' => $name,
			    'username' => $this->user->getUsername()
			);
			$this->db->insert('sheets', $data);
		}
		
		/**
		 * Removes a sheet from the database
		 * @param int $id the id of the sheet to be removed
		 */
		public function remove($id) {
			$this->db->where('id', $id);
			$this->db->where('username',$this->user->getUsername());
			$this->db->delete('sheets');
		}
		
		/**
		 * Removes a notification, if it exists
		 * @params int the sheetid that is to be removed
		 */
		public function removeNotification($username,$sheetid) {
			$this->db->where('username',$username);
			$this->db->where('sheetid',$sheetid);
			$rows = $this->db->get('notification');
			if (count($rows!=0)) {
			    $this->db->where('username',$username);
			    $this->db->where('sheetid',$sheetid);
			    $this->db->delete('notification');
			}
		}
	}
?>