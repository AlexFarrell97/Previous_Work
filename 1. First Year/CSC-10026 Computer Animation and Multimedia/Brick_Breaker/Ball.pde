// Control the behaviour of the ball
class Ball
{
  float x; //ball x
  float y; //ball y
  float vx; //ball x velocity
  float vy; //ball y velocity
  float d; //ball diameter
  
  Ball()
  {
    d = 10;
    reset();
  }
  
  //Update the ball
  void update()
  {
    noStroke();
    fill(255);
    ellipse(x, y, d, d);
    
    x += vx; //increment x
    y += vy; //increment y
  }
  
  //Move ball left
  void moveLeft()
  {
    vx = -4;
  }
  
  //Move ball right
  void moveRight()
  {
    vx = 4;
  }
  
  //Ball changes in y direction
  void changeY()
  {
    vy *= -1;
  }
  
  //reset ball position and velocity
  void reset()
  {
    x = (height/2)-(d/2);
    y = height-300;
    vx = 0;
    vy = 4;
  }
  
}