<?php 
// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// получаем соединение с базой данных
include_once '../config/database.php';

// создание объекта товра
include_once '../objects/product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

// получаем отправленные данные
$data = json_decode(file_get_contents("php://input"));

// проверка. данные пусты?
if (
	!empty($data->name) &&
	!empty($data->price) &&
	!empty($data->description) &&
	!empty($data->category_id) 
) {
	// устанавливаем значения св-в товара
	$product->name = $data->name;
	$product->price = $data->price;
	$product->description = $data->description;
	$product->category_id = $data->category_id;
	$product->created = date('Y-m-d H:i:s');

	// создание товара
	if ($product->created()) {
		// установлен код ответа - 201 Создано
		http_response_code(201);

		// ответ пользователю успешный
		echo json_encode(array("message" => "Товар был создан."), JSON_UNESCAPED_UNICODE);
	} 
	// если неудалось создать товар, выдаем сообщение
	else {
		// установлен код ответа - 503 Сервис Недоступен
		http_response_code(503);

		// соощение пользователю о том, что товар не создан
		echo json_encode(array("message" => "Не удалось создать товар."), JSON_UNESCAPED_UNICODE);
	}
}
// Сообщение пользователю о неверных введенных данных
else {
	// установлен код ответа - 400 Неверный Запрос
	http_response_code(400);

	// сообщение пользователю
	echo json_encode(array("message" => "Не удалось создать товар. Данные неполные."), JSON_UNESCAPED_UNICODE);
}

?>
