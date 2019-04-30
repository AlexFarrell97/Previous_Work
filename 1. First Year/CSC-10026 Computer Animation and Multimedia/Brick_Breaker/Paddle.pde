// Control the behaviour of the paddle
class Paddle
{
  float x; //paddle x
  float y; //paddle y
  float w; //paddle w
  float h; //paddle h
  
  Paddle()
  {
    w = 100;
    h = 10;
    x = width/2 - w/2;
    y = height-80;
  }
  
  //update paddle position
  void update()
  {
    x = mouseX-w/2;
    //x=bl.x-(w/2);
    
    noStroke();
    fill(255,255,255);
    rect(x, y, w, h, 5);
  }
  
}