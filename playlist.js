var cache = "";
var next_plays = [];
var vids = document.getElementById('player');
var current = 0;

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
	current++;
	if(current < next_plays.length){
		vids.src = next_plays[current];
	}
}

function addVideoToPlaylist() {
	var xhrT = new XMLHttpRequest();
	xhrT.open("GET", "playlist_add.php?mode=write_add&name=" + play_name + "&data=" + i);
}

setInterval(function() {
	if(vids.currentTime == vids.duration){
		check_next_videos();
	}
}, 500);