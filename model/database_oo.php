<?php 

class Database {
	private static $dsn = 'mysql:host=localhost;dbname=dna';
    private static $username = 'root';
    private static $password = '';
	private static $dbConn;
	
	public function __construct() {}
	
	public function connect() {
		if(!isset(self::$dbConn)) {
			try {
				self::$dbConn = new PDO(self::$dsn, self::$username, self::$password);
			} catch (PDOException $e) {
				$error_message = $e->getMessage();
				include('../errors/database_error.php');
				exit();
			}
		
		return self::$dbConn;
		} else {
			return self::$dbConn;
	}
}
	
	public function close() {
		self::$dbConn->close();
	}
}

?>