var cover = document.getElementById("cover");

function loadVideo() {

	var op = 0.1;  // initial opacity
	cover.style.display = 'block';
	var timer = setInterval(function () {
		if (op >= 1){
			clearInterval(timer);
		}
		cover.style.opacity = op;
		cover.style.filter = 'alpha(opacity=' + op * 100 + ")";
		op += op * 0.1;
	}, 20);

}

function closeVideo() {

	var op = 1;  // initial opacity
	var timer = setInterval(function () {
		if (op <= 0.1){
			clearInterval(timer);
			cover.style.display = "none";
		}
		cover.style.opacity = op;
		cover.style.filter = 'alpha(opacity=' + op * 100 + ")";
		op -= op * 0.1;
	}, 20);
	stop();
	mute();

}

var video = document.getElementById("video1");

function playPause() {
	if (video.paused) {
		video.play();
		document.getElementById("playPause").innerHTML = "&#10074;&#10074;";
	} else {
		video.pause();
		document.getElementById("playPause").innerHTML = "&#9658;";
	}
}

function stop() {
	video.currentTime = 0;
	video.pause();
	document.getElementById("playPause").innerHTML = "&#9658;";
}

function mute() {
	if (video.muted) {
		video.muted = false;
		document.getElementById("mute").innerHTML = "Mute";
	} else {
		video.muted = true;
		document.getElementById("mute").innerHTML = "Unmute";
	}
}