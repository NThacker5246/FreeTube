var comm = document.getElementById('commRES');
var inCom = document.getElementById('inCom');

var xhr23 = new XMLHttpRequest();
xhr23.open("GET", "comments.php?comment=&m=read&v=" + i);

xhr23.onreadystatechange = function(e) {
	if(xhr23.readyState == 4 && xhr23.status == 200){
		comm.innerHTML = xhr23.responseText;
	}
}

xhr23.send();


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