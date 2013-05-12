<?php
	/*
	File name: /classes/User.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Identifies a particular user of the service
	Last Modified: 10:44 PM 12/01/2012
	*/

   	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DatabaseConnection.php';
	
	if (!isset($_SESSION)) // start session only if not already started
		session_start();

	/**
	 * Identifies a particular user of the service
	 * 
	 * <code>
	 * $user = new User();
	 * $otheruser = new User('jbloggs','Joe Bloggs',1,0,'joe@example.com');
	 * 
	 * if ($user->validUser()) {
	 *     echo $user->getUsername();
	 *     echo $user->getName();
	 *     echo $user->getEmail();
	 *     if ($user->isAdmin())
	 *         echo 'User is an Administrator';
	 *     if ($user->isAltDesign())
	 *         echo $user->isAltDesign();
	 * }
	 * 
	 * $user->logout();
	 * </code>
	 * 
	 * @author Ian Mckay <im607@uowmail.edu.au>
	 */
	class User {
		/**
		 * The user's username
		 * @var string
		 */
		private $username = null;
		/**
		 * The user's actual name
		 * @var string
		 */
		private $name = null;
		/**
		 * The user's default layout
		 * @var int
		 */
		private $layout = null;
		/**
		 * Flag for whether the user is an admin
		 * @var boolean
		 */
		private $admin = null;
		/**
		 * The user's email address
		 * @var string
		 */
		private $email = null;
		/**
		 * The user's chosen protocol
		 * @var string
		 */
		private $protocol = null;
		/**
		 * The user's notifications
		 * @var mixed
		 */
		private $notifications = array();

		/**
		 * Initializes User class, creates new database connection, sets user data
		 * @param null|string $username the users username, if set
		 * @param null|string $name the users name, if set
		 * @param null|int $layout the users layout, if set
		 * @param null|boolean $admin whether the user is an admin, if set
		 * @param null|string $email the users email address, if set
		 */
		public function __construct($username = null, $name = null, $layout = null, $admin = null, $email = null) { // Sorry for the mess, PHP can't have multiple constructors :(
			if ($username==null&&$name==null&&$layout==null&&$admin==null) {
				if (isset($_SESSION['nf_user']))
					$this->username = $_SESSION['nf_user'];
				$db = new DatabaseConnection();
				$db->where('username',$this->username);
				$rows = $db->get('users');
				$this->name = $rows[0]['realname'];
				$this->email = $rows[0]['email'];
				$this->layout = $rows[0]['layout'];
				$this->admin = $rows[0]['admin'];
				if ($rows[0]['https'])
				    $this->protocol = 'https://';
				else
				    $this->protocol = 'http://';
				$db->where('notification`.`username',$this->username);
				$db->join('sheets','notification`.`sheetid','sheets`.`id');
				$fields = array('sheets`.`id','sheets`.`name');
				$rows = $db->get('notification',NULL,$fields);
				foreach($rows as $row) {
				    $this->notifications[] = array(
					'sheetid' => $row['id'],
					'name' => $row['name']
				    );
				}
			} else {
				$this->username = $username;
				$this->name = $name;
				$this->layout = $layout;
				$this->admin = $admin;
				$this->email = $email;
			}
		}
		
		/**
		 * Returns whether the user is valid
		 * @return boolean returns true if valid user, else false
		 */
		public static function validUser() {
			return isset($_SESSION['nf_user']);
		}
		
		/**
		 * Returns the users notifications
		 * @return mixed returns an array of associative arrays for notifications
		 */
		public function getNotifications() {
			return $this->notifications;
		}
		
		/**
		 * Returns the users username
		 * @return string returns the username
		 */
		public function getUsername() {
			return $this->username;
		}
		
		/**
		 * Returns the users name
		 * @return string returns the name
		 */
		public function getName() {
			return $this->name;
		}
		
		/**
		 * Returns the users email
		 * @return string returns the email
		 */
		public function getEmail() {
			return $this->email;
		}
		
		/**
		 * Returns whether the user is an administrator
		 * @return boolean returns true if is administrator, else false
		 */
		public function isAdmin() {
			return $this->admin;
		}
		
		/**
		 * Returns the protocol to use (http or https)
		 * @return string returns the protocol
		 */
		public function getProtocol() {
			return $this->protocol;
		}
		
		/**
		 * Returns what design the user uses
		 * @return boolean|int returns the type of alternative design as an integer, otherwise false
		 */
		public function isAltDesign() {
			if ($this->validUser())
				return $this->layout;
			else
				return false;
		}
		
		/**
		 * Removes all session data
		 */
		public static function logout() {
			if (!isset($_SESSION))
				session_start();
			session_unset();
			session_destroy();
			setcookie("nf_user","",time()-3600,"/",".".HOST);
		}
	}
?>