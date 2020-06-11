function sendJSON() {
	let result = document.querySelector('.result');
	let id = document.querySelector('#id');
	let name = document.querySelector('#name');
	let price = document.querySelector('#price');
	let description = document.querySelector('#description');
	let category_id = document.querySelector('#category_id');


	// creating XHR object
	let xhr = new XMLHttpRequest(),
		method = "POST",
		url = "test-php.php";

	// open connection
	xhr.open(method, url, true);

	// set the request header i.e. which type of content you are sending
	xhr.setRequestHeader("Content-Type", "application/json");

	// converting JSON data to string
	var data = JSON.stringify({
/*			"name": name.value, 
			"price": price.value,
			"description": description.value,
			"category_id": category_id.value*/
			"id": id.value
		});
	
	// create a state change callback
	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4 && xhr.status === 200) {
			// print received data from server
			result.innerHTML = xhr.responseText;
		} else {
			result.innerHTML = 'Bad request from server.';
		}
	};
	
	// sending data with the request
	xhr.send(data);
	console.log(xhr.responseText);
}
