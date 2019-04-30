function pause() {

	

}

function play() {

	

}

var player = document.getElementById("aud");
					
document.getElementById("pause").onclick = function() {
	player.pause();
	document.getElementById("pause").style.display = "none";
	document.getElementById("play").style.display = "inline";
};

document.getElementById("play").onclick = function() {
	player.play();
	document.getElementById("play").style.display = "none";
	document.getElementById("pause").style.display = "inline";
};