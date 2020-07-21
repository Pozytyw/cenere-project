$(".add")[0].addEventListener("click", function (e){
	//create form to send
	var formData = new FormData();
	var size = $("select[name='rozmiar']")[0].value;
	
	formData.append("id", this.id);
	formData.append("size", size);
	
	var xhttp = new XMLHttpRequest();
	
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
				  $('.toast').toast('show');
		}
	};
	xhttp.open("POST", "addToBasket.php", true);
	xhttp.send(formData);
});




