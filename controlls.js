var video = document.getElementById('player');
var flag = false;
var pause = document.getElementById('pause');
var notEdited = true;
var fus = document.getElementById('fullscreen');
var disp = document.getElementById('header');
var next = document.getElementById('next');
var desc = document.getElementById('desc');
var controll = document.getElementById('controll');

pause.addEventListener("click", function(e) {
	if (flag) {
		video.pause();
	} else {
		video.play();
	}

	flag = !flag;

});

fus.addEventListener("click", function() {
	video.classList.toggle("fullscreen");
	video.classList.toggle("video");
	video.classList.toggle("video-seen");
	disp.classList.toggle("header-f");
	next.classList.toggle("header-f");
	desc.classList.toggle("header-f");
	controll.classList.toggle("controlls-f");
});

var scrollPos = document.getElementById('pos');
var polzPos = document.getElementById('ppos');
var speed = document.getElementById('playBackRate');

speed.value = "1";

speed.addEventListener('click', function() {
	video.playbackRate = parseFloat(speed.value);
});

scrollPos.addEventListener('mousemove', function(e) {
	if(e.buttons != 0){
		polzPos.style.left = (e.clientX - 40) + "px";
		video.currentTime = e.clientX / scrollPos.clientWidth * video.duration;
		notEdited = false;
	} else {
		notEdited = true;
	}
});

scrollPos.addEventListener('click', function(e) {
	if(e.buttons != 0){
		polzPos.style.left = (e.clientX - 40) + "px";	
		video.currentTime = e.clientX / scrollPos.clientWidth * video.duration;
	}
});

setInterval(function() {
	if(notEdited){
		var pixels = video.currentTime / video.duration * scrollPos.clientWidth;
		polzPos.style.left = (pixels) + "px";		
	}
}, 1000);