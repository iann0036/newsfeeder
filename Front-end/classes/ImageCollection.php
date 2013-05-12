<?php
	/*
	File name: /classes/ImageCollection.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Provides a storage class for Images in a particular article
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DataCollection.php';
	
	/**
	 * Provides a storage class for Images in a particular article
	 * 
	 * <code>
	 * $images = new ImageCollection(1);
	 * 
	 * foreach($images as $image)
	 *     echo '<img src="'.$image['image'].'" />';
	 * </code>
	 * 
	 * @author Ian Mckay <im607@uowmail.edu.au>
	 */
	class ImageCollection extends DataCollection {
		/**
		 * The item which the images are in
		 * @var int 
		 */
		private $itemid;
		
		/**
		 * Initializes ImageCollection class
		 * @param int $itemid the id of the item the images belong to
		 */
		public function __construct($itemid) {
			parent::__construct();
		
			$this->itemid = $itemid;
			$this->load();
		}
		
		/**
		 * Imports images for a particular item from the database 
		 */
		private function load() {
			$this->db->where('itemid',$this->itemid);
			$rows = $this->db->get('images',3);
			foreach($rows as $row)
				$this->data[] = array(
				    'url' => $row['url'],
				    'data' => $row['image']
				);
		}
	}
?>