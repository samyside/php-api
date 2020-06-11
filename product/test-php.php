<?php 
header("Content-Type: application/json"); 

// accept _GET method
// $id = isset($_GET['id']) ? $_GET['id'] : die();

// accept _POST method
$data = json_decode(file_get_contents("php://input"));

echo "ID of product = " . $data->id;
?>
