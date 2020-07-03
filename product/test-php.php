<?php
// Необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once '../config/database.php';
include_once '../objects/product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

// accept _GET method
// $id = isset($_GET['id']) ? $_GET['id'] : die();

// accept _POST method
$data = json_decode(file_get_contents("php://input"));
$product->id = $data->id;

echo "ID of product = " . $product->id;
?>
