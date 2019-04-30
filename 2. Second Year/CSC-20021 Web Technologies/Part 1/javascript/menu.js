document.getElementById("cross").style.display = 'none';
document.getElementById("menu").style.display = 'none';

document.getElementById("hamburger").addEventListener('click', function (event) {
	document.getElementById("menu").style.display = 'inline';
	document.getElementById("cross").style.display = 'inline';
	document.getElementById("hamburger").style.display = 'none';
});

document.getElementById("cross").addEventListener('click', function (event) {
	document.getElementById("menu").style.display = 'none';
	document.getElementById("cross").style.display = 'none';
	document.getElementById("hamburger").style.display = 'inline';
});
