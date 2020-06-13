<?php
/**
 *
 */
class Database {

	private $host = "localhost";
	private $db_name = "api_db";
	private $username = "root";
	private $password = "root";
	public $conn;

	// Получаем соединение с БД
	function getConnection() {
		$this->conn = null;
		try {
			$this->conn = new PDO(
				"mysql:host=" . $this->host . 
				";dbname=" . $this->db_name, 
					$this->username, 
					$this->password);
			$this->conn->exec("set names utf8");
		} catch(PDOException $e) {
			"Connection error: " . $e->getMessage();
		}
		return $this->conn;
	}
}
?>