window.onload = function(){
	
	loaded();
	
	//canvas init
	var canvas = document.getElementById("canvas");
	var ctx = canvas.getContext("2d");
	canvas.width = 100;
	canvas.height = 100;
	var w = canvas.width;
	var h = canvas.height;
	
	//snowflake particles
	var mp = 25; //max particles
	var particles = [];
	
	for (var i = 0; i < mp; i++) {
		particles.push({
			x: Math.random()*w, //x-coordinate
			y: Math.random()*h, //y-coordinate
			r: Math.random()*4+1, //radius
			d: Math.random()*mp //density
		})
	}
	
	//drawing the snowflakes
	function draw()
	{
		ctx.clearRect(0, 0, w, h);
		
		ctx.fillStyle = "rgba(255, 255, 255, 0.8)";
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
			p.y += Math.cos(angle+p.d) + p.r/2;
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

function loaded(){
	if (typeof(Storage) !== "undefined") {
		document.body.style.backgroundColor = localStorage.getItem("color");
		document.getElementById("head").style.fontSize = localStorage.getItem("size");
	}
}