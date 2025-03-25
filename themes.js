function get_cookie(argument) {
	var cookies = document.cookie.split("; ");
	for (var i = 0; i < cookies.length; i++) {
		var ck = cookies[i].split("=");
		if(ck[0] == argument){
			return ck[1];
		}
	}
	return 0;
}

/// Theme changer
/// Usage - set number of theme
/// Set theme - set selecter
/// Add your themes - add path to file in array themes

///C0d9d by NTh6ck9r
///Free usage
const WAY = "/style/"; //Way to any style
var t = get_cookie("theme");

const select = document.getElementById('themeSelecter'); //there we go
const linker = document.getElementById('linker'); //tag link

select.value = t;

const themes = [
	"LightTheme.css",
	"DarkTheme.css",
	"ContrastTheme.css",
	"DeepBlueTheme.css",
	"GrayscaleTheme.css",
	"Glassomorphism.css"
];

linker.setAttribute("href", WAY + themes[t]);

select.addEventListener("click", function ThemeController(e) {
	if(window.t == select.value - "0") return;
	window.t = select.value - "0";

	//linker.setAttribute("href", WAY + themes[i]);
	linker.href = WAY + themes[window.t];
	var xhr = new XMLHttpRequest();

	xhr.open("GET", "cookie.php?type=theme&num=" + t);

	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200){
			console.log(xhr.responseText);
		}
	}

	xhr.send();
});
