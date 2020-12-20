<?php
// Необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; chrset=UTF-8");

// Подключение базы данных и файл, содержащий объекты
include_once '../config/database.php';
include_once '../objects/product.php';

// Получаем соединение с базой данны
$database = new Database();
$db = $database->getConnection();

// Инициализируем объект
$product = new Product($db);

// Чтение товаров будет здесь
// Запрашиваем товары
$stmt = $product->read();

// Проверка, найдено ли больше 0 записей

if ($stmt->rowCount() > 0) {
	// массив товаров
	$products_arr = array();
	$products_arr["records"] = array();

	// получаем содержимое нашей таблицы
	// fetch() быстрее, чем fetchAll()
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		// устанавливаем код ответа - 200 OK
		http_response_code(200);

		// извлекаем строку
		extract($row);

		// формируем массив товара
		$product_item = array(
			"id" => $id,
			"name" => $name,
			"description" => html_entity_decode($description),
			"price" => $price,
			"category_id" => $category_id,
			"category_name" => $category_name
		);
		array_push($products_arr["records"], $product_item);
	}
} else {
	// установим код ответа - 404
	http_response_code(404);

	// соодщаем ползователю, что товары не найдены
	$products_arr = array("message" => "products not found!");
}
	echo json_encode($products_arr['records']);
?>
