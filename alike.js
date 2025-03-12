var like = document.getElementById('like');
var dislike = document.getElementById('dislike');
var views = document.getElementById('views');

like.addEventListener("click", function(e) {
	e.preventDefault();

	var xhr = new XMLHttpRequest();
	xhr.open("GET", "like.php?d=like&v=" + i);

	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200){
			like.innerHTML = "Likes: " + xhr.responseText;
		}
	}

	xhr.send();
});

dislike.addEventListener("click", function(e) {
	e.preventDefault();

	var xhr = new XMLHttpRequest();
	xhr.open("GET", "like.php?d=dislike&v=" + i);

	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200){
			dislike.innerHTML = "Dislikes: " + xhr.responseText;
		}
	}

	xhr.send();
});

var xhr = new XMLHttpRequest();
xhr.open("GET", "like.php?d=gatherDislikes&v=" + i);

xhr.onreadystatechange = function() {
	if(xhr.readyState == 4 && xhr.status == 200){
		dislike.innerHTML = "Dislikes: " + xhr.responseText;
	}
}

xhr.send();

var xhr1 = new XMLHttpRequest();
xhr1.open("GET", "like.php?d=gatherLikes&v=" + i);

xhr1.onreadystatechange = function() {
	if(xhr1.readyState == 4 && xhr1.status == 200){
		like.innerHTML = "Likes: " + xhr1.responseText;
	}
}

xhr1.send();

var xhr2 = new XMLHttpRequest();
xhr2.open("GET", "like.php?d=views&v=" + i);

xhr2.onreadystatechange = function() {
	if(xhr1.readyState == 4 && xhr1.status == 200){
		views.innerHTML = "Views: " + xhr2.responseText;
	}
}

xhr2.send();

