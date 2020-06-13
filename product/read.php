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
$num = $stmt->rowCount();

// Проверка, найдено ли больше 0 записей
if ($num > 0) {
	// массив товаров
	$products_arr = array();
	$products_arr["records"] = array();

	// получаем содержимое нашей таблицы
	// fetch() быстрее, чем fetchAll()
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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

		// устанавливаем код ответа - 200 OK
		http_response_code(200);

		// выводим данные о товаре в формате JSON
		echo json_encode($products_arr);
	}
} else {
	// установим код ответа - 404
	http_response_code(404);

	// соодщаем ползователю, что товары не найдены
	echo json_encode(array("message" => "Товары не найдены."), JSON_UNESCAPED_UNICODE);
}
?>
