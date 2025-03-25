/// Theme changer
/// Usage - set number of theme
/// Set theme - set slter
/// Add your styles - add path to file in array styles

///C0d9d by NTh6ck9r
///Free usage

var s = get_cookie("style");

const slt = document.getElementById('styleChanger'); //there we go
const linker1 = document.getElementById('styles'); //tag link

slt.value = s;

const styles = [
	"styleVideo.css",
	"hackerStyleVideo.css"
];

linker1.setAttribute("href", WAY + styles[s]);

slt.addEventListener("click", function ThemeController(e) {
	if(window.s == slt.value - "0") return;
	window.s = slt.value - "0";

	//linker1.setAttribute("href", WAY + styles[i]);
	linker1.href = WAY + styles[window.s];
	var xhr = new XMLHttpRequest();

	xhr.open("GET", "cookie.php?type=style&num=" + t);

	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200){
			console.log(xhr.responseText);
		}
	}

	xhr.send();
});