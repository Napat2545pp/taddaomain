function showHint(str) {
			if (str.length == 0) { 
				document.getElementById("txtHint").innerHTML = '<i class="fa fa-exclamation-circle" style="font-size:24px;color:#c81c1c"></i><style>.input-register1{height: 49px;border: 1px solid #c81c1c;color: #FFF;padding: 14px 20px 15px 20px;font-size: 14px;box-shadow: #c81c1c 0px 0px 10px;}</style>';
				return;
			} else {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("txtHint").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "check.php?q=" + str, true);
				xmlhttp.send();
			}
			$("#button_check").load("button_check.php");
		}
		function showHint2(str) {
			if (str.length == 0) { 
				document.getElementById("txtHint2").innerHTML = '<i class="fa fa-exclamation-circle" style="font-size:24px;color:#c81c1c"></i><style>.input-register2{height: 49px;border: 1px solid #c81c1c;color: #FFF;padding: 14px 20px 15px 20px;font-size: 14px;box-shadow: #c81c1c 0px 0px 10px;}</style>';
				return;
			} else {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("txtHint2").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "check2.php?q=" + str, true);
				xmlhttp.send();
			}
			$("#button_check").load("button_check.php");
		}
		function showHint3(str) {
			if (str.length == 0) { 
				document.getElementById("txtHint3").innerHTML = '<i class="fa fa-exclamation-circle" style="font-size:24px;color:#c81c1c"></i><style>.input-register3{height: 49px;border: 1px solid #c81c1c;color: #FFF;padding: 14px 20px 15px 20px;font-size: 14px;box-shadow: #c81c1c 0px 0px 10px;}</style>';
				return;
			} else {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("txtHint3").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "check3.php?q=" + str, true);
				xmlhttp.send();
			}
			$("#button_check").load("button_check.php");
		}
		function showHint4(str) {
			if (str.length == 0) { 
				document.getElementById("txtHint4").innerHTML = '<i class="fa fa-exclamation-circle" style="font-size:24px;color:#c81c1c"></i><style>.input-register4{height: 49px;border: 1px solid #c81c1c;color: #FFF;padding: 14px 20px 15px 20px;font-size: 14px;box-shadow: #c81c1c 0px 0px 10px;}</style>';
				return;
			} else {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("txtHint4").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "check4.php?q=" + str, true);
				xmlhttp.send();
			}
			$("#button_check").load("button_check.php");
		}
		function showHint5(str) {
			if (str.length == 0) { 
				document.getElementById("txtHint5").innerHTML = '<i class="fa fa-exclamation-circle" style="font-size:24px;color:#c81c1c"></i><style>.input-register5{height: 49px;border: 1px solid #c81c1c;color: #FFF;padding: 14px 20px 15px 20px;font-size: 14px;box-shadow: #c81c1c 0px 0px 10px;}</style>';
				return;
			} else {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("txtHint5").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "check5.php?q=" + str, true);
				xmlhttp.send();
			}
			$("#button_check").load("button_check.php");
		}
		function showHint6(str) {
			if (str.length == 0) { 
				document.getElementById("txtHint6").innerHTML = '<style>.select-register6{height: 49px;border: 1px solid #412f1b;background: #11100e;color: #9a6a3a;padding: 14px 20px;font-size: 14px;outline: none;}</style>';
				return;
			} else {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("txtHint6").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "check6.php?q=" + str, true);
				xmlhttp.send();
			}
			$("#button_check").load("button_check.php");
		}
		function showHint7(str) {
			if (str.length == 0) { 
				document.getElementById("txtHint7").innerHTML = '<style>.select-register7{height: 49px;border: 1px solid #412f1b;background: #11100e;color: #9a6a3a;padding: 14px 20px;font-size: 14px;outline: none;}</style>';
				return;
			} else {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("txtHint7").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "check7.php?q=" + str, true);
				xmlhttp.send();
			}
			$("#button_check").load("button_check.php");
		}
		function showHint8(str) {
			if (str.length == 0) { 
				document.getElementById("txtHint8").innerHTML = '<style>.select-register8{height: 49px;border: 1px solid #412f1b;background: #11100e;color: #9a6a3a;padding: 14px 20px;font-size: 14px;outline: none;}</style>';
				return;
			} else {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("txtHint8").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "check8.php?q=" + str, true);
				xmlhttp.send();
			}
			$("#button_check").load("button_check.php");
		}