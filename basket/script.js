$("button.close").click(function () {
	//get div
	var query = "div[id="+this.id+"]";
	var div = $(query);
	
	//create form to send
	var formData = new FormData();
	//get size
	var size = div.find("select")[0].value;
	//get id
	var id = div.find("input[name=id\\[\\]]")[0].value;
	
	formData.append("id", id);
	formData.append("size", size);
	
	var xhttp = new XMLHttpRequest();
	
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			console.log(this.responseText);
		}
	};
	
	//remove from cookie
	xhttp.open("POST", "remove.php", true);
	xhttp.send(formData);
	
	//remove from side
	div.remove();
	
});