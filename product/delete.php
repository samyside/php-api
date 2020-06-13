<?php
// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-AllowMethods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// подключим файл соединения с базой и объектом Product
include_once '../config/database.php';
include_once '../objects/product.php';

// получаем соединение с БД
$database = new Database();
$db = $database->getConnection();

// подготовка объекта
$product = new Product($db);

// получаем id товара
$data = json_decode(file_get_contents("php://input"));

// установим id товара для удаления
$product->id = $data->id;

// удаление товара
if ($product->delete()) {
	// установлен код ответа - 200 OK
	http_response_code(200);

	// сообщение пользователю
	echo json_decode(array("message" => "Товар удален."), JSON_UNESCAPED_UNICODE);
}
// если не удалось удалить товар
else {
	// установлен код ответа - 503 Сервис Недоступен
	http_response_code(503);

	// сообщим об это пользователю
	echo json_encode(array("message" => "Не удалось удалить товар."), JSON_UNESCAPED_UNICODE);
}

?>