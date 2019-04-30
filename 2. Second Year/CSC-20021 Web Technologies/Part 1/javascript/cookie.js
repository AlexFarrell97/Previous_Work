function fontSize(size){
	document.getElementById("head").style.fontSize = size;
	if(typeof(Storage) !== "undefined"){
		localStorage.setItem("size", size);
	}
}

function backColor(color){
	document.body.style.background = color;
	if(typeof(Storage) !== "undefined"){
		localStorage.setItem("color", color);
	}
}