<?php
	class ConnectorDB extends mysqli{
		private $user = "root";
		private $host = "127.0.0.1"; 
		private $password = "root";
		private $database  = "cenere";
		public function __construct(){
			parent::__construct($this->host, $this->user, $this->password, $this->database);
			
			// Check connection
			if ($this->connect_error) {
			  error_log ("Failed to connect to MySQL: " . $this->db->connect_error);
			  exit();
			}
		}
	}
?>