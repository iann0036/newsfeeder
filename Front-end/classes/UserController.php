<?php
	/*
	File name: /classes/UserController.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Provides methods for the creation and authentication of user accounts
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DatabaseConnection.php';
	require_once ROOT.'/classes/UserController.php';
	
	if (!isset($_SESSION)) // start session only if not already started
		session_start();

	/**
	 * Provides methods for the creation and authentication of user accounts
	 * 
	 * <code>
	 * require_once 'UserController.php';
	 * 
	 * $accounts = new UserController();
	 * 
	 * $accounts->register('Joe Bloggs','jbloggs','mypa$$w0rd','joe@example.com','http://example.com/image.jpg');
	 * $result = $accounts->login('jbloggs','mypa$$w0rd',true);
	 * </code>
	 * 
	 * @author Ian Mckay <im607@uowmail.edu.au>
	 */
	class UserController {
		/**
		 * An instance of a database connection
		 * @var DatabaseConnection 
		 */
		private $db = null;
		
		/**
		 * Initializes AccountsManager class, creates new database connection 
		 */
		public function __construct() {
			$this->db = new DatabaseConnection();
		}
		
		/**
		 * Logs a user into the service
		 * @param string $username username of the user
		 * @param string $password password of the user
		 * @param boolean $remember if true, sets cookies for the user
		 * @param boolean $ignorepass if true, password is not needed to authenticate
		 * @return boolean returns 0 if successful, else 1 if unsuccessful
		 */
		public function login($username, $password, $remember, $ignorepass = false) {
			$this->db->where('username',$username);
			if (!$ignorepass)
			    $this->db->where('password',md5($password)); // passwords are stored as MD5 in the database
			$rows = $this->db->get('users');
			
			if (count($rows)==0)
			    return 1;
			
			$_SESSION['nf_user'] = $username;
			$_SESSION['nf_name'] = $rows[0]['realname'];
			$_SESSION['nf_layout'] = $rows[0]['layout'];
			$_SESSION['nf_admin'] = $rows[0]['admin'];
			if ($remember) {
			    	$key = 'nf_'.uniqid();
				$data = array(
				    'username' => $username,
				    'key' => $key
				);
				$this->db->insert('session',$data);
				setcookie("nf_user",$key,time()+DEFAULT_COOKIE_LENGTH,"/",".".HOST);
			}
			
			checkSSLStatus(); // ensure SSL is enabled
			
			return 0; // should return 1 on error
		}
		
		/**
		 * Registers a user with the service
		 * @param string $fname the users actual name
		 * @param string $username the users username
		 * @param string $password the users password
		 * @param string $email the users email address
		 * @param string $photo the location of the image file of the users requested avatar
		 */
		public function register($name,$username,$password,$email,$photo) {
			if (count($photo['tmp_name'])<2) {
			    $data = array(
				'realname' => $name,
				'username' => $username,
				'password' => md5($password),
				'email' => $email
			    );
			} else {
			    $this->process_avatar($photo['tmp_name']);
			    $data = array(
				'realname' => $name,
				'username' => $username,
				'password' => md5($password),
				'email' => $email,
				'picture' => file_get_contents($photo['tmp_name'])
			    );
			}
			$this->db->insert('users', $data);
				
			if (!mail($email,'News Feeder Registration Confirmation','Hi '.$name.',

Welcome to News Feeder! News Feeder is a service which gives you the news all in one place for your convenience.

This e-mail is to confirm with you that your account has been successfully registered. No further action is needed.

If you didn'.chr(39).'t register for this service please contact us.

Regards,
News Feeder
','From: News Feeder <support@'.HOST.'>'))
				trigger_error('Mail Error');
			
			$accounts = new UserController();
			$accounts->login($username,$password,false);
		}
		
		public function checkCookie() {
		    if (isset($_COOKIE['nf_user'])) {
			$this->db->where('key',$_COOKIE['nf_user']);
			$result = $this->db->get('session');
			if (count($result)!=0) {
			    if ($result[0]['time']+DEFAULT_COOKIE_LENGTH < $_SERVER['REQUEST_TIME']) {
				$this->login($result[0]['username'],null,null,true);
			    }
			}
		    }
		}
		
		/**
		 * Shrinks the users avatar to required scale
		 * @param string $location location of the unprocessed image
		 */
		private function process_avatar($location) {
			// Avatars are to be 22 x 22
			$src = imagecreatefromjpeg($location);
			list($width, $height) = getimagesize($location);
			$newWidth = 22; // initial settings
			$newHeight = 22; // initial settings
			if ($height<$width)
				$newHeight = ($height / $width) * 22;
			else {
				$newWidth = ($width / $height) * 22; var_dump($newWidth);var_dump($newHeight);}
			$tmp = imagecreatetruecolor($newWidth, $newHeight);
			imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
			imagejpeg($tmp, $location, 85); // (image, location to store, quality)
		}
	}
?>