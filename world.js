window.onload = function{
	var buttonCities = document.getElementById("cities");
	var buttonCountry = document.getElementById("country");

	buttonCountry.addEventListener("click", function(e) {
		e.preventDefault();
		httpReq = new XMLHttpRequest();
		var textField = document.getElementById("entries").value;

		if (buttonCountry.checked == true && null != textField) {
			var url = "world.php?country=" + textField; 
			httpReq.onreadystatechange = loadPage;
			httpReq.open('GET', url);
			httpReq.send();
		}
	})

	buttonCities.addEventListener("click", function(e) {
		e.preventDefault();
		httpReq = new XMLHttpRequest();
		var textField = document.getElementById("entries");

		if (buttonCities.checked == true && null != textField) {
			var url = "world.php?country=Jamaica&context=" + textField;
			httpReq.onreadystatechange = loadPage;
			httpReq.open('GET', url);
			httpReq.send();
		}
	})

	function loadPage {
		if (httpReq.readyState === XMLHttpRequest.DONE)
		{
			if (httpReq.status === 200) 
			{
				var response = httpReq.responseText;
				document.getElementById("result").innerHTML = response;
			}
			else
			{
				alert("ERROR!");
			}
		}
	}
}