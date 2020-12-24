function getById() {
	let reportOperation = document.querySelector('#report-operation-get-id');
	let resultId = document.querySelector('#id-result-id');
	let resultName = document.querySelector('#id-result-name');
	let resultPrice = document.querySelector('#id-result-price');
	let resultDescription = document.querySelector('#id-result-description');

	let inputId = document.querySelector('#input-id');

	// creating XHR and URL objects
	let xhr = new XMLHttpRequest(),
		method = "GET",
		url = new URL('http://php-api/product/read-by.php');
	url.searchParams.set('id', inputId.value);

	// open connection
	xhr.open(method, url, true);

	// set the request header i.e. which type of content you are sending
	xhr.setRequestHeader("Content-Type", "application/json");

	// create a state change callback
	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4 && xhr.status === 200) {
			let data = JSON.parse(xhr.responseText);

			// data.forEach((current, index)=> {
			// 	output +=  current + ' ';
			// });

			document.querySelector('#dynamic-result')
				.insertAdjacentHTML('afterbegin', output);

			resultId.innerHTML = data.id;
			resultName.innerHTML = data.name;
			resultDescription.innerHTML = data.description;
			resultPrice.innerHTML = data.price;

			reportOperation.innerHTML = 'Success';
		} else {
			reportOperation.innerHTML = 'Error. Bad request from server';
			resultId.innerHTML = " ";
			resultName.innerHTML = " ";
			resultPrice.innerHTML = " ";
		}
	};
	
	// sending data with the request
	xhr.send();
}

async function getByName() {
	// Входные данные
	let input = document.querySelector('#inputName');

	// Результирующие переменные
	let resultName = document.querySelector('#result');

	// Получение данных с сервера
	let url = new URL('http://php-api/product/read-by.php');
	url.searchParams.set('name', input.value);
	const response = await fetch(url);
	const result = await response.json();

	// Вывод результата в HTML
	resultName.innerHTML = result.id;
}