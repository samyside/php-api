<?php
// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Autorization, X-Requested-With");

// подключаем файл для работы с БД и объектом Product
include_once '../config/database.php';
include_once '../objects/product.php';

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// подготовка объекта
$product = new Product($db);

// получаем id Товара для редактирования
$data = json_decode(file_get_contents("php://input"));

// установим id св-ва товара для редактирования
$product->id = $data->id;

// установим значение св-в товара
$product->name = $data->name;
$product->price = $data->price;
$product->description = $data->description;
$product->category_id = $data->category_id;

// обновление значений товара
if ($product->update()) {
	// установлен код ответа - 200 OK
	http_response_code(200);

	// сообщение пользователю
	echo json_encode(array("message" => "Товар был изменен."), JSON_UNESCAPED_UNICODE);
}
// если не удается внести изменения для товара,
// выведем сообщение пользователю
else {
	// код ответа - 503 Сервис Недоступен
	http_response_code(503);

	// сообщение пользователю
	echo json_encode(array("message" => "Не удалось внести изменения."), JSON_UNESCAPED_UNICODE);
}

?>