var comm = document.getElementById('commRES');
var inCom = document.getElementById('inCom');

var xhr1 = new XMLHttpRequest();
xhr1.open("GET", "comments.php?comment=&m=read&v=" + i);

xhr1.onreadystatechange = function(e) {
	if(xhr1.readyState == 4 && xhr1.status == 200){
		comm.innerHTML = xhr1.responseText;
	}
}

xhr1.send();


inCom.onkeydown = function (e) {
	if(e.keyCode == 13){
		var comment = inCom.value;

		var xhr = new XMLHttpRequest();
		xhr.open("GET", "comments.php?comment=" + comment + "&m=write&v=" + i);

		xhr.onreadystatechange = function(e) {
			if(xhr.readyState == 4 && xhr.status == 200){
				comm.innerHTML = xhr.responseText;
				inCom.value = "";
			}
		}

		xhr.send();
	}
}