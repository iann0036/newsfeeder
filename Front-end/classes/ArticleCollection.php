<?php
	/*
	File name: /classes/ArticleCollection.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Provides a storage class for Articles in a particular sheet
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DatabaseConnection.php';
	require_once ROOT.'/classes/DataCollection.php';
	require_once ROOT.'/classes/User.php';
	require_once ROOT.'/misc/censor.php';
	require_once ROOT.'/misc/misc.php';
	
	/**
	 * Provides a storage class for Articles in a particular sheet
	 * 
	 * <code>
	 * $articles = new ArticleCollection(1);
	 * 
	 * $articles->removeArticle(2);
	 * 
	 * foreach ($articles as $article) {
	 *     echo $article['id'];
	 *     echo $article['title'];
	 *     echo $article['url'];
	 *     echo $article['content'];
	 *     echo $article['time'];
	 *     echo $article['feedname'];
	 *     if ($article['filter'])
	 *         echo 'Filter set';
	 *     else
	 *         echo 'Filter not set';
	 *     echo $article['column'];
	 * }
	 * </code>
	 * 
	 * @author Ian Mckay <im607@uowmail.edu.au>
	 */
	class ArticleCollection extends DataCollection {
		/**
		 * An instance of a user
		 * @var User
		 */
		private $user;
		/**
		 * The sheetid for this collection of articles
		 * @var int 
		 */
		private $sheetid;
		/**
		 * An approximation of the height of column one
		 * @var int 
		 */
		private $columnone = 0;
		/**
		 * An approximation of the height of column two
		 * @var int 
		 */
		private $columntwo = 0;
		
		/**
		 * Initializes ArticleCollection class, determines user
		 * @param int $sheetid the sheetid of the collection of articles
		 */
		public function __construct() {
			parent::__construct();
		
			$this->user = new User();
			$this->sheetid = $sheetid;
			$this->load(func_get_args());
		}
		
		/**
		 * Imports a collection of articles from the database 
		 */
		private function load($feedlist) {
			$rows = array();
			foreach ($feedlist[0] as $feedid) {
			    $this->db->where('feedid',$feedid);
			    $this->db->join('feeds','feeds`.`id','items`.`feedid');
			    $fields = array('items`.`id', 'items`.`title', 'items`.`url', 'items`.`author', 'items`.`content', 'items`.`postdate', 'feeds`.`name','feeds`.`favicon');
			    $temprows = $this->db->get('items',10,$fields,true);
			    $rows = array_merge($rows,$temprows);
			}
			foreach ($rows as $row) {
				$article = array();
				$article['id'] = $row['id'];
				$article['title'] = $row['title'];
				$article['url'] = $row['url'];
				$article['content'] = trim(strip_tags($row['content']));
				$article['author'] = $row['author'];
				if (strlen($article['content']) > 600)
				    $article['content'] = substr($article['content'],0,600)."...";
				if ($row['postdate']!=NULL && $row['postdate']>1)
					$article['time'] = convert_datetime($row['postdate']);
				else
					$article['time'] = "Unknown";
				$article['feedname'] = $row['name'];
				if ($row['favicon'])
				    $article['favicon'] = 'data:image/jpg;base64,'.base64_encode($row['favicon']);
				if ($row['filter']) {
					$article['title'] = censor($article['title']);
					$article['content'] = censor($article['content']);
				}
				$article['column'] = $this->assignColumn($row['content']);
				$this->data[] = $article;
			}
		}
		
		/**
		 * Removes an article from the database
		 * @param int $id the articles id
		 */
		public function removeArticle($id) {
			$this->db->where('id',$id);
			$this->db->where('username',$this->user->getUsername());
			$this->db->delete('items');
			
			removeElementById($id);
		}
		
		/**
		 * Assigns either the left or right column for the article
		 * @param string $content the content of the article
		 * @return int returns 1 for left or 2 for right
		 */
		private function assignColumn($content) { // this method is a work in progress
			$height = 3 + floor(strlen($content)/100); // get's an approximate article height
			if ($this->columnone < $this->columntwo) {
			    $this->columnone+=$height;
			    return 1;
			} else {
			    $this->columntwo+=$height;
			    return 2;
			}
		}
	}
?>
