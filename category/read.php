<?php
// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение файлов для осединения с БД и файл с объектом Category
include_once '../config/database.php';
include_once '../objects/category.php';

// создание подключения к базе данных
$database = new Database();
$db = $database->getConnection();

// инициализация объекта
$category = new Category($db);

// запрос для категорий
$stmt = $category->read();
$num = $stmt->rowCount();

// проверяем, найдено ли больше 0 записей
if ($num > 0) {
	// массив
	$categories_arr = array();

	// получим содержимое нашей таблицы
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		// извлекаем строку
		extract($row);

		$category_item = array(
			"id" => $id,
			"name" => $name,
			"description" => html_entity_decode($description)
		);

		array_push($categories_arr, $category_item);
	}
	// код ответа - 200 OK
	http_response_code(200);

	// отдаем данные категорий в формате JSON
	echo json_encode($categories_arr);
} else {
	// код ответа - 404 Ничего Не Найдено
	http_response_code(404);

	// сообщение пользователю "категории не найдены"
	echo json_encode(array("message" => "Категории не найдены."), JSON_UNESCAPED_UNICODE);
}

?>
