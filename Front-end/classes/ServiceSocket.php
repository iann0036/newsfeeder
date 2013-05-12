<?php
	/*
	File name: /classes/ServiceSocket.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Connects to the backend controlling service
	Last Modified: 10:44 PM 12/01/2012
	*/

	// This script is not yet implemented

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	
	/**
	 * Connects to the backend controlling service
	 * 
	 * @author Ian Mckay <im607@uowmail.edu.au>
	 */
	class ServiceSocket {
		/**
		 * The socket connecting to the external server
		 */
		private $socket;
		/**
		 * The port the service controller is on
		 * @var int
		 */
		private $serviceport;
		/**
		 * The address the service controller is on
		 * @var string
		 */
		private $serviceaddress;
		/**
		 * The current response from the service controller
		 * @var string
		 */
		private $response = '';
		
		/**
		 * Initializes the socket, connecting to the external server
		 */
		public function __construct($address,$port) {
		    $this->serviceaddress = $address;
		    $this->serviceport = $port;
		    $this->socket = stream_socket_client("tcp://$address:$port", $errno, $errstr, 10);
		    if (!$this->socket)
			die("$errstr ($errno)<br />\n");
		    //stream_set_blocking($this->socket, true);
		    //stream_socket_enable_crypto($this->socket, true, STREAM_CRYPTO_METHOD_SSLv3_CLIENT);
		    //stream_set_blocking($this->socket, false);
		}
		
		/**
		 * Destroys the socket
		 */
		public function __destruct() {
		    fclose($this->socket);
		}
		
		/**
		 * Sends a message to the service controller
		 * @param string $message the message to send
		 */
		public function sendMessage($message) {
		    fwrite($this->socket, $message."\r\n");
		}
		
		/**
		 * Returns the current response from the service controller
		 * @return string return the response
		 */
		public function getResponse() {
		    $this->response = fgets($this->socket, 1024);
		    return substr($this->response,0,strpos($this->response, "\n"));
		}
	}
?>