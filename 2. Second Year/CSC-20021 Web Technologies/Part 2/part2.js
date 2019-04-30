//canvas init
var canvas = document.getElementById("myCanvas");
var ctx = canvas.getContext("2d");
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;
var w = canvas.width;
var h = canvas.height;

document.getElementById("scene").style.marginTop = (window.innerHeight - 350) + "px";

//snowflake particles
var particles = [];
var mp;

function snowflake(max)
{
	particles = [];
	mp = max;
	for (var i = 0; i < mp; i++) {
		particles.push({
			x: Math.random()*w, //x-coordinate
			y: Math.random()*h, //y-coordinate
			r: Math.random()*4+1, //radius
			d: Math.random()*mp //density
		})
	}
}

window.onload = function(){
	
	snowflake(50);
	
	//drawing the snowflakes
	function draw()
	{
		ctx.clearRect(0, 0, w, h);
		
		ctx.fillStyle = "rgba(225, 225, 225, 0.8)";
		ctx.beginPath();
		for (var i = 0; i < mp; i++) {
			var p = particles[i];
			ctx.moveTo(p.x, p.y);
			ctx.arc(p.x, p.y, p.r, 0, Math.PI*2, true);
		}
		ctx.fill();
		update();
	}
	
	//Function to move the snowflakes
	var angle = 0;
	function update()
	{
		angle += 0.01;
		for(var i = 0; i < mp; i++)
		{
			var p = particles[i];
			//Updating X and Y coordinates
			p.y += Math.cos(angle+p.d) + p.d/20;
			p.x += Math.sin(angle) * 2;
			
			//Sending flakes back from the top when it exits
			if(p.x > w+5 || p.x < -5 || p.y > h)
			{
				
				if(i%3 > 0)
				{
					particles[i] = {x: Math.random()*w, y: -10, r: p.r, d: p.d};
				}
				else
				{
					if(Math.sin(angle) > 0)
					{
						particles[i] = {x: -5, y: Math.random()*h, r: p.r, d: p.d};
					}
					else
					{
						particles[i] = {x: w+5, y: Math.random()*h, r: p.r, d: p.d};
					}
				}
			}
		}
	}
	
	//animation loop
	setInterval(draw, 40);

}

var script = document.createElement('script');
script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);

function settings()
{
	$("#settings-box").fadeIn();
	
}

function changeSettings()
{
	var select = document.getElementById("intensity-select");
	var intensity = select.options[select.selectedIndex].value;
	snowflake(intensity);
	
	select = document.getElementById("song-select");
	var song = select.options[select.selectedIndex].value;
	soundtrack(song);
	
	
	closeSettings();
}

function soundtrack(track)
{
	audio = document.getElementById("aud");
	audio.src = track + ".mp3";
	audio.load();
	audio.play();
}

function closeSettings()
{
	$("#settings-box").fadeOut();
}