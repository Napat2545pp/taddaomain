function loadDoc() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("txtHint9").innerHTML =
			this.responseText;
			$("#button_check").load("button_check.php");
		}
	};
	xhttp.open("GET", "check9.php", true);
	xhttp.send();
}