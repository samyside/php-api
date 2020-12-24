<?php
/**
 *
 */
class Category {
	// соединение с БД и таблицей 'categories'
	private $conn;
	private $table_name = "categories";

	// свойства объекта
	private $id;
	private $name;
	private $description;
	private $created;

	function __construct($db) {
		$this->conn = $db;
	}
	
	// используем раскрывающийся список выбора
	public function read() {
		// выбираем все данные
		$query = "SELECT id, name, description FROM " . $this->table_name . " ORDER BY name";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}
}
?>