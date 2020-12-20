<?php
// Необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

// подключение файла для соединения с БД
// и файл с объектом
include_once '../config/database.php';
include_once '../objects/product.php';

// получаем соединение с БД
$database = new Database();
$db = $database->getConnection();

// подготовка объекта
$product = new Product($db);

// установим св-во ID записи для чтения
if (isset($_GET['id'])) {
	$product->getById($_GET['id']);
} else if (isset($_GET['name'])) {
	$product->getByName($_GET['name']);
} else {
	echo json_encode(array("message" => "Неверный параметр."), JSON_UNESCAPED_UNICODE);
	die();
}

// _POST method
// $data = json_decode(file_get_contents("php://input"));
// $product->id = $data->id;

if ($product->name != null) {
	// код ответа - 200 OK
	http_response_code(200);

	// создание массива
	$product_arr = array(
		"id" => $product->id,
		"name" => $product->name,
		"description" => $product->description,
		"price" => $product->price
		// "category_id" => $product->category_id,
		// "category_name" => $product->category_name
	);

	// вывод в формате json
	echo json_encode($product_arr);
} else {
	// код ответа - 404 Не Найдено
	http_response_code(404);

	// сообщим пользователю, что товар не существует
	echo json_encode(array("message" => "Товар не существует."), JSON_UNESCAPED_UNICODE);
}

?>
