var cache = "";
var next_plays = [];
var vids = document.getElementById('player');

function check_next_videos() {
	if(cache == ""){
		var xhr = new XMLHttpRequest();
		xhr.open("GET", "playlist_add.php?mode=read&name=" + play_name + "&data=");

		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4 && xhr.status == 200){
				cache = xhr.readyState;
				next_plays = split(",", cache);
			}
		}

		xhr.send();
	}

	//vids.src = 
}

