function sendJSON() {
	let resultId = document.querySelector('#result-id');
	let resultName = document.querySelector('#result-name');
	let resultPrice = document.querySelector('#result-price');
	let resultDescription = document.querySelector('#result-description');

	let inputId = document.querySelector('#input-id');
	let inputName = document.querySelector('#input-name');
	let inputPrice = document.querySelector('#input-price');
	let inputDescription = document.querySelector('#input-description');

	// creating XHR object
	let xhr = new XMLHttpRequest(),
		method = "POST",
		url = "./read_by_id.php";

	// open connection
	xhr.open(method, url, true);

	// set the request header i.e. which type of content you are sending
	xhr.setRequestHeader("Content-Type", "application/json");

	// converting JSON data to string
	var data = JSON.stringify({
			"id": inputId.value,
			"name": inputName.value,
			"price": inputPrice.value,
			"description": inputDescription.value
		});
	
	// create a state change callback
	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4 && xhr.status === 200) {
			// TODO get associative array
			resultId.innerHTML = xhr.responseText;
			console.log(xhr.responseText);
		} else {
			resultId.innerHTML = 'Bad request from server.';
		}
	};
	
	// sending data with the request
	xhr.send(data);
}
