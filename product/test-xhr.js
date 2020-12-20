function sendJSON() {
	let resultId = document.querySelector('#result-id');
	let resultName = document.querySelector('#result-name');
	let resultPrice = document.querySelector('#result-price');
	let resultDescription = document.querySelector('#result-description');

	let inputId = document.querySelector('#input-id');

	// creating XHR object
	let xhr = new XMLHttpRequest(),
		method = "POST",
		url = "./read-by-id.php";

	// open connection
	xhr.open(method, url, true);

	// set the request header i.e. which type of content you are sending
	xhr.setRequestHeader("Content-Type", "application/json");

	// converting JSON data to string
	var data = JSON.stringify({
			"id": inputId.value
		});
	
	// create a state change callback
	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4 && xhr.status === 200) {
			// TODO get associative array
			let newData = JSON.parse(xhr.responseText);
			console.log(newData.name);
			resultId.innerHTML = newData.id;
			resultName.innerHTML = newData.name;
			resultPrice.innerHTML = newData.price;
			console.log(xhr.responseText);
		} else {
			resultId.innerHTML = 'Bad request from server.';
		}
	};
	
	// sending data with the request
	xhr.send(data);
}
