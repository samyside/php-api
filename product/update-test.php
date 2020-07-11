<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// import
include_once '../config/database.php';

$hostname = "localhost";
$db_name = "api_db";
$username = "root";
$password = "root";
$connection = null;
$db = new Database();
$database = $db->getConnection();

function readAll($database) {
	$query = "SELECT id, name from products";
	$stmt = $database->prepare($query);
	$stmt->execute();
	$arrayProducts = array();
	$arrayProducts["records"] = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$tempArrayProducts = array(
			"id" => $id,
			"name" => $name
		);
		array_push($arrayProducts["records"], $tempArrayProducts);
	}
	return $arrayProducts;
}

$arrayResult = readAll($database);

echo json_encode($arrayResult);
?>