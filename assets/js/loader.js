function getItemById() {
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
			console.log(data.name);
			resultId.innerHTML = data.id;
			resultName.innerHTML = data.name;
			resultDescription.innerHTML = data.description;
			resultPrice.innerHTML = data.price;
			console.log(xhr.responseText);
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
