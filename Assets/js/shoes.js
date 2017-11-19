$(document).ready(e => {

	$(document).on('change', '#brandForm', function(){
			let val = $(this).find("select").val();
			window.location.href = "/shoes/"+val;
	});

	$(document).on('change', '#priceForm', function(){
		let val = $(this).find("select").val();
		window.location.href = val;
	});

	//Requesting the user's position on nearby shoes request
	let lat = lng = null;
	let position = () => {
		if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(position => {
	        	$('#latitude').val(position.coords.latitude);
	        	$('#longitude').val(position.coords.longitude);
	        	$('#nearby-submit').click();
	        });
	    } else {
	    	alert("Could not detect your position");
	    }
	};
	$('#nearby-submit').click(e => {
		if($('#latitude').val() != '' && $('#longitude').val() != '' ){
			return true;
		}
		e.preventDefault();
		position();
	});

});