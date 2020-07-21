window.onload = function(){
	$("#search")[0].addEventListener('click', function(e){
		search();
	});
	
	$(".openModal").modal('show');
}

function search(){
	var query = $("#query")[0].value;
	var home = "http://"+window.location.hostname;
	window.location.href = home+"/filter/?query="+query;
}

$(function() {
    $(".custom-close").on('click', function() {
        $('#logowanie').modal('hide');
    });
});