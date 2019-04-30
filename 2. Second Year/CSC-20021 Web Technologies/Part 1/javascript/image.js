var img1 = document.getElementById("img1");
var img2 = document.getElementById("img2");
var img3 = document.getElementById("img3");
var instruct = document.getElementById("instruct");
var img4 = document.getElementById("img4");
var img5 = document.getElementById("img5");
var img6 = document.getElementById("img6");
var exit = document.getElementById("exit");

function enlarge1() {

	var width = img1.style.width;
	var time = setInterval(frame, 1);
	img2.style.display = "none";
	img3.style.display = "none";
	instruct.style.display = "none";
	img4.style.display = "none";
	img5.style.display = "none";
	img6.style.display = "none";
	function frame() {
		if (width == 300) {
			clearInterval(time);
			exit.style.display = "inline";
		} else {
			width++;
			img1.style.width = width + 'px'; 
			img1.style.height = width + 'px'; 
		}
	}

}

function enlarge2() {

	var width = img2.style.width;
	var mLeft = img2.style.marginLeft;
	var time = setInterval(frame, 1);
	img1.style.display = "none";
	img3.style.display = "none";
	instruct.style.display = "none";
	img4.style.display = "none";
	img5.style.display = "none";
	img6.style.display = "none";
	function frame() {
		if (width == 300) {
			clearInterval(time);
			exit.style.display = "inline";
		} else {
			width++;
			mLeft = mLeft - (1/3);
			img2.style.width = width + 'px';
			img2.style.height = width + 'px';
			img2.style.marginLeft = mLeft + 'px';
		}
	}

}

function enlarge3() {

	var width = img3.style.width;
	var mLeft = img3.style.marginLeft;
	var time = setInterval(frame, 1);
	img1.style.display = "none";
	img2.style.display = "none";
	instruct.style.display = "none";
	img4.style.display = "none";
	img5.style.display = "none";
	img6.style.display = "none";
	function frame() {
		if (width == 300) {
			clearInterval(time);
			exit.style.display = "inline";
		} else {
			width++;
			mLeft = mLeft - (2/3);
			img3.style.width = width + 'px';
			img3.style.height = width + 'px';
			img3.style.marginLeft = mLeft + 'px';
		}
	}

}

function enlarge4() {

	var width = img4.style.width;
	var mTop = img4.style.marginTop;
	var time = setInterval(frame, 1);
	img1.style.display = "none";
	img2.style.display = "none";
	instruct.style.display = "none";
	img3.style.display = "none";
	img5.style.display = "none";
	img6.style.display = "none";
	function frame() {
		if (width == 300) {
			clearInterval(time);
			exit.style.display = "inline";
		} else {
			width++;
			mTop = mTop - (2/3);
			img4.style.width = width + 'px';
			img4.style.height = width + 'px';
			img4.style.marginTop = mTop + 'px';
		}
	}

}

function enlarge5() {

	var width = img5.style.width;
	var mTop = img5.style.marginTop;
	var mLeft = img5.style.marginLeft;
	var time = setInterval(frame, 1);
	img1.style.display = "none";
	img2.style.display = "none";
	instruct.style.display = "none";
	img3.style.display = "none";
	img4.style.display = "none";
	img6.style.display = "none";
	function frame() {
		if (width == 300) {
			clearInterval(time);
			exit.style.display = "inline";
		} else {
			width++;
			mLeft = mLeft - (1/3);
			mTop = mTop - (2/3);
			img5.style.width = width + 'px';
			img5.style.height = width + 'px';
			img5.style.marginTop = mTop + 'px';
			img5.style.marginLeft = mLeft + 'px';
		}
	}

}

function enlarge6() {

	var width = img6.style.width;
	var mTop = img6.style.marginTop;
	var mLeft = img6.style.marginLeft;
	var time = setInterval(frame, 1);
	img1.style.display = "none";
	img2.style.display = "none";
	instruct.style.display = "none";
	img3.style.display = "none";
	img4.style.display = "none";
	img5.style.display = "none";
	function frame() {
		if (width == 300) {
			clearInterval(time);
			exit.style.display = "inline";
		} else {
			width++;
			mLeft = mLeft - (2/3);
			mTop = mTop - (2/3);
			img6.style.width = width + 'px';
			img6.style.height = width + 'px';
			img6.style.marginTop = mTop + 'px';
			img6.style.marginLeft = mLeft + 'px';
		}
	}

}

function restore() {

	img1.style = img2.style = img3.style = instruct.style = img4.style = img5.style = img6.style = exit.style = "";

}