var video = document.getElementById('player');
var flag = false;
var pause = document.getElementById('pause');
var notEdited = true;
var fus = document.getElementById('fullscreen');
var disp = document.getElementById('header');
var next = document.getElementById('next');
var desc = document.getElementById('desc');
var controll = document.getElementById('controll');
var title = document.getElementById('titleV2');
var commentBubble = document.getElementById('commentBubble');

var blur = document.getElementById('playerBlur');

pause.addEventListener("click", function(e) {
	if (flag) {
		video.pause();
		blur.pause();
	} else {
		video.play();
		blur.play();
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
	title.classList.toggle("header-f");
	commentBubble.classList.toggle("header-f");
	blur.classList.toggle("header-f");
	controll.classList.toggle("controlls-f");
});

var scrollPos = document.getElementById('pos');
var polzPos = document.getElementById('ppos');
var speed = document.getElementById('playBackRate');

speed.value = "1";

speed.addEventListener('click', function() {
	video.playbackRate = parseFloat(speed.value);
	blur.playbackRate = parseFloat(speed.value);

});

scrollPos.addEventListener('mousemove', function(e) {
	if(e.buttons != 0){
		polzPos.style.left = (e.clientX - 40) + "px";
		video.currentTime = e.clientX / scrollPos.clientWidth * video.duration;
		blur.currentTime = e.clientX / scrollPos.clientWidth * video.duration;
		notEdited = false;
	} else {
		notEdited = true;
	}
});

scrollPos.addEventListener('click', function(e) {
	if(e.buttons != 0){
		polzPos.style.left = (e.clientX - 40) + "px";	
		video.currentTime = e.clientX / scrollPos.clientWidth * video.duration;
		blur.currentTime = e.clientX / scrollPos.clientWidth * video.duration;
	}
});

setInterval(function() {
	if(notEdited){
		var pixels = video.currentTime / video.duration * scrollPos.clientWidth;
		polzPos.style.left = (pixels-5) + "px";		
	}
}, 1000);