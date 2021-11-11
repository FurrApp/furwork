<?php
// Connect to Database and requests
	class Base{
		private $host = DB_HOST;
		private $username = DB_USER;
		private $pwd = DB_PWD;
		private $db_name = DB_NAME;
		private $dbh;
		private $stmt;
		private $error;

		public function __construct(){
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
			$options = array(
				PDO::ATTR_PERSISTENT => true, 
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);
			try {
				$this->dbh = new PDO($dsn, $this->username, $this->pwd, $options);
				// Encode to UTF-8 international
				$this->dbh->exec('set names utf8');
			}catch(PDOException $e){
				$this->error = $e->getMessage();
				echo $this->error;
			}
		}
		public function query($query){
			$this->stmt = $this->dbh->prepare($query);
		}
		//Preparing requests
		public function bind($param, $value, $type = null){
			if (is_null($type)) {
				switch (true) {
					case is_int($value):
						//Integral value
							$type = PDO::PARAM_INT;
						break;
					case is_bool($value):
						//Bool value
							$type = PDO::PARAM_BOOL;
						break;
					case is_null($value):
						//Null value
							$type = PDO::PARAM_NULL;
						break;
					default: 
							$type = PDO::PARAM_STR;
						break;
				}
			}
			$this->stmt->bindValue($param, $value, $type);
		}
		// Execute
		public function execute(){
			return $this->stmt->execute();
		}
		// Return all rows
		public function fetchAll(){
			$this->execute();
			return $this->stmt->fetchAll(PDO::FETCH_OBJ);
		}
		//Return an unique row
		public function fetch(){
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_OBJ);
		}
		//Count rows
		public function rowCount(){
			$this->execute();
			return $this->stmt->rowCount();
		}
	}