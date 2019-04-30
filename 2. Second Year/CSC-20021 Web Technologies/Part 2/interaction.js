var script = document.createElement('script');
script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);

function settings()
{
	$("#settings-box").fadeIn();
	snowflake(500);
}

function out()
{
	$("#settings-box").fadeOut();
}