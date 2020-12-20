function getItemById() {
	let reportOperation = document.querySelector('#report-operation-get-id');
	let resultId = document.querySelector('#id-result-id');
	let resultName = document.querySelector('#id-result-name');
	let resultPrice = document.querySelector('#id-result-price');
	let resultDescription = document.querySelector('#id-result-description');

	let inputId = document.querySelector('#input-id');

	// creating XHR and URL objects
	let url = new URL('http://php-api/product/read-by-id.php');
	url.searchParams.set('id', inputId.value);
	let xhr = new XMLHttpRequest(),
		method = "GET",
		url = "./product/read-by-id.php?id=" + inputId;

	// open connection
	xhr.open(method, url, true);

	// set the request header i.e. which type of content you are sending
	xhr.setRequestHeader("Content-Type", "application/json");

	// converting JSON data to string
	/*var data = JSON.stringify({
			"id": inputId.value
		});*/
	
	// create a state change callback
	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4 && xhr.status === 200) {
			let newData = JSON.parse(xhr.responseText);
			console.log(newData.name);
			resultId.innerHTML = newData.id;
			resultName.innerHTML = newData.name;
			resultPrice.innerHTML = newData.price;
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
