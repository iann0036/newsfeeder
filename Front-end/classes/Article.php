<?php
	/*
	File name: /classes/Article.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Provides storage class with getters for a single article
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DatabaseConnection.php';
	require_once ROOT.'/misc/misc.php';
	require_once ROOT.'/misc/censor.php';

	/**
	 * Provides storage class with getters for a single article
	 * 
	 * <code>
	 * $article = new Article(1,2);
	 * 
	 * echo $article->getTitle();
	 * echo $article->getAuthor();
	 * echo $article->getGeo();
	 * echo $article->getTime();
	 * echo $article->getURL();
	 * echo $article->getContent();
	 * echo $article->getFeedName();
	 * </code>
	 * 
	 * @author Ian Mckay <im607@uowmail.edu.au>
	 */
	class Article {
		/**
		 * An instance of a database connection
		 * @var DatabaseConnection 
		 */
		private $db;
		/**
		 * An array of data items relating to the article
		 */
		private $data = array();

		/**
		 * Initializes Article class, creates new database connection 
		 * @param int $id the items id
		 * @param int $sheetid the sheets id where the item resides in
		 */
		public function __construct($id, $sheetid) {
			$this->db = new DatabaseConnection();
			$this->load($id, $sheetid);
		}
		
		/**
		 * Imports an article from the database
		 * @param int $id the items id
		 * @param int $sheetid the sheets id where the item resides in
		 */
		private function load($id, $sheetid) {
			$this->db->join('feeds','feeds`.`id','items`.`feedid');
			$this->db->where('items`.`id',$id);
			$fields = array('items`.`id', 'items`.`title', 'items`.`url', 'items`.`author', 'items`.`content', 'items`.`postdate', 'items`.`geolocation', 'feeds`.`name');
			$rows = $this->db->get('items',NULL,$fields);
			if (isset($rows[0])) {
				$this->data['id'] = $rows[0]['id'];
				$this->data['title'] = $rows[0]['title'];
				$this->data['url'] = $rows[0]['url'];
				$this->data['content'] = trim($rows[0]['content']);
				$this->data['author'] = $rows[0]['author'];
				if ($rows[0]['postdate']!=NULL && $rows[0]['postdate']>1)
					$this->data['time'] = convert_datetime($rows[0]['postdate']);
				else
					$this->data['time'] = "Unknown";
				$this->data['geo'] = $rows[0]['geolocation'];
				$this->data['feedname'] = $rows[0]['name'];
				/*if ($row['filter']) {
					$this->data['title'] = censor($this->data['title']);
					$this->data['content'] = censor($this->data['content']);
				}*/
			}
		}
		
		/**
		 * Returns the title of the article
		 * @return string returns the title
		 */
		public function getTitle() {
			return $this->data['title'];
		}
		
		/**
		 * Returns the author of the article
		 * @return string returns the author
		 */
		public function getAuthor() {
			return $this->data['author'];
		}
		
		/**
		 * Returns the geolocation of the article
		 * @return string returns the geolocation in the form -112.45225,35.24551
		 */
		public function getGeo() {
			return $this->data['geo'];
		}
		
		/**
		 * Returns the post date of the article
		 * @return string returns the articles posting date in string format
		 */
		public function getTime() {
			return $this->data['time'];
		}
		
		/**
		 * Returns the URL of the article
		 * @return string returns the articles original url
		 */
		public function getURL() {
			return $this->data['url'];
		}
		
		/**
		 * Returns the article content
		 * @return string returns the article content
		 */
		public function getContent() {
			return $this->data['content'];
		}
		
		/**
		 * Returns the feedname of the article
		 * @return string returns the name of the feed in which the article belongs to
		 */
		public function getFeedName() {
			return $this->data['feedname'];
		}
	}
?>
